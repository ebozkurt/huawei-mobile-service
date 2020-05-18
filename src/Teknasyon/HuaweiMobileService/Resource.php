<?php

namespace Teknasyon\HuaweiMobileService;

use GuzzleHttp\Psr7\Request;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Teknasyon\HuaweiMobileService\HuaweiClient as Client;
use Teknasyon\HuaweiMobileService\InAppPurchase\Exceptions\HuaweiException;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\Model;

class Resource
{
    /** @var string $rootUrl */
    private $rootUrl;

    /** @var Client $client */
    private $client;

    /** @var string $serviceName */
    private $serviceName;

    /** @var string $resourceName */
    private $resourceName;

    /** @var array $methods */
    private $methods;


    /**
     * Resource constructor.
     *
     * @param SubscriptionPublisher|OrderPublisher $service
     * @param string                               $resourceName
     * @param array                                $resource
     */
    public function __construct($service, $resourceName, $resource)
    {
        $this->rootUrl = $service->rootUrl;
        $this->client = $service->getClient();
        $this->serviceName = $service->serviceName;
        $this->resourceName = $resourceName;
        $this->methods = is_array($resource) && isset($resource['methods']) ?
            $resource['methods'] : array($resourceName => $resource);
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @param $expectedClass - optional, the expected class name
     *
     * @return ResponseInterface|expectedClass
     * @throws HuaweiException
     */
    public function call($name, $arguments, $expectedClass = null)
    {
        if (!isset($this->methods[$name])) {
            $this->client->log(
                'Service method unknown',
                Logger::ERROR,
                array(
                    'service' => $this->serviceName,
                    'resource' => $this->resourceName,
                    'method' => $name
                )
            );

            throw new HuaweiException(
                "Unknown function: " .
                "{$this->serviceName}->{$this->resourceName}->{$name}()"
            );
        }

        $method = $this->methods[$name];
        $parameters = $arguments[0];

        // postBody is a special case since it's not defined in the discovery
        // document as parameter, but we abuse the param entry for storing it.
        $postBody = null;
        if (isset($parameters['postBody'])) {
            if ($parameters['postBody'] instanceof Model) {
                // In the cases the post body is an existing object, we want
                // to use the smart method to create a simple object for
                // for JSONification.
                $parameters['postBody'] = $parameters['postBody']->toSimpleObject();
            } else {
                if (is_object($parameters['postBody'])) {
                    // If the post body is another kind of object, we will try and
                    // wrangle it into a sensible format.
                    $parameters['postBody'] = $this->convertToArrayAndStripNulls($parameters['postBody']);
                }
            }
            $postBody = (array)$parameters['postBody'];
            unset($parameters['postBody']);
        }

        // TODO: optParams here probably should have been
        // handled already - this may well be redundant code.
        if (isset($parameters['optParams'])) {
            $optParams = $parameters['optParams'];
            unset($parameters['optParams']);
            $parameters = array_merge($parameters, $optParams);
        }

        if (!isset($method['parameters'])) {
            $method['parameters'] = array();
        }

        foreach ($parameters as $key => $val) {
            if ($key != 'postBody' && !isset($method['parameters'][$key])) {
                $this->client->log(
                    'Service parameter unknown',
                    Logger::ERROR,
                    array(
                        'service' => $this->serviceName,
                        'resource' => $this->resourceName,
                        'method' => $name,
                        'parameter' => $key
                    )
                );
                throw new HuaweiException("($name) unknown parameter: '$key'");
            }
        }

        foreach ($method['parameters'] as $paramName => $paramSpec) {
            if (isset($paramSpec['required']) && $paramSpec['required'] && !isset($parameters[$paramName])) {
                $this->client->log(
                    'Service parameter missing',
                    Logger::ERROR,
                    array(
                        'service' => $this->serviceName,
                        'resource' => $this->resourceName,
                        'method' => $name,
                        'parameter' => $paramName
                    )
                );
                throw new HuaweiException("($name) missing required param: '$paramName'");
            }
            if (isset($parameters[$paramName])) {
                $value = $parameters[$paramName];
                $parameters[$paramName] = $paramSpec;
                $parameters[$paramName]['value'] = $value;
                unset($parameters[$paramName]['required']);
            } else {
                // Ensure we don't pass nulls.
                unset($parameters[$paramName]);
            }
        }

        $this->client->log(
            'Service Call',
            Logger::INFO,
            array(
                'service' => $this->serviceName,
                'resource' => $this->resourceName,
                'method' => $name,
                'arguments' => $parameters,
            )
        );

        // build the service uri
        $url = $this->createRequestUri(
            $method['path'],
            $parameters
        );

        $request = new Request(
            $method['httpMethod'],
            $url,
            ['content-type' => 'application/json'],
            $postBody ? json_encode($postBody) : ''
        );

        return $this->client->execute($request, $expectedClass);
    }

    protected function convertToArrayAndStripNulls($o)
    {
        $o = (array)$o;
        foreach ($o as $k => $v) {
            if ($v === null) {
                unset($o[$k]);
            } elseif (is_object($v) || is_array($v)) {
                $o[$k] = $this->convertToArrayAndStripNulls($o[$k]);
            }
        }
        return $o;
    }

    /**
     * Parse/expand request parameters and create a fully qualified
     * request uri.
     *
     * @param string $restPath
     * @param array  $params
     *
     * @return string $requestUrl
     */
    private function createRequestUri($restPath, $params)
    {
        // Override the default servicePath address if the $restPath use a /
        if ('/' == substr($restPath, 0, 1)) {
            $requestUrl = substr($restPath, 1);
        } else {
            $requestUrl = $restPath;
        }

        // code for leading slash
        if ($this->rootUrl) {
            if ('/' !== substr($this->rootUrl, -1) && '/' !== substr($requestUrl, 0, 1)) {
                $requestUrl = '/' . $requestUrl;
            }
            $requestUrl = $this->rootUrl . $requestUrl;
        }

        $queryVars = array();
        foreach ($params as $paramName => $paramSpec) {
            if ($paramSpec['type'] == 'boolean') {
                $paramSpec['value'] = $paramSpec['value'] ? 'true' : 'false';
            }
            if ($paramSpec['location'] == 'query') {
                if (is_array($paramSpec['value'])) {
                    foreach ($paramSpec['value'] as $value) {
                        $queryVars[] = $paramName . '=' . rawurlencode(rawurldecode($value));
                    }
                } else {
                    $queryVars[] = $paramName . '=' . rawurlencode(rawurldecode($paramSpec['value']));
                }
            }
        }

        if (count($queryVars)) {
            $requestUrl .= '?' . implode('&', $queryVars);
        }

        return $requestUrl;
    }
}

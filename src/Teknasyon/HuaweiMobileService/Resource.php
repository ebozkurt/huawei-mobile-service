<?php

/**
 * Copyright 2010 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Teknasyon\HuaweiMobileService;

use GuzzleHttp\Psr7\Request;
use Teknasyon\HuaweiMobileService\HuaweiClient as Client;
use Teknasyon\HuaweiMobileService\InAppPurchase\Exceptions\HuaweiException;

/**
 * Implements the actual methods/resources of the discovered Google API using magic function
 * calling overloading (__call()), which on call will see if the method name (plus.activities.list)
 * is available in this service, and if so construct an apiHttpRequest representing it.
 *
 */
class Resource
{
    /** @var string $rootUrl */
    private $rootUrl;

    /** @var Client $client */
    private $client;

    /** @var string $serviceName */
    private $serviceName;

    /** @var string $servicePath */
    private $servicePath;

    /** @var string $resourceName */
    private $resourceName;

    /** @var array $methods */
    private $methods;

    public function __construct($service, $serviceName, $resourceName, $resource)
    {
        $this->rootUrl = $service->rootUrl;
        $this->client = $service->getClient();
        $this->servicePath = $service->servicePath;
        $this->serviceName = $serviceName;
        $this->resourceName = $resourceName;
        $this->methods = is_array($resource) && isset($resource['methods'])
            ?
            $resource['methods']
            :
            array($resourceName => $resource);
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @param $expectedClass - optional, the expected class name
     *
     * @return Google_Http_Request|expectedClass
     * @throws HuaweiException
     * @throws \Google_Exception
     */
    public function call($name, $arguments, $expectedClass = null)
    {
        if (!isset($this->methods[$name])) {
            $this->client->getLogger()->error(
                'Service method unknown',
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
            if ($parameters['postBody'] instanceof \Google_Model) {
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
                $this->client->getLogger()->error(
                    'Service parameter unknown',
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
                $this->client->getLogger()->error(
                    'Service parameter missing',
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

        $this->client->getLogger()->info(
            'Service Call',
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

        // NOTE: because we're creating the request by hand,
        // and because the service has a rootUrl property
        // the "base_uri" of the Http Client is not accounted for
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
     * @static
     *
     * @param string $restPath
     * @param array  $params
     *
     * @return string $requestUrl
     */
    public function createRequestUri($restPath, $params)
    {
        // Override the default servicePath address if the $restPath use a /
        if ('/' == substr($restPath, 0, 1)) {
            $requestUrl = substr($restPath, 1);
        } else {
            $requestUrl = $this->servicePath . $restPath;
        }

        // code for leading slash
        if ($this->rootUrl) {
            if ('/' !== substr($this->rootUrl, -1) && '/' !== substr($requestUrl, 0, 1)) {
                $requestUrl = '/' . $requestUrl;
            }
            $requestUrl = $this->rootUrl . $requestUrl;
        }
        $uriTemplateVars = array();
        $queryVars = array();
        foreach ($params as $paramName => $paramSpec) {
            if ($paramSpec['type'] == 'boolean') {
                $paramSpec['value'] = $paramSpec['value'] ? 'true' : 'false';
            }
            if ($paramSpec['location'] == 'path') {
                $uriTemplateVars[$paramName] = $paramSpec['value'];
            } else {
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
        }

        if (count($uriTemplateVars)) {
            $uriTemplateParser = new Google_Utils_UriTemplate();
            $requestUrl = $uriTemplateParser->parse($requestUrl, $uriTemplateVars);
        }

        if (count($queryVars)) {
            $requestUrl .= '?' . implode('&', $queryVars);
        }

        return $requestUrl;
    }
}

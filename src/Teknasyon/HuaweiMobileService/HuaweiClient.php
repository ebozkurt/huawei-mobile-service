<?php

namespace Teknasyon\HuaweiMobileService;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Monolog\Logger;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Redis;
use Teknasyon\HuaweiMobileService\InAppPurchase\Exceptions\HuaweiException;

class HuaweiClient
{

    const OAUTH2_TOKEN_URI = 'https://oauth-login.cloud.huawei.com/oauth2/v2/token';
    const ACCESS_TOKEN_KEY = 'accessTokenKey';
    const ACCESS_TOKEN_LOCK_KEY = 'accessTokenLockKey';

    /**
     * @var array
     */
    private $config;

    /**
     * @var Redis
     */
    private $redis;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Client|null
     */
    private $client = null;


    public function __construct($config, $redis = null, $logger = null)
    {
        $this->config = array_merge(
            [
                'client_id' => '',
                'client_secret' => '',
            ],
            $config
        );
        $this->redis = $redis;
        $this->logger = $logger;
        $this->client = new Client();
    }

    /**
     * @param Request $request
     * @param string  $expectedClass
     *
     * @return ResponseInterface|expectedClass
     * @throws HuaweiException
     */
    public function execute(Request $request, $expectedClass = "")
    {
        $request = $this->authorize($request);

        try {
            $response = $this->client->send($request);
        } catch (RequestException $e) {

            if (!$e->hasResponse()) {
                throw $e;
            }

            $response = $e->getResponse();

            if ($response instanceof ResponseInterface) {
                $response = new Response(
                    $response->getStatusCode(),
                    $response->getHeaders() ?: [],
                    $response->getBody(),
                    $response->getProtocolVersion(),
                    $response->getReasonPhrase()
                );
            }
        }

        return self::decodeHttpResponse($response, $request, $expectedClass);

    }

    /**
     * Decode an HTTP Response.
     *
     * @param ResponseInterface $response
     * @param RequestInterface  $request The http response to be decoded.
     * @param null              $expectedClass
     *
     * @return ResponseInterface|expectedClass
     * @throws HuaweiException
     */
    private function decodeHttpResponse(
        ResponseInterface $response,
        RequestInterface $request = null,
        $expectedClass = null
    ) {
        $code = $response->getStatusCode();

        // retry strategy
        if (intVal($code) >= 400) {
            // if we errored out, it should be safe to grab the response body
            $body = (string)$response->getBody();

            // Check if we received errors, and add those to the Exception for convenience
            throw new HuaweiException($body, $code, null);
        }

        $body = (string)$response->getBody();

        if ($expectedClass = self::determineExpectedClass($expectedClass, $request)) {
            $json = json_decode($body, true);

            // todo : an arrangement should be made to this part
            if (isset($json['inappPurchaseData'])) {
                $json = json_decode($json['inappPurchaseData'], true);
            }

            try {
                return new $expectedClass($json);
            } catch (Exception $e) {
                self::log(' Huawei Client Error : Expected Class not found', Logger::WARNING);
            }
        }

        return $response;
    }

    private static function determineExpectedClass($expectedClass, RequestInterface $request = null)
    {
        // "false" is used to explicitly prevent an expected class from being returned
        if (false === $expectedClass) {
            return null;
        }

        // if we don't have a request, we just use what's passed in
        if (null === $request) {
            return $expectedClass;
        }

        return $expectedClass;
    }

    private function authorize(Request $request)
    {
        $accessToken = $this->getAccessToken();
        if ($accessToken) {
            $request = $request->withHeader('Authorization', $this->buildAuthorization($accessToken));
        }

        return $request;
    }

    private function getAccessToken()
    {

        if (!$this->redis) {
            $token = $this->requestAccessTokenFromHuawei();
            return $token[0];
        }

        $accessToken = $this->redis->get($this->getRedisKey(self::ACCESS_TOKEN_KEY));
        if ($accessToken) {
            return $accessToken;
        }

        $lockTryCount = 0;
        do {
            $accessTokenLock = $this->redis->setnx(
                $this->getRedisKey(self::ACCESS_TOKEN_LOCK_KEY),
                date('Y-m-d H:i:s')
            );

            if ($accessTokenLock) {
                $this->redis->expire($this->getRedisKey(self::ACCESS_TOKEN_LOCK_KEY), 30);
                $newAccessTokenInfo = $this->requestAccessTokenFromHuawei();
                if (is_array($newAccessTokenInfo) && count($newAccessTokenInfo) > 0) {
                    $this->redis->set(
                        $this->getRedisKey(self::ACCESS_TOKEN_KEY),
                        $newAccessTokenInfo[0],
                        $this->getExpireTime($newAccessTokenInfo[1])
                    );
                    $this->redis->del($this->getRedisKey(self::ACCESS_TOKEN_LOCK_KEY));
                    return $newAccessTokenInfo[0];
                } else {
                    $this->redis->del($this->getRedisKey(self::ACCESS_TOKEN_LOCK_KEY));
                    return null;
                }
            }

            $accessToken = $this->redis->get($this->getRedisKey(self::ACCESS_TOKEN_KEY));
            if ($accessToken) {
                return $accessToken;
            }
            $lockTryCount++;
            if ($lockTryCount > 20) {
                return null;
            }
            sleep(1);
        } while (1);
        return null;
    }

    private function requestAccessTokenFromHuawei()
    {
        $tryCount = 0;
        do {
            $requestParams = array(
                'form_params' => array(
                    "grant_type" => "client_credentials",
                    "client_id" => $this->config['client_id'],
                    "client_secret" => $this->config['client_secret']
                )
            );

            $response = $this->client->post(self::OAUTH2_TOKEN_URI, $requestParams);
            $responseStatus = $response->getStatusCode();
            $responseBody = $response->getBody();

            $result = json_decode($responseBody, true);

            if ($responseStatus == 200 && isset($result['access_token']) && $result['access_token'] != '') {
                $this->log(
                    'Huawei Client Error, Request: ' . json_encode($requestParams) . ', Response: ' .
                    $responseBody, Logger::DEBUG
                );
                return [$result['access_token'], $result['expires_in']];
            } else {
                $this->log(
                    'Huawei Client Error, Resfresh Token Failed! HttpStatusCode: ' . $responseStatus .
                    ', Request: ' . json_encode($requestParams) . ', Response: ' . $responseBody,
                    Logger::ERROR
                );
            }

            $tryCount++;
            if ($tryCount > 4) {
                break;
            }
            usleep(500000);
        } while (1);
        return null;
    }

    /**
     * @param $expiresIn
     *
     * @return int
     */
    private function getExpireTime($expiresIn)
    {
        /**
         * 3600 - 60
         * expire time dolmasına 1 dakika kala token yenilenmesi için 60 çıkardık.
         **/
        return intval($expiresIn) - 60;
    }

    /**
     * @param $accessToken
     *
     * @return string
     */
    private function buildAuthorization($accessToken)
    {
        $oriString = "APPAT:" . $accessToken;
        $authHead = "Basic " . base64_encode(utf8_encode($oriString));
        return $authHead;
    }

    /**
     * @param string $msg
     * @param int    $level
     * @param array $context
     */
    public function log($msg, $level = Logger::INFO, $context = array())
    {
        if ($this->logger) {
            $this->logger->log($level, $msg, $context);
        }
    }

    /**
     * Set the Logger object
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Set the Redis object
     * @param Redis $redis
     */
    public function setRedis(Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param $redisKey
     *
     * @return string
     */
    private function getRedisKey($redisKey)
    {
        return 'hms_' . $this->config['client_id'] . $redisKey;
    }


}
<?php

namespace Teknasyon\HuaweiMobileService;

use Teknasyon\HuaweiMobileService\InAppPurchase\Resource\PurchasesSubscriptions;

class SubscriptionPublisher
{
    public $purchases_orders;
    public $purchases_subscriptions;
    public $cancelled_purchases;

    public $rootUrl;
    public $version;
    public $serviceName;
    private $client;

    /**
     * @param        $client
     * @param string $rootUrl The root URL used for requests to the service.
     */
    public function __construct($client, $rootUrl = null)
    {
        $this->client = $client;
        $this->rootUrl = $rootUrl ?: 'https://subscr-dre.iap.hicloud.com/';
        $this->version = 'v2';
        $this->serviceName = 'hmsPublisher';

        $this->purchases_subscriptions = new PurchasesSubscriptions(
            $this,
            'subscriptions',
            array(
                'methods' => array(
                    'stop' => array(
                        'path' => '/sub/applications/' . $this->version . '/purchases/stop',
                        'httpMethod' => 'POST',
                        'parameters' => array(),
                    ),
                    'delay' => array(
                        'path' => '/sub/applications/' . $this->version . '/purchases/delay',
                        'httpMethod' => 'POST',
                        'parameters' => array(),
                    ),
                    'get' => array(
                        'path' => 'sub/applications/' . $this->version . '/purchases/get',
                        'httpMethod' => 'POST',
                        'parameters' => array(),
                    ),
                    'returnFee' => array(
                        'path' => '/sub/applications/' . $this->version . '/purchases/returnFee',
                        'httpMethod' => 'POST',
                        'parameters' => array(),
                    ),
                    'withdrawal' => array(
                        'path' => '/sub/applications/' . $this->version . '/purchases/withdrawal',
                        'httpMethod' => 'POST',
                        'parameters' => array(),
                    ),
                )
            )
        );
    }

    public function getClient()
    {
        return $this->client;
    }

}

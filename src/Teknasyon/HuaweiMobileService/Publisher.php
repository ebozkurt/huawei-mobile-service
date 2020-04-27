<?php

namespace Teknasyon\HuaweiMobileService;

use Google_Client;
use Google_Service;
use Teknasyon\HuaweiMobileService\InAppPurchase\Resource\CancelledPurchases;
use Teknasyon\HuaweiMobileService\InAppPurchase\Resource\PurchasesOrders;
use Teknasyon\HuaweiMobileService\InAppPurchase\Resource\PurchasesSubscriptions;

class Publisher extends Google_Service
{
    public $purchases_orders;
    public $purchases_subscriptions;
    public $cancelled_purchases;

    /**
     * @param $client
     * @param string $rootUrl The root URL used for requests to the service.
     */
    public function __construct($client, $rootUrl = null)
    {
        parent::__construct($client);
        $this->rootUrl = $rootUrl ?: 'https://subscr-drru.iap.hicloud.com/';
        $this->version = 'v2';
        $this->serviceName = 'androidpublisher';

        $this->purchases_subscriptions = new PurchasesSubscriptions(
            $this,
            $this->serviceName,
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

        $this->purchases_orders = new PurchasesOrders(
            $this,
            $this->serviceName,
            'orders',
            array(
                'methods' => array(
                    'get' => array(
                        'path' => '/applications/purchases/tokens/verify',
                        'httpMethod' => 'POST',
                        'parameters' => array(),
                    ),
                )
            )
        );

        $this->cancelled_purchases = new CancelledPurchases(
            $this,
            $this->serviceName,
            'cancelled',
            array(
                'methods' => array(
                    'cancelledList' => array(
                        'path' => '/applications/' . $this->version . '/purchases/cancelledList',
                        'httpMethod' => 'POST',
                        'parameters' => array(),
                    ),
                )
            )
        );
    }
}


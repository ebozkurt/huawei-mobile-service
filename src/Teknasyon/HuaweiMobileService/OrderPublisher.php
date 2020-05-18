<?php

namespace Teknasyon\HuaweiMobileService;

use Teknasyon\HuaweiMobileService\InAppPurchase\Resource\CancelledPurchases;
use Teknasyon\HuaweiMobileService\InAppPurchase\Resource\PurchasesOrders;

class OrderPublisher
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

        $this->purchases_orders = new PurchasesOrders(
            $this,
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

    public function getClient()
    {
        return $this->client;
    }

}


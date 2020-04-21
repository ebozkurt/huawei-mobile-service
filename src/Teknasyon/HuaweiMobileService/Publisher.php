<?php

/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Teknasyon\HuaweiMobileService;

use Google_Client;
use Google_Service;
use Teknasyon\HuaweiMobileService\InAppPurchase\Resource\CancelledPurchases;
use Teknasyon\HuaweiMobileService\InAppPurchase\Resource\PurchasesOrders;
use Teknasyon\HuaweiMobileService\InAppPurchase\Resource\PurchasesSubscriptions;

/**
 * Service definition for AndroidPublisher (v3).
 *
 * <p>
 * Accesses Android application developers' Google Play accounts.</p>
 *
 * <p>
 * For more information about this service, see the API
 * <a href="https://developers.google.com/android-publisher" target="_blank">Documentation</a>
 * </p>
 *
 * @author Google, Inc.
 */
class Publisher extends Google_Service
{
    /** View and manage your Google Play Developer account. */
    const ANDROIDPUBLISHER = "https://www.googleapis.com/auth/androidpublisher";

    public $purchases_orders;
    public $purchases_subscriptions;
    public $cancelled_purchases;

    /**
     * Constructs the internal representation of the AndroidPublisher service.
     *
     * @param Google_Client $client  The client used to deliver requests.
     * @param string        $rootUrl The root URL used for requests to the service.
     */
    public function __construct(Google_Client $client, $rootUrl = null)
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


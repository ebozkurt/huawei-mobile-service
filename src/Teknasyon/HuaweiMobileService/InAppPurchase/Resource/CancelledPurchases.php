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

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Resource;

use Teknasyon\HuaweiMobileService\InAppPurchase\Exceptions\HuaweiException;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\CancelledPuchaseRequest;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\CancelledPurchaseResponse;
use Teknasyon\HuaweiMobileService\Resource;

/**
 * The "cancelledPurchases" collection of methods.
 * Typical usage is:
 *  <code>
 *   $publisherService = new Publisher(...);
 *   $subscriptions = $publisherService->purchases_orders;
 *  </code>
 */
class CancelledPurchases extends Resource
{
    /**
     * Checks the purchase and consumption status of an inapp item. (products.get)
     *
     * @param CancelledPuchaseRequest $postBody
     * @param array                   $optParams Optional parameters.
     *
     * @return expectedClass
     * @throws HuaweiException
     */
    public function cancelledList(CancelledPuchaseRequest $postBody, $optParams = array())
    {
        $params = array_merge(array('postBody' => $postBody), $optParams);
        return $this->call('cancelledList', array($params), get_class( new CancelledPurchaseResponse()));
    }
}

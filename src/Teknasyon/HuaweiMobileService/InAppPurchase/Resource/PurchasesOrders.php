<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Resource;

use Teknasyon\HuaweiMobileService\InAppPurchase\Exceptions\HuaweiException;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\OrderGetRequest;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\OrderGetResponse;
use Teknasyon\HuaweiMobileService\Resource;

/**
 * The "products" collection of methods.
 * Typical usage is:
 *  <code>
 *   $publisherService = new Publisher(...);
 *   $subscriptions = $publisherService->purchases_orders;
 *  </code>
 */
class PurchasesOrders extends Resource
{
    /**
     * Checks the purchase and consumption status of an inapp item. (products.get)
     *
     * @param OrderGetRequest $postBody
     * @param array           $optParams Optional parameters.
     *
     * @return expectedClass
     * @throws HuaweiException
     */
    public function get(OrderGetRequest $postBody, $optParams = array())
    {
        $params = array_merge(array('postBody' => $postBody), $optParams);
        return $this->call('get', array($params), get_class( new OrderGetResponse()));
    }
}

<?php

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

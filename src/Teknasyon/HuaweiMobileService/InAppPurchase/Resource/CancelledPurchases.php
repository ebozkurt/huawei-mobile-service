<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Resource;

use GuzzleHttp\Psr7\Response;
use Teknasyon\HuaweiMobileService\InAppPurchase\Exceptions\HuaweiException;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\CancelledPuchaseRequest;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\CancelledPurchaseResponse;
use Teknasyon\HuaweiMobileService\Resource;

/**
 * The "cancelledPurchases" collection of methods.
 * Typical usage is:
 *  <code>
 *   $publisherService = new Publisher(...);
 *   $cancelledPurchases = $publisherService->cancelled_purchases;
 *  </code>
 */
class CancelledPurchases extends Resource
{
    /**
     * @param CancelledPuchaseRequest $postBody
     * @param array                   $optParams Optional parameters.
     *
     * @return expectedClass|Response
     * @throws HuaweiException
     */
    public function cancelledList(CancelledPuchaseRequest $postBody, $optParams = array())
    {
        $params = array_merge(array('postBody' => $postBody), $optParams);
        return $this->call('cancelledList', array($params), get_class(new CancelledPurchaseResponse()));
    }
}

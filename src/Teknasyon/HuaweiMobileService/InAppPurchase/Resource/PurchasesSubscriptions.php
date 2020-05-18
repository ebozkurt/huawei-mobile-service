<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Resource;

use Psr\Http\Message\ResponseInterface;
use Teknasyon\HuaweiMobileService\InAppPurchase\Exceptions\HuaweiException;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\SubscriptionDelayRequest;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\SubscriptionDelayResponse;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\SubscriptionGetRequest;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\SubscriptionGetResponse;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\SubscriptionReturnFeeRequest;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\SubscriptionStopRequest;
use Teknasyon\HuaweiMobileService\InAppPurchase\Models\SubscriptionWithDrawalRequest;
use Teknasyon\HuaweiMobileService\Resource;

/**
 * The "subscriptions" collection of methods.
 * Typical usage is:
 *  <code>
 *   $publisherService = new Publisher(...);
 *   $subscriptions = $publisherService->subscriptions;
 *  </code>
 */
class PurchasesSubscriptions extends Resource
{
    /**
     * Stop a user's subscription purchase. The subscription remains valid until
     * its expiration time. (subscriptions.stop)
     *
     * @param SubscriptionStopRequest $postBody
     * @param array                   $optParams Optional parameters.
     *
     * @return ResponseInterface
     * @throws HuaweiException
     */
    public function stop(SubscriptionStopRequest $postBody, $optParams = array())
    {
        $params = array_merge(array('postBody' => $postBody), $optParams);
        return $this->call('stop', array($params));
    }

    /**
     * Delay a user's subscription purchase until a specified future expiration
     * time. (subscriptions.delay)
     *
     * @param SubscriptionDelayRequest $postBody
     * @param array                    $optParams Optional parameters.
     *
     * @return SubscriptionDelayResponse|ResponseInterface
     * @throws HuaweiException
     */
    public function delay(SubscriptionDelayRequest $postBody, $optParams = array())
    {
        $params = array_merge(array('postBody' => $postBody), $optParams);
        return $this->call('delay', array($params), get_class(new SubscriptionDelayResponse()));
    }

    /**
     * Checks whether a user's subscription purchase is valid and returns its expiry
     * time. (subscriptions.get)
     *
     * @param SubscriptionGetRequest $postBody
     * @param array                  $optParams Optional parameters.
     *
     * @return SubscriptionGetResponse|ResponseInterface
     * @throws HuaweiException
     */
    public function get(SubscriptionGetRequest $postBody, $optParams = array())
    {
        $params = array_merge(array('postBody' => $postBody), $optParams);
        return $this->call('get', array($params), get_class(new SubscriptionGetResponse()));
    }

    /**
     * ReturnFee a user's subscription purchase, but the subscription remains valid
     * until its expiration time and it will continue to recur.
     * (subscriptions.returnFee)
     *
     * @param SubscriptionReturnFeeRequest $postBody
     * @param array                        $optParams Optional parameters.
     *
     * @return ResponseInterface
     * @throws HuaweiException
     */
    public function returnFee(SubscriptionReturnFeeRequest $postBody, $optParams = array())
    {
        $params = array_merge(array('postBody' => $postBody), $optParams);
        return $this->call('returnFee', array($params));
    }

    /**
     * Refunds and immediately revokes a user's subscription purchase. Access to the
     * subscription will be terminated immediately and it will stop recurring.
     * (subscriptions.withdrawal)
     *
     * @param SubscriptionWithDrawalRequest $postBody
     * @param array                         $optParams Optional parameters.
     *
     * @return ResponseInterface
     * @throws HuaweiException
     */
    public function withdrawal(SubscriptionWithDrawalRequest $postBody, $optParams = array())
    {
        $params = array_merge(array('postBody' => $postBody), $optParams);
        return $this->call('withdrawal', array($params));
    }
}

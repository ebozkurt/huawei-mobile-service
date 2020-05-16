<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class SubscriptionWithDrawalRequest extends Model
{

    /**
     * @var string $subscriptionId
     */
    public $subscriptionId;

    /**
     * @var string $purchaseToken
     */
    public $purchaseToken;


    /**
     * @return string
     */
    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    /**
     * @param string $subscriptionId
     */
    public function setSubscriptionId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
    }

    /**
     * @return string
     */
    public function getPurchaseToken()
    {
        return $this->purchaseToken;
    }

    /**
     * @param string $purchaseToken
     */
    public function setPurchaseToken($purchaseToken)
    {
        $this->purchaseToken = $purchaseToken;
    }
}

<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class SubscriptionDelayRequest extends Model
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
     * @var int $currentExpirationTime
     */
    public $currentExpirationTime;

    /**
     * @var int $desiredExpirationTime
     */
    public $desiredExpirationTime;

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

    /**
     * @return int
     */
    public function getCurrentExpirationTime()
    {
        return $this->currentExpirationTime;
    }

    /**
     * @param int $currentExpirationTime
     */
    public function setCurrentExpirationTime($currentExpirationTime)
    {
        $this->currentExpirationTime = $currentExpirationTime;
    }

    /**
     * @return int
     */
    public function getDesiredExpirationTime()
    {
        return $this->desiredExpirationTime;
    }

    /**
     * @param int $desiredExpirationTime
     */
    public function setDesiredExpirationTime($desiredExpirationTime)
    {
        $this->desiredExpirationTime = $desiredExpirationTime;
    }

}

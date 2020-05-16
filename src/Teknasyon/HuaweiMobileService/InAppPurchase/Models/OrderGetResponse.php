<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class OrderGetResponse extends Model
{
    public $applicationId;
    public $autoRenewing;
    public $orderId;
    public $kind;
    public $packageName;
    public $productId;
    public $productName;
    public $purchaseState;
    public $developerPayload;
    public $developerChallenge;
    public $consumptionState;
    public $purchaseToken;
    public $purchaseType;
    public $currency;
    public $price;
    public $country;
    public $payType;
    public $payOrderId;
    public $lastOrderId;
    public $productGroup;
    public $purchaseTime;
    public $oriPurchaseTime;
    public $subscriptionId;
    public $oriSubscriptionId;
    public $quantity;
    public $daysLasted;
    public $numOfPeriods;
    public $numOfDiscount;
    public $expirationDate;
    public $expirationIntent;
    public $retryFlag;
    public $introductoryFlag;
    public $trialFlag;
    public $cancelTime;
    public $cancelReason;
    public $appInfo;
    public $notifyClosed;
    public $renewStatus;
    public $priceConsentStatus;
    public $renewPrice;
    public $subIsvalid;
    public $deferFlag;
    public $cancelWay;
    public $cancellationTime;
    public $cancelledSubKeepDays;
    public $confirmed;
    public $resumeTime;

    /**
     * @return mixed
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * @param mixed $applicationId
     */
    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;
    }

    /**
     * @return mixed
     */
    public function getAutoRenewing()
    {
        return $this->autoRenewing;
    }

    /**
     * @param mixed $autoRenewing
     */
    public function setAutoRenewing($autoRenewing)
    {
        $this->autoRenewing = $autoRenewing;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param mixed $kind
     */
    public function setKind($kind)
    {
        $this->kind = $kind;
    }

    /**
     * @return mixed
     */
    public function getPackageName()
    {
        return $this->packageName;
    }

    /**
     * @param mixed $packageName
     */
    public function setPackageName($packageName)
    {
        $this->packageName = $packageName;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @return mixed
     */
    public function getPurchaseState()
    {
        return $this->purchaseState;
    }

    /**
     * @param mixed $purchaseState
     */
    public function setPurchaseState($purchaseState)
    {
        $this->purchaseState = $purchaseState;
    }

    /**
     * @return mixed
     */
    public function getDeveloperPayload()
    {
        return $this->developerPayload;
    }

    /**
     * @param mixed $developerPayload
     */
    public function setDeveloperPayload($developerPayload)
    {
        $this->developerPayload = $developerPayload;
    }

    /**
     * @return mixed
     */
    public function getDeveloperChallenge()
    {
        return $this->developerChallenge;
    }

    /**
     * @param mixed $developerChallenge
     */
    public function setDeveloperChallenge($developerChallenge)
    {
        $this->developerChallenge = $developerChallenge;
    }

    /**
     * @return mixed
     */
    public function getConsumptionState()
    {
        return $this->consumptionState;
    }

    /**
     * @param mixed $consumptionState
     */
    public function setConsumptionState($consumptionState)
    {
        $this->consumptionState = $consumptionState;
    }

    /**
     * @return mixed
     */
    public function getPurchaseToken()
    {
        return $this->purchaseToken;
    }

    /**
     * @param mixed $purchaseToken
     */
    public function setPurchaseToken($purchaseToken)
    {
        $this->purchaseToken = $purchaseToken;
    }

    /**
     * @return mixed
     */
    public function getPurchaseType()
    {
        return $this->purchaseType;
    }

    /**
     * @param mixed $purchaseType
     */
    public function setPurchaseType($purchaseType)
    {
        $this->purchaseType = $purchaseType;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getPayType()
    {
        return $this->payType;
    }

    /**
     * @param mixed $payType
     */
    public function setPayType($payType)
    {
        $this->payType = $payType;
    }

    /**
     * @return mixed
     */
    public function getPayOrderId()
    {
        return $this->payOrderId;
    }

    /**
     * @param mixed $payOrderId
     */
    public function setPayOrderId($payOrderId)
    {
        $this->payOrderId = $payOrderId;
    }

    /**
     * @return mixed
     */
    public function getLastOrderId()
    {
        return $this->lastOrderId;
    }

    /**
     * @param mixed $lastOrderId
     */
    public function setLastOrderId($lastOrderId)
    {
        $this->lastOrderId = $lastOrderId;
    }

    /**
     * @return mixed
     */
    public function getProductGroup()
    {
        return $this->productGroup;
    }

    /**
     * @param mixed $productGroup
     */
    public function setProductGroup($productGroup)
    {
        $this->productGroup = $productGroup;
    }

    /**
     * @return mixed
     */
    public function getPurchaseTime()
    {
        return $this->purchaseTime;
    }

    /**
     * @param mixed $purchaseTime
     */
    public function setPurchaseTime($purchaseTime)
    {
        $this->purchaseTime = $purchaseTime;
    }

    /**
     * @return mixed
     */
    public function getOriPurchaseTime()
    {
        return $this->oriPurchaseTime;
    }

    /**
     * @param mixed $oriPurchaseTime
     */
    public function setOriPurchaseTime($oriPurchaseTime)
    {
        $this->oriPurchaseTime = $oriPurchaseTime;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    /**
     * @param mixed $subscriptionId
     */
    public function setSubscriptionId($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
    }

    /**
     * @return mixed
     */
    public function getOriSubscriptionId()
    {
        return $this->oriSubscriptionId;
    }

    /**
     * @param mixed $oriSubscriptionId
     */
    public function setOriSubscriptionId($oriSubscriptionId)
    {
        $this->oriSubscriptionId = $oriSubscriptionId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getDaysLasted()
    {
        return $this->daysLasted;
    }

    /**
     * @param mixed $daysLasted
     */
    public function setDaysLasted($daysLasted)
    {
        $this->daysLasted = $daysLasted;
    }

    /**
     * @return mixed
     */
    public function getNumOfPeriods()
    {
        return $this->numOfPeriods;
    }

    /**
     * @param mixed $numOfPeriods
     */
    public function setNumOfPeriods($numOfPeriods)
    {
        $this->numOfPeriods = $numOfPeriods;
    }

    /**
     * @return mixed
     */
    public function getNumOfDiscount()
    {
        return $this->numOfDiscount;
    }

    /**
     * @param mixed $numOfDiscount
     */
    public function setNumOfDiscount($numOfDiscount)
    {
        $this->numOfDiscount = $numOfDiscount;
    }

    /**
     * @return mixed
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @param mixed $expirationDate
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
    }

    /**
     * @return mixed
     */
    public function getExpirationIntent()
    {
        return $this->expirationIntent;
    }

    /**
     * @param mixed $expirationIntent
     */
    public function setExpirationIntent($expirationIntent)
    {
        $this->expirationIntent = $expirationIntent;
    }

    /**
     * @return mixed
     */
    public function getRetryFlag()
    {
        return $this->retryFlag;
    }

    /**
     * @param mixed $retryFlag
     */
    public function setRetryFlag($retryFlag)
    {
        $this->retryFlag = $retryFlag;
    }

    /**
     * @return mixed
     */
    public function getIntroductoryFlag()
    {
        return $this->introductoryFlag;
    }

    /**
     * @param mixed $introductoryFlag
     */
    public function setIntroductoryFlag($introductoryFlag)
    {
        $this->introductoryFlag = $introductoryFlag;
    }

    /**
     * @return mixed
     */
    public function getTrialFlag()
    {
        return $this->trialFlag;
    }

    /**
     * @param mixed $trialFlag
     */
    public function setTrialFlag($trialFlag)
    {
        $this->trialFlag = $trialFlag;
    }

    /**
     * @return mixed
     */
    public function getCancelTime()
    {
        return $this->cancelTime;
    }

    /**
     * @param mixed $cancelTime
     */
    public function setCancelTime($cancelTime)
    {
        $this->cancelTime = $cancelTime;
    }

    /**
     * @return mixed
     */
    public function getCancelReason()
    {
        return $this->cancelReason;
    }

    /**
     * @param mixed $cancelReason
     */
    public function setCancelReason($cancelReason)
    {
        $this->cancelReason = $cancelReason;
    }

    /**
     * @return mixed
     */
    public function getAppInfo()
    {
        return $this->appInfo;
    }

    /**
     * @param mixed $appInfo
     */
    public function setAppInfo($appInfo)
    {
        $this->appInfo = $appInfo;
    }

    /**
     * @return mixed
     */
    public function getNotifyClosed()
    {
        return $this->notifyClosed;
    }

    /**
     * @param mixed $notifyClosed
     */
    public function setNotifyClosed($notifyClosed)
    {
        $this->notifyClosed = $notifyClosed;
    }

    /**
     * @return mixed
     */
    public function getRenewStatus()
    {
        return $this->renewStatus;
    }

    /**
     * @param mixed $renewStatus
     */
    public function setRenewStatus($renewStatus)
    {
        $this->renewStatus = $renewStatus;
    }

    /**
     * @return mixed
     */
    public function getPriceConsentStatus()
    {
        return $this->priceConsentStatus;
    }

    /**
     * @param mixed $priceConsentStatus
     */
    public function setPriceConsentStatus($priceConsentStatus)
    {
        $this->priceConsentStatus = $priceConsentStatus;
    }

    /**
     * @return mixed
     */
    public function getRenewPrice()
    {
        return $this->renewPrice;
    }

    /**
     * @param mixed $renewPrice
     */
    public function setRenewPrice($renewPrice)
    {
        $this->renewPrice = $renewPrice;
    }

    /**
     * @return mixed
     */
    public function getSubIsvalid()
    {
        return $this->subIsvalid;
    }

    /**
     * @param mixed $subIsvalid
     */
    public function setSubIsvalid($subIsvalid)
    {
        $this->subIsvalid = $subIsvalid;
    }

    /**
     * @return mixed
     */
    public function getDeferFlag()
    {
        return $this->deferFlag;
    }

    /**
     * @param mixed $deferFlag
     */
    public function setDeferFlag($deferFlag)
    {
        $this->deferFlag = $deferFlag;
    }

    /**
     * @return mixed
     */
    public function getCancelWay()
    {
        return $this->cancelWay;
    }

    /**
     * @param mixed $cancelWay
     */
    public function setCancelWay($cancelWay)
    {
        $this->cancelWay = $cancelWay;
    }

    /**
     * @return mixed
     */
    public function getCancellationTime()
    {
        return $this->cancellationTime;
    }

    /**
     * @param mixed $cancellationTime
     */
    public function setCancellationTime($cancellationTime)
    {
        $this->cancellationTime = $cancellationTime;
    }

    /**
     * @return mixed
     */
    public function getCancelledSubKeepDays()
    {
        return $this->cancelledSubKeepDays;
    }

    /**
     * @param mixed $cancelledSubKeepDays
     */
    public function setCancelledSubKeepDays($cancelledSubKeepDays)
    {
        $this->cancelledSubKeepDays = $cancelledSubKeepDays;
    }

    /**
     * @return mixed
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @param mixed $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return mixed
     */
    public function getResumeTime()
    {
        return $this->resumeTime;
    }

    /**
     * @param mixed $resumeTime
     */
    public function setResumeTime($resumeTime)
    {
        $this->resumeTime = $resumeTime;
    }
}

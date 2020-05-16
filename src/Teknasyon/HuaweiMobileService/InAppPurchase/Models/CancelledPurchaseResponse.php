<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class CancelledPurchaseResponse extends Model
{

    public $orderId;
    public $productId;
    public $purchaseTime;
    public $cancelledTime;
    public $cancelledSource;
    public $cancelledReason;

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
    public function getCancelledTime()
    {
        return $this->cancelledTime;
    }

    /**
     * @param mixed $cancelledTime
     */
    public function setCancelledTime($cancelledTime)
    {
        $this->cancelledTime = $cancelledTime;
    }

    /**
     * @return mixed
     */
    public function getCancelledSource()
    {
        return $this->cancelledSource;
    }

    /**
     * @param mixed $cancelledSource
     */
    public function setCancelledSource($cancelledSource)
    {
        $this->cancelledSource = $cancelledSource;
    }

    /**
     * @return mixed
     */
    public function getCancelledReason()
    {
        return $this->cancelledReason;
    }

    /**
     * @param mixed $cancelledReason
     */
    public function setCancelledReason($cancelledReason)
    {
        $this->cancelledReason = $cancelledReason;
    }
}

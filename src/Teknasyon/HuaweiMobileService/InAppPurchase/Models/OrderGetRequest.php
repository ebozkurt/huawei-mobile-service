<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class OrderGetRequest extends Model
{

    /**
     * @var string $subscriptionId
     */
    public $subscriptionId;

    /**
     * @var string $purchaseToken
     */
    public $productId;

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
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

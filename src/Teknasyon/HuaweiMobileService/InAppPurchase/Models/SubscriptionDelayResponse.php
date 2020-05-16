<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class SubscriptionDelayResponse extends Model
{
    public $newExpirationTime;

    /**
     * @return mixed
     */
    public function getNewExpirationTime()
    {
        return $this->newExpirationTime;
    }

    /**
     * @param mixed $newExpirationTime
     */
    public function setNewExpirationTime($newExpirationTime)
    {
        $this->newExpirationTime = $newExpirationTime;
    }


}

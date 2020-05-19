<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class CancelledPuchaseRequest extends Model
{

    const TYPE_CONSUMABLES = 0;
    const TYPE_CONSUMABLES_AND_SUBSCRIPTIONS = 1;

    /**
     * @var int $endAt
     */
    public $endAt;

    /**
     * @var int $startAt
     */
    public $startAt;

    /**
     * @var int $maxRows
     */
    public $maxRows;

    /**
     * @var string $continuationToken
     */
    public $continuationToken;

    /**
     * @var int $type
     */
    public $type;

    /**
     * @return int
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * @param int $endAt
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;
    }

    /**
     * @return int
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * @param int $startAt
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;
    }

    /**
     * @return int
     */
    public function getMaxRows()
    {
        return $this->maxRows;
    }

    /**
     * @param int $maxRows
     */
    public function setMaxRows($maxRows)
    {
        $this->maxRows = $maxRows;
    }

    /**
     * @return string
     */
    public function getContinuationToken()
    {
        return $this->continuationToken;
    }

    /**
     * @param string $continuationToken
     */
    public function setContinuationToken($continuationToken)
    {
        $this->continuationToken = $continuationToken;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}

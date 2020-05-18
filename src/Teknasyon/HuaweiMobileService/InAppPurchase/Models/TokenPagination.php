<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class TokenPagination extends Model
{
    public $nextPageToken;
    public $previousPageToken;

    public function setNextPageToken($nextPageToken)
    {
        $this->nextPageToken = $nextPageToken;
    }

    public function getNextPageToken()
    {
        return $this->nextPageToken;
    }

    public function setPreviousPageToken($previousPageToken)
    {
        $this->previousPageToken = $previousPageToken;
    }

    public function getPreviousPageToken()
    {
        return $this->previousPageToken;
    }
}

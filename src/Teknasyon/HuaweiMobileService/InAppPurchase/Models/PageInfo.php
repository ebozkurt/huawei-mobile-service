<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class PageInfo extends Model
{
    public $resultPerPage;
    public $startIndex;
    public $totalResults;

    public function setResultPerPage($resultPerPage)
    {
        $this->resultPerPage = $resultPerPage;
    }

    public function getResultPerPage()
    {
        return $this->resultPerPage;
    }

    public function setStartIndex($startIndex)
    {
        $this->startIndex = $startIndex;
    }

    public function getStartIndex()
    {
        return $this->startIndex;
    }

    public function setTotalResults($totalResults)
    {
        $this->totalResults = $totalResults;
    }

    public function getTotalResults()
    {
        return $this->totalResults;
    }
}

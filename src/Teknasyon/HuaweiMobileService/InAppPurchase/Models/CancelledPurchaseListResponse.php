<?php

namespace Teknasyon\HuaweiMobileService\InAppPurchase\Models;

class CancelledPurchaseListResponse extends Collection
{

    protected $collection_key = 'cancelledPurchases';
    protected $pageInfoType = 'PageInfo';
    protected $pageInfoDataType = '';
    protected $tokenPaginationType = 'TokenPagination';
    protected $tokenPaginationDataType = '';
    protected $voidedPurchasesType = 'CancelledPurchase';
    protected $voidedPurchasesDataType = 'array';

    /**
     * @param PageInfo
     */
    public function setPageInfo(PageInfo $pageInfo)
    {
        $this->pageInfo = $pageInfo;
    }

    /**
     * @return PageInfo
     */
    public function getPageInfo()
    {
        return $this->pageInfo;
    }

    /**
     * @param TokenPagination
     */
    public function setTokenPagination(TokenPagination $tokenPagination)
    {
        $this->tokenPagination = $tokenPagination;
    }

    /**
     * @return TokenPagination
     */
    public function getTokenPagination()
    {
        return $this->tokenPagination;
    }

    /**
     * @param TokenPagination
     */
    public function setVoidedPurchases($voidedPurchases)
    {
        $this->voidedPurchases = $voidedPurchases;
    }

    /**
     * @return CancelledPurchase
     */
    public function getVoidedPurchases()
    {
        return $this->voidedPurchases;
    }
}

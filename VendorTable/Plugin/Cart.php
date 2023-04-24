<?php

namespace Codilar\VendorTable\Plugin;



class Cart{
    public function beforeAddProduct(\Magento\Checkout\Model\Cart $subject,$productInfo,$requestInfo = null)  
    {
        $requestInfo['qty']= 10;
        return array ($productInfo, $requestInfo);
    }
    public function aroundAddProduct(\Magento\Checkout\Model\Cart $subject,\Closure $proceed,$productInfo,$requestInfo = null)
    {
        $requestInfo['qty']=2;
        $result=$proceed($productInfo,$requestInfo);
        return $result;
    }
}

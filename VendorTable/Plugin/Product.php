<?php

namespace Codilar\VendorTable\Plugin;

class Product
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return "After plugin " . $result;
    }
}

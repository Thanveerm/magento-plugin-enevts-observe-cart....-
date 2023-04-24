<?php
namespace Codilar\VendorTable\Block;

use Magento\Framework\View\Element\Template;
use Codilar\VendorTable\Model\ResourceModel\Vendor\Collection;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Display extends Template
{
    protected $collection;

    public function __construct(
        Template\Context $context,
        Collection $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
        $textValue = $this->_scopeConfig->getValue('demo/general/text');
        $textValue1 = $this->_scopeConfig->getValue('demo/general/enable');
     
        if($textValue1){
        // $collection->getSelect()->limit($textValue);
        $this->collection->setPageSize($textValue);
        return $this->collection;
        }
        else{
        return 1;  
        }
        
    }
   
    
}

<?php

namespace Codilar\VendorTable\Block;

use Magento\Framework\View\Element\Template;
use Codilar\VendorTable\Api\VendorRepositoryInterface;

class VendorList extends Template
{
    private $vendorRepository;

    public function __construct(
        Template\Context $context,
        VendorRepositoryInterface $vendorRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->vendorRepository = $vendorRepository;
    }

    public function getVendorList()
    {
        return $this->vendorRepository->getAllVendors();
    }
}

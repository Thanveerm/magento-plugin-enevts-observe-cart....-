<?php
namespace Codilar\VendorTable\Api;

use Codilar\VendorTable\Api\Data\VendorInterface;
// use Magento\Framework\Api\SearchCriteriaInterface;

interface VendorRepositoryInterface
{
    public function save(VendorInterface $item);

    public function getById($id);

    // public function getList(SearchCriteriaInterface $searchCriteria);

    public function delete(VendorInterface $item);

    public function deleteById($id);
   
    public function getAllVendors();
}

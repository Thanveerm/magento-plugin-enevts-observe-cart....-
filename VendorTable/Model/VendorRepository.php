<?php

namespace Codilar\VendorTable\Model;

use Codilar\VendorTable\Api\Data\VendorInterface;
use Codilar\VendorTable\Api\VendorRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Codilar\VendorTable\Model\ResourceModel\Vendor as VendorResourceModel;
use Codilar\VendorTable\Model\ResourceModel\Vendor\CollectionFactory;

class VendorRepository implements VendorRepositoryInterface
{
    private $collectionFactory;
    private $vendorResourceModel;

    public function __construct(
        CollectionFactory $collectionFactory,
        VendorResourceModel $vendorResourceModel
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->vendorResourceModel = $vendorResourceModel;
    }

    public function save(VendorInterface $item)
    {
        $this->vendorResourceModel->save($item);
        return $item;
    }

    // public function getById($id)
    // {
    //     $vendor = $this->vendorResourceModel->load($id);
    //     return $vendor;
    // }
    public function getById($id)
    {
        if (!$id) {
            throw new NoSuchEntityException(__('Unable to find Vendor with empty ID'));
        }
        $vendorCollection = $this->collectionFactory->create()->addFieldToFilter('id', $id);
        if (!$vendorCollection->getSize()) {
            throw new NoSuchEntityException(__('Unable to find Vendor with ID "%1"', $id));
        }
        $vendor = $vendorCollection->getFirstItem();
        return $vendor;
    }
    
        

    public function delete(VendorInterface $item)
    {
        $this->vendorResourceModel->delete($item);
        return true;
    }

    public function deleteById($id)
    {
        $vendor = $this->getById($id);
        if ($vendor) {
            $this->delete($vendor);
            return true;
        }
        return false;
    }

    public function getAllVendors()
    {
        return $this->collectionFactory->create()->getItems();
    }
}

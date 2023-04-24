<?php
namespace Codilar\VendorTable\Model;

use Codilar\VendorTable\Api\VendorRepositoryInterface;
use Codilar\VendorTable\Model\ResourceModel\Vendor\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var VendorRepositoryInterface
     */
    private $vendorRepository;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param VendorRepositoryInterface $vendorRepository
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        VendorRepositoryInterface $vendorRepository,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->vendorRepository = $vendorRepository;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $vendors = $this->vendorRepository->getAllVendors();
        $this->loadedData = [];

        foreach ($vendors as $vendor) {
            $this->loadedData[$vendor->getId()] = $vendor->getData();
        }

        return $this->loadedData;
    }
}

<?php

namespace Codilar\VendorTable\Observer;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;

class CartAddProductObserver implements ObserverInterface
{
    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    public function __construct(
        ManagerInterface $messageManager,
        ProductRepositoryInterface $productRepository
    ) {
        $this->messageManager = $messageManager;
        $this->productRepository = $productRepository;
    }

    public function execute(Observer $observer)
    {
        // Get the quote item that was removed from the cart
        $quoteItem = $observer->getQuoteItem();

        // Get the product ID
        $productId = $quoteItem->getProductId();

        // Load the product object
        $product = $this->productRepository->getById($productId);

        // Get the product name
        $productName = $product->getName();

        // Set the alert message
        $this->messageManager->addSuccessMessage("Product removed from cart: " . $productName);
    }
}
<?php
/** 
 * @package   Vendor_Modulename
 * @author    Ricky Thakur (Kapil Dev Singh)
 * @copyright Copyright (c) 2018 Ricky Thakur
 * @license   MIT license (see LICENSE.txt for details)
 */
namespace Codilar\VendorTable\Controller\Adminhtml\Vendor;

use Codilar\VendorTable\Model\Vendor as Entity;
use Codilar\VendorTable\Model\VendorRepository;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Vendor_Modulename::entity';

    /**
     * @var VendorRepository
     */
    private $vendorRepository;

    /**
     * Delete constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param VendorRepository $vendorRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        VendorRepository $vendorRepository
    ) {
        parent::__construct($context);
        $this->vendorRepository = $vendorRepository;
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id'); 

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                // delete
                $this->vendorRepository->deleteById($id);
                // display success message
                $this->messageManager->addSuccess(__('Entity has been deleted.'));
                // go to grid
                
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find entity to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    
    }
    
} 


<?php
/**
 * @package   Vendor_Modulename
 * @author    Ricky Thakur (Kapil Dev Singh)
 * @copyright Copyright (c) 2018 Ricky Thakur
 * @license   MIT license (see LICENSE.txt for details)
 */

namespace Codilar\VendorTable\Controller\Adminhtml\Vendor;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Codilar\VendorTable\Model\VendorRepository;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Controller\ResultFactory;

class save extends Action
{

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Codilar_VendorTable::entity';

    /**
     * @var VendorRepository
     */
    protected $_vendorRepository;
    
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var SessionManagerInterface
     */
    protected $_sessionManager;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Codilar\VendorTable\Model\VendorRepository $vendorRepository
     * @param \Magento\Framework\Session\SessionManagerInterface $sessionManager
     */
    public function __construct(
        Context $context,
        VendorRepository $vendorRepository,
        PageFactory $resultPageFactory,
        SessionManagerInterface $sessionManager
    )
    {
        parent::__construct($context);
        $this->_vendorRepository = $vendorRepository;
        $this->resultPageFactory = $resultPageFactory;
        $this->_sessionManager = $sessionManager;
    }
    
    /**
     * Save action
     */
//     public function execute()
//     {
//         $resultRedirect = $this->resultRedirectFactory->create();
//         $data = $this->getRequest()->getPost();
    
//         try {
//             $vendor = $this->_vendorRepository->getById($data['id'] ?? null);
//             $vendor->setName($data['name']);
//             $vendor->setDescription($data['description']);
//             $this->_vendorRepository->save($vendor);
    
//             //check for `back` parameter
//             if ($this->getRequest()->getParam('back')) {
//                 return $resultRedirect->setPath('*/*/edit', ['id' => $vendor->getId(), '_current' => true, '_use_rewrite' => true]);
//             }
    
//             $this->messageManager->addSuccess(__('The Vendor has been saved.'));
    
//         } catch(NoSuchEntityException $e) {
//             $this->messageManager->addError(__($e->getMessage()));
//             return $resultRedirect->setPath('*/*/');
//         } catch(\Exception $e) {
//             $this->messageManager->addError(__($e->getMessage()));
//         }
    
//         return $resultRedirect->setPath('*/*/');
//     }
// }
public function execute()
{
    $resultRedirect = $this->resultRedirectFactory->create();
    $data = $this->getRequest()->getPost();

    try {
        if (!empty($data['id'])) {
            $vendor = $this->_vendorRepository->getById($data['id']);
        } else {
            $vendor = $this->_objectManager->create('Codilar\VendorTable\Model\Vendor');
        }
        $vendor->setName($data['name']);
        $vendor->setDescription($data['description']);
        $this->_vendorRepository->save($vendor);

        //check for `back` parameter
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath('*/*/edit', ['id' => $vendor->getId(), '_current' => true, '_use_rewrite' => true]);
        }

        $this->messageManager->addSuccess(__('The Vendor has been saved.'));

    } catch(NoSuchEntityException $e) {
        $this->messageManager->addError(__($e->getMessage()));
        return $resultRedirect->setPath('*/*/');
    } catch(\Exception $e) {
        $this->messageManager->addError(__($e->getMessage()));
    }

    return $resultRedirect->setPath('*/*/');
}
}
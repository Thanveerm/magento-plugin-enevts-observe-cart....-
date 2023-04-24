<?php

namespace Codilar\VendorTable\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action;
use Codilar\VendorTable\Model\VendorFactory;
use Magento\Framework\Exception\LocalizedException;

class MassDelete extends Action
{
    /**
     * @var VendorFactory
     */
    private $vendorFactory;

    /**
     * MassDelete constructor.
     *
     * @param Action\Context $context
     * @param VendorFactory $vendorFactory
     */
    public function __construct(
        Action\Context $context,
        VendorFactory $vendorFactory
    ) {
        parent::__construct($context);
        $this->vendorFactory = $vendorFactory;
    }

    /**
     * MassDelete action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected');
        if (empty($ids)) {
            $this->messageManager->addError(__('Please select vendor(s) to delete.'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = $this->vendorFactory->create();
                    $model->load($id);
                    $model->delete();
                }
                $this->messageManager->addSuccess(__('Total of %1 vendor(s) have been deleted.', count($ids)));
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(__('We can\'t delete the vendor(s) right now. Please review the log and try again.'));
                $this->logger->critical($e);
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/');

        return $resultRedirect;
    }

    /**
     * Check for permissions
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Codilar_VendorTable::vendortable_manage');
    }
}
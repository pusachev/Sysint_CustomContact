<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Adminhtml_CustomContact_StatusController
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        Mage::getSingleton('adminhtml/session')->setData('status_data', null);
    }

    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        Mage::getSingleton('adminhtml/session')->setData('status_data', null);
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            try{
                Mage::helper('sysint_customcontact')->savePostData($data);
            } catch (Mage_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    $this->__('Item hasn\'t saved')
                );
                Mage::getSingleton('adminhtml/session')->setData('status_data', $data);
                Mage::logException($e);
                return $this->_redirect('*/*/edit');
            }
        }
        return $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        $itemId = $this->getRequest()->getParam('status_id', false);

        try {
            $model = Mage::getModel('sysint_customcontact/contact')
                ->setId($itemId);

            $model->delete();

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('sysint_customcontact')->__('Item successfully deleted')
            );

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError(
                $this->__("Item %d hasn't deleted", $itemId)
            );
            Mage::logException($e);
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(
                $this->__('Somethings went wrong')
            );
            Mage::logException($e);
        }

        $this->_redirectReferer();
    }

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('status_ids');
        if(!is_array($ids)) {
            Mage::getSingleton('adminhtml/session')
                ->addError(Mage::helper('sysint_customcontact')->__('Please select id(s).'));
        } else {
            try {
                $model= Mage::getModel('sysint_customcontact/status');
                foreach ($ids as $id) {
                    $model->setId($id)->delete();

                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('sysint_customcontact')->__(
                        'Total of %d record(s) were deleted.', count($ids)
                    )
                );
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError("Items hasn't deleted");
            }
        }

        $this->_redirect('*/*/index');
    }
}

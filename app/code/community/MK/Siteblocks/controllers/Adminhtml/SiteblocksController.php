<?php

class MK_Siteblocks_Adminhtml_SiteblocksController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('siteblocks/adminhtml_siteblocks'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('siteblock_id');
        Mage::register('siteblocks_block', Mage::getModel('siteblocks/siteblock')->load($id));
        $blockObject = (array) Mage::getSingleton('adminhtml/session')->getBlockObject(true);
        if (count($blockObject)) {
            Mage::registry('siteblocks_block')->setData($blockObject);
        }
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('siteblocks/adminhtml_siteblocks_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $id = $this->getRequest()->getParam('siteblock_id');
            $siteblock = Mage::getModel('siteblocks/siteblock')->load($id);
            $siteblock
                ->setData($this->getRequest()->getParams())
                ->setCreatedAt(Mage::app()->getLocale()->date())
                ->save();
            $message = ($id) ? 'Siteblock was updated successfully' : 'Siteblock was created successfully';
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('siteblocks')->__($message));
            if (!$siteblock->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('siteblocks')->__('Can not be saved siteblock.'));
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setBlockObject($siteblock->getData());
            return $this->_redirect('*/*/edit', ['siteblock_id' => $id]);
        }
        return $this->_redirect('*/*/' . $this->getRequest()->getParam('back', 'index'), ['siteblock_id' => $siteblock->getId()]);
    }

    public function deleteAction()
    {
        $siteblock = Mage::getModel('siteblocks/siteblock')
            ->setId($this->getRequest()->getParam('siteblock_id'))
            ->delete();
        if ($siteblock->getId()) Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('siteblocks')->__('Siteblock was deleted.'));
        return $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $siteblocks = $this->getRequest()->getParams();
        try {
            $siteblocks = Mage::getModel('siteblocks/siteblock')->getCollection()
                ->addFieldToFilter('siteblock_id', ['in' => $siteblocks['massaction']]);
            foreach ($siteblocks as $siteblock) {
                $siteblock->delete();
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('siteblocks')->__('Siteblocks were deleted!'));
        return $this->_redirect('*/*/');
    }

    public function massStatusAction()
    {
        $statuses = $this->getRequest()->getParams();
        try {
            $siteblocks = Mage::getModel('siteblocks/siteblock')->getCollection()
                ->addFieldToFilter('siteblock_id', ['in' => $statuses['massaction']]);
            foreach ($siteblocks as $siteblock) {
                $siteblock->setBlockStatus($statuses['block_status'])->save();
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('siteblocks')->__('Siteblocks were updated!'));
        return $this->_redirect('*/*/');
    }
}

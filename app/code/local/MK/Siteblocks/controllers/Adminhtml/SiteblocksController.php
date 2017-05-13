<?php

class MK_Siteblocks_Adminhtml_SiteblocksController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        /** в отличие от frontend контроллеров и лайаутов, в зоне админки можно прямо здесь (в экшне)
            указать блок контента */
        $this->_addContent($this->getLayout()->createBlock('siteblocks/adminhtml_siteblocks'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('block_id');
        Mage::register('siteblocks_block', Mage::getModel('siteblocks/block')->load($id));
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
            $id = $this->getRequest()->getParam('block_id');
            $block = Mage::getModel('siteblocks/block')->load($id);
            $block
                ->setData($this->getRequest()->getParams())
                ->setCreatedAt(Mage::app()->getLocale()->date())
                ->save();
            $message = ($id) ? 'Siteblock was updated successfully.' : 'Siteblock was created successfully.';
            Mage::getSingleton('adminhtml/session')->addSuccess($message);
            if (!$block->getId()) {
                Mage::getSingleton('adminhtml/session')->addError('Can not be saved Siteblock.');
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setBlockObject($block->getData());
            return $this->_redirect('*/*/edit', ['block_id' => $id]);
        }
        return $this->_redirect('*/*/' . $this->getRequest()->getParam('back', 'index'), ['block_id' => $block->getId()]);
    }

    public function deleteAction()
    {
        $block = Mage::getModel('siteblocks/block')
            ->setId($this->getRequest()->getParam('block_id'))
            ->delete();
        if ($block->getId()) {
            Mage::getSingleton('adminhtml/sission')->addSuccess('Siteblock was deleted.');
        }
        return $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $blocks = $this->getRequest()->getParams();
        try {
            $blocks = Mage::getModel('siteblocks/block')->getCollection()
                ->addFieldToFilter('block_id', ['in' => $blocks['massaction']]);
            foreach ($blocks as $block) {
                $block->delete();
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess('Siteblocks were deleted!');
        return $this->_redirect('*/*/');
    }

    public function massStatusAction()
    {
        $statuses = $this->getRequest()->getParams();
        try {
            $blocks = Mage::getModel('siteblocks/block')->getCollection()
                ->addFieldToFilter('block_id', ['in' => $statuses['massaction']]);
            foreach ($blocks as $block) {
                $block->setBlockStatus($statuses['block_status'])->save();
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess('Siteblocks were updated.');
        return $this->_redirect('*/*/');
    }
}
<?php

class MK_Siteblocks_Adminhtml_SiteblocksController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('siteblocks/adminhtml_siteblocks'));
        $this->renderLayout();
    }

    public function editAction()
    {

    }

    public function saveAction()
    {

    }

    public function deleteAction()
    {

    }

    public function massDeleteAction()
    {

    }

    public function massStatusAction()
    {

    }
}
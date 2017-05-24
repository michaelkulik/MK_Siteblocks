<?php

class MK_Siteblocks_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        var_dump(Mage::getResourceModel('siteblocks/siteblock'));
//        $this->loadLayout();
//        $this->renderLayout();
    }
}

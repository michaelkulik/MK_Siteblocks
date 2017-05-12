<?php

class MK_Siteblocks_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();

        // Вывод блока без декларация лайаута. Часто нужно при использовании Ajax запросов
        //$html = Mage::app()->getLayout()->createBlock('siteblocks/list')->setTemplate('siteblocks/list.phtml')->toHtml();
        //$this->getResponse()->setBody($html);

    }
}
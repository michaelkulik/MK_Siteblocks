<?php

class MK_Siteblocks_Model_Observer
{
    /**
     * @param $observer Varien_Event_Observer
     */
    public function checkout_cart_product_add_after($observer)
    {
        $quote_item = $observer->getEvent()->getData('quote_item')->getData();
//        $product = $observer->getEvent()->getData('product')->getData();
        $this->createSiteblock($quote_item);
    }

    public function createSiteblock($data)
    {
        try {
            $siteblock = Mage::getModel('siteblocks/siteblock');
            $siteblock
                ->setTitle($data['name'])
                ->setBlockStatus('1')
                ->setContent($data['product']->getDescription())
                ->setCreatedAt(Mage::app()->getLocale()->date())
                ->save();
            echo 'создан';
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }
}
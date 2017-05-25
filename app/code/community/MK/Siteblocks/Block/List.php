<?php

class MK_Siteblocks_Block_List extends Mage_Core_Block_Template
{
    public function getBlocks()
    {
        $items = Mage::getModel('siteblocks/siteblock')->getCollection()->addFieldToFilter('block_status', [
            'eq' => MK_Siteblocks_Model_Source_Status::ENABLED
        ]);
        $filteredItems = $items;

        // если будет не страница товара, то в current_product будет null
        if (Mage::registry('current_product') instanceof Mage_Catalog_Model_Product) {
            $filteredItems = [];
            /** @var MK_Siteblocks_Model_Siteblock $item */
            foreach ($items as $item) {
                if ($item->validate(Mage::registry('current_product'))) {
                    $filteredItems[] = $item;
                }
            }
        }
        return $filteredItems;
    }

    public function getBlockContent($siteblock)
    {
        $processor = Mage::helper('cms')->getBlockTemplateProcessor();
        return $processor->filter($siteblock->getContent());
    }

    public function getImageSrc($siteblock)
    {

    }
}
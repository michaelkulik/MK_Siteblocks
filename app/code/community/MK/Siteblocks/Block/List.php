<?php

class MK_Siteblocks_Block_List extends Mage_Core_Block_Template
{
    public function getBlocks()
    {
        return Mage::getModel('siteblocks/siteblock')->getCollection()->addFieldToFilter('block_status', [
            'eq' => MK_Siteblocks_Model_Source_Status::ENABLED
        ]);
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
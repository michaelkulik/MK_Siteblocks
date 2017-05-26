<?php

class MK_Siteblocks_Model_Source_Status
{
    const ENABLED = '1';
    const DISABLED = '0';
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => self::ENABLED, 'label'=>Mage::helper('siteblocks')->__('Yes')),
            array('value' => self::DISABLED, 'label'=>Mage::helper('siteblocks')->__('No')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            self::ENABLED => Mage::helper('siteblocks')->__('Yes'),
            self::DISABLED => Mage::helper('siteblocks')->__('No'),
        );
    }
}
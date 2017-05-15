<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /** $row - модель блока ( $row['image'] или $row->getImage() ) */
    public function render(Varien_Object $row)
    {
        if ($row->getImage()) {
            return '<img src="' . Mage::getBaseUrl('media') . 'siteblocks' . DS . $row->getImage() . '" height="auto" width="100">';
        } else {
            return 'No image';
        }
    }
}

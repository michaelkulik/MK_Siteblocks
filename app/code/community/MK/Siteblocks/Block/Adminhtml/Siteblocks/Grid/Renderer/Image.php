<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if (!$row->getImage() || $row->getImage() == 'Array') {
            return 'No image';
        } else {
            $url = Mage::getBaseUrl('media') . 'siteblocks' . DS . $row->getImage();
            return '<img src="'.$url.'" height="50" width="auto">';
        }
    }
}
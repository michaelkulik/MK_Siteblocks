<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2016 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml cms blocks content block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class MK_Siteblocks_Block_Adminhtml_Siteblocks extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_siteblocks';
        // укажем _blockGroup, так как наша админкская зона находится внутри нашего модуля, а не в Mage/Core/Adminhtml,
        // а в _prepareLayout() блок формируется так: $this->_blockGroup.'/' . $this->_controller . '_grid'
        $this->_blockGroup = 'siteblocks';
        $this->_headerText = Mage::helper('siteblocks')->__('SiteBlocks');
        $this->_addButtonLabel = Mage::helper('siteblocks')->__('Add New Siteblock');
        parent::__construct();
    }

}

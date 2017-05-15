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
 * Adminhtml cms blocks grid
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class MK_Siteblocks_Block_Adminhtml_Siteblocks_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('block_id');
        $this->setDefaultSort('block_id');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('siteblocks/block')->getCollection();
        /* @var $collection mK_Siteblocks_Model_Resource_Block_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('title', array(
            'header'    => Mage::helper('siteblocks')->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
            'type'      => 'text',
        ));

        $this->addColumn('block_status', array(
            'header'    => Mage::helper('siteblocks')->__('Status'),
            'index'     => 'block_status',
            'type'      => 'options',
            'options'   => Mage::getModel('siteblocks/source_status')->toArray(),
        ));

        $this->addColumn('image', [
            'header' => Mage::helper('siteblocks')->__('Image'),
            'index'  => 'image',
            'align'  => 'left',
            'renderer' => 'MK_Siteblocks_Block_Adminhtml_Siteblocks_Grid_Renderer_Image',
            'filter'   => false,
            'sortable' => false,
        ]);

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('siteblocks')->__('Date Created'),
            'index'     => 'creation_time',
            'type'      => 'date',
        ));

        return parent::_prepareColumns();
    }

    public function _prepareMassaction()
    {
        $this->setMassactionIdField('block_id');
        $this->getMassactionBlock()->setIdFieldName('block_id');
        $this->getMassactionBlock()
            ->addItem('delete', [
                'label' => Mage::helper('siteblocks')->__('Delete'),
                'url'   => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('siteblocks')->__('Are you sure delete selected items?')
            ])
            ->addItem('status', [
                'label' => Mage::helper('siteblocks')->__('Update Status'),
                'url'   => $this->getUrl('*/*/massStatus'),
                'additional' => ['block_status' => [
                    'name' => 'block_status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('siteblocks')->__('Status'),
                    'values' => Mage::getModel('siteblocks/source_status')->toOptionArray()
                ]],
            ]);
        return $this;
    }

    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('block_id' => $row->getId()));
    }

}

<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('siteblock_id');
        $this->setDefaultSort('siteblock_id');
        $this->setDefaultDir('ASC');
        // если в массовом действии не будет выбрано элементов
        $this->setErrorText(Mage::helper('siteblocks')->jsQuoteEscape(Mage::helper('siteblocks')->__('Please select items.')));
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('siteblocks/siteblock')->getCollection();
        /* @var $collection MK_Siteblocks_Model_Resource_Siteblock_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('title', array(
            'header'    => Mage::helper('siteblocks')->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
            'type'     => 'text',
        ));

        $this->addColumn('block_status', array(
            'header'    => Mage::helper('siteblocks')->__('Status'),
            'index'     => 'block_status',
            'type'      => 'options',
            'options'   => Mage::getModel('siteblocks/source_status')->toArray()
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('siteblocks')->__('Date Created'),
            'index'     => 'created_at',
            'type'      => 'date',
        ));

        return parent::_prepareColumns();
    }

    public function _prepareMassaction()
    {
        $this->setMassactionIdField('siteblock_id');
        $this->getMassactionBlock()->setIdFieldName('siteblock_id');
        $this->getMassactionBlock()
            ->addItem('delete', [
                'label' => Mage::helper('siteblocks')->__('Delete'),
                'url'   => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('siteblocks')->__('Are you sure delete selected items?')
            ])
            ->addItem('status', [
                'label' => Mage::helper('siteblocks')->__('Update status'),
                'url'   => $this->getUrl('*/*/massStatus'),
                'additional' => ['block_status' => [
                    'name' => 'block_status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('siteblocks')->__('Status'),
                    'values' => Mage::getModel('siteblocks/source_status')->toOptionArray()
                ]]
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
        return $this->getUrl('*/*/edit', array('siteblock_id' => $row->getId()));
    }

}

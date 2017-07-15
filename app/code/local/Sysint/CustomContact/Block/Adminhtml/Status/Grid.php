<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Block_Adminhtml_Status_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
   /** {@inheritdoc} */
    public function __construct()
    {
        parent::__construct();
        $this->setId('statusGrid');
        $this->setDefaultSort('status_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getSingleton('sysint_customcontact/status')
            ->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /** {@inheritdoc} */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'status_id',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('ID'),
                'align'     => 'right',
                'width'     => '50px',
                'index'     => 'status_id',
            )
        );

        $this->addColumn(
            'status_code',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Status Code'),
                'align'     => 'center',
                'index'     => 'status_code',
            )
        );

        $this->addColumn(
            'status_label',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Status Label'),
                'align'     =>'center',
                'index'     => 'status_label'
            )
        );

        $this->addColumn(
            'is_dafault',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Default'),
                'align'     =>'left',
                'index'     => 'is_dafault',
                'options'   => [
                    0 => Mage::helper('sysint_customcontact')->__('No'),
                    1 => Mage::helper('sysint_customcontact')->__('Yes')
                ]
            )
        );

        $this->addColumn(
            'is_active',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Status'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'is_active',
                'type'      => 'options',
                'options'   => array(
                    1 =>  Mage::helper('sysint_customcontact')->__('Enabled'),
                    0 =>  Mage::helper('sysint_customcontact')->__('Disabled'),
                ),
            )
        );

        $this->addColumn(
            'action',
            array(
                'header'    =>  Mage::helper('sysint_simpleslider')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('sysint_simpleslider')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'slide_id'
                    ),
                    array(
                        'caption'   => Mage::helper('sysint_simpleslider')->__('Delete'),
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'status_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'status_id',
                'is_system' => true,
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * @return MageKeeper_Slider_Block_Adminhtml_Slider_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('status_id');
        $this->getMassactionBlock()->setFormFieldName('status_ids');

        $this->getMassactionBlock()
            ->addItem(
                'delete',
                [
                    'label'    => Mage::helper('sysint_customcontact')->__('Delete'),
                    'url'      => $this->getUrl('*/*/massDelete'),
                    'confirm'  => Mage::helper('sysint_customcontact')->__('Are you sure?')
                ]
            );

        return $this;
    }

    /**
     * @param Sysint_SimpleSlider_Model_Slider $item
     * @return string
     */
    public function getRowUrl($item)
    {
        return $this->getUrl('*/*/edit', array(
            'status_id' => $item->getId(),
        ));
    }
}

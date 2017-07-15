<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Block_Adminhtml_Contact_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    /** {@inheritdoc} */
    public function __construct()
    {
        parent::__construct();
        $this->setId('contactsGrid');
        $this->setDefaultSort('contact_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getSingleton('sysint_customcontact/contact')
            ->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /** {@inheritdoc} */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'contact_id',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('ID'),
                'align'     => 'right',
                'width'     => '50px',
                'index'     => 'contact_id',
            )
        );

        $this->addColumn(
            'name',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Customer Name'),
                'align'     => 'center',
                'index'     => 'name',
            )
        );

        $this->addColumn(
            'email',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Customer Email'),
                'align'     =>'center',
                'index'     => 'email'
            )
        );

        $this->addColumn(
            'phone',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Customer Phone'),
                'align'     =>'center',
                'index'     => 'phone'
            )
        );

        $this->addColumn(
            'comment',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Customer comment'),
                'align'     =>'center',
                'index'     => 'comment'
            )
        );

        $this->addColumn(
            'department',
            array(
                'type'      => 'options',
                'header'    => Mage::helper('sysint_customcontact')->__('Department'),
                'align'     => 'center',
                'index'     => 'department',
                'options'   => Mage::getSingleton('sysint_customcontact/source_departments')->toArray()
            )
        );

        $this->addColumn(
            'created',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Created'),
                'align'     =>'center',
                'index'     => 'created',
            )
        );

        $this->addColumn(
            'updated',
            array(
                'header'    => Mage::helper('sysint_customcontact')->__('Updated'),
                'align'     =>'center',
                'index'     => 'updated',
            )
        );

        $this->addColumn(
            'status_id',
            array(
                'type'      => 'options',
                'header'    => Mage::helper('sysint_customcontact')->__('Status'),
                'align'     =>'center',
                'index'     => 'status_id',
                'options'   => Mage::getSingleton('sysint_customcontact/source_status')->toArray()
//                'renderer'  => 'sysint_customcontact/adminhtml_renderer_grid_status'
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
                        'field'     => 'contact_id'
                    ),
                    array(
                        'caption'   => Mage::helper('sysint_simpleslider')->__('Delete'),
                        'url'       => array('base'=> '*/*/delete'),
                        'field'     => 'contact_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'contact_id',
                'is_system' => true,
            )
        );

        return parent::_prepareColumns();
    }

    /** {@inheritdoc} */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('contact_id');
        $this->getMassactionBlock()->setFormFieldName('contact_ids');

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
            'contact_id' => $item->getId(),
        ));
    }

}
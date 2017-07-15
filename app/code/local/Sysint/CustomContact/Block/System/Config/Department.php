<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Block_System_Config_Department
    extends  Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    /** {@inheritdoc} */
    public function _prepareToRender()
    {
        $this->addColumn('name', array(
            'label' => Mage::helper('sysint_customcontact')->__('Recipient Name'),
            'style' => 'width:100px',
        ));
        $this->addColumn('email', array(
            'label' => Mage::helper('sysint_simpleslider')->__('Recipient Email'),
            'style' => 'width:100px',
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('sysint_simpleslider')->__('Add');
    }
}

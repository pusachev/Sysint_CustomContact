<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Block_Adminhtml_Status
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /** {@inheritdoc} */
    public function __construct()
    {
        $this->_controller = 'adminhtml_status';
        $this->_blockGroup = 'sysint_customcontact';
        $this->_headerText = Mage::helper('sysint_customcontact')->__('Sttaus grid');
        $this->_addButtonLabel = Mage::helper('sysint_customcontact')->__('Add item');

        parent::__construct();
    }
}
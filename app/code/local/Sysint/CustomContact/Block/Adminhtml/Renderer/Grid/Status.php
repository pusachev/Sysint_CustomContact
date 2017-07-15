<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Block_Adminhtml_Renderer_Grid_Status
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $source = Mage::getSingleton('sysint_customcontact/source_status')->toArray();

        $index = $this->_getValue($row);

        return isset($source[$index]) ? $source[$index] : Mage::helper('sysint_customcontact')->__('No Status');
    }
}
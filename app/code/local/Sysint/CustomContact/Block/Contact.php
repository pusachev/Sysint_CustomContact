<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Block_Contact extends Mage_Core_Block_Template
{

    public function getDepartments()
    {
        /** @var Sysint_CustomContact_Model_Source_Departments $source */
        $source = Mage::getSingleton('sysint_customcontact/source_departments');

        $html = '';

        foreach ($source->toOptionArray() as $item) {
            $html .= '<option value="'.$item['value'].'">'.$item['label'].'</option>';
        }

        return $html;
    }
}

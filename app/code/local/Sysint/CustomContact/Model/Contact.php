<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Model_Contact
    extends Mage_Core_Model_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init("sysint_customcontact/contact");
    }
}

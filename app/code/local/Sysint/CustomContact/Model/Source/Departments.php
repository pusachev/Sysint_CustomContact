<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Model_Source_Departments
{
    /** @var Sysint_CustomContact_Helper_Data */
    protected $helper;

    public function __construct()
    {
        $this->helper = Mage::helper('sysint_customcontact');
    }

    /** @return array */
    public function toOptionArray()
    {
        $departments = [];

        array_push($departments, [
            'label' => $this->helper->getDefaultContactName(),
            'value' => $this->helper->getDefaultContactEmail()
        ]);

        foreach ($this->helper->getDepartments() as $item) {
            array_push($departments, [
                'label' => $item['name'],
                'value' => $item['email']
            ]);
        }

        return $departments;
    }

    /** @return string[] */
    public function toArray()
    {
        $departments = [];

        $departments[$this->helper->getDefaultContactEmail()] = $this->helper->getDefaultContactName();

        foreach ($this->helper->getDepartments() as $item) {
            $departments[$item['email']] = $item['name'];
        }

        return $departments;
    }
}
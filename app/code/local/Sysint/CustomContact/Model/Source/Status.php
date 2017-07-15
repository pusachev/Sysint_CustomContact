<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Model_Source_Status
{
    protected $collection;

    public function __construct()
    {
        $this->collection = Mage::getModel('sysint_customcontact/status')
                                    ->getCollection()
                                    ->addFieldToFilter('is_active', 1);
    }

    public function toOptionArray()
    {
        $array = [];

        foreach ($this->collection as $item) {
            array_push($array, [
                'label' => $item->getStatusLabel(),
                'value' => $item->getId()
            ]);
        }

        return $array;
    }

    public function toArray()
    {
        $array = [];

        foreach ($this->collection as $item) {
           $array[$item->getId()] = $item->getStatusLabel();
        }

        return $array;
    }
}

<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
$helper = Mage::helper('sysint_customcontact');

$demoData = $helper->getDemoDataToInstall();

foreach ($demoData as $statusData) {
    $status = Mage::getModel('sysint_customcontact/status');

    $status->setData($statusData);

    try {
        $status->save();
    } catch (Mage_Exception $e) {
        Mage::logException($e);
    }
}
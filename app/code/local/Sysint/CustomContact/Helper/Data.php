<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class Sysint_CustomContact_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_DEFAULT_CONTACT_EMAIL    = 'contacts/email/recipient_email';
    const XML_PATH_DEFAULT_CONTACT_NAME     = 'contacts/email/sender_email_identity';
    const XML_PATH_DEPARTMENTS_EMAIL        = 'contacts/department_email/departments';

    /** @return string */
    public function getDefaultContactEmail()
    {
        return Mage::getStoreConfig(self::XML_PATH_DEFAULT_CONTACT_EMAIL);
    }

    /** @return string */
    public function getDefaultContactName()
    {
        return Mage::getStoreConfig(self::XML_PATH_DEFAULT_CONTACT_NAME);
    }

    /**
     * @return array
     */
    public function getDepartments()
    {
        $items =  Mage::getStoreConfig(self::XML_PATH_DEPARTMENTS_EMAIL);

        if(!empty($items)) {
            $items = unserialize($items);
        } else {
            $items = [];
        }

        return $items;
    }

    /** @return array */
    public function getDemoDataToInstall()
    {
        return [
            [
                'status_code'   => 'new',
                'status_label'  => 'New',
                'is_default'    => 1,
                'is_active'     => 1
            ],
            [
                'status_code'   => 'processed',
                'status_label'  => 'Processed',
                'is_default'    => 0,
                'is_active'     => 1
            ],
            [
                'status_code'   => 'closed',
                'status_label'  => 'Closed',
                'is_default'    => 0,
                'is_active'     => 1
            ],
            [
                'status_code'   => 'canceled',
                'status_label'  => 'Canceled',
                'is_default'    => 0,
                'is_active'     => 1
            ]
        ];
    }
}
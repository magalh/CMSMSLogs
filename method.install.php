<?php
if( !defined('CMS_VERSION') ) exit;
$this->CreatePermission(CMSMSLogs::MANAGE_PERM,'Manage CMSMSLogs');
$this->SetPreference('logfilepath', CMS_ROOT_PATH);
?>
<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(CMSMSLogs::MANAGE_PERM) ) return;

$logger = new LogIt;

echo $this->StartTabHeaders();
	echo $this->SetTabHeader('logs', "Logs");
	echo $this->SetTabHeader('settings',"Settings");
echo $this->EndTabHeaders();

echo $this->StartTabContent();
	echo $this->StartTab('logs');
	include(__DIR__.'/function.admin_logs_tab.php');
	echo $this->EndTab();

	echo $this->StartTab('settings');
	include(__DIR__.'/function.admin_settings_tab.php');
	echo $this->EndTab();
echo $this->EndTabContent();

?>
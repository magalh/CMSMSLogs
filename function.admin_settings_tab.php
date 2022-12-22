<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(CMSMSLogs::MANAGE_PERM) ) return;

if( isset($params['submit']) ) {
    $this->SetPreference('logfilepath',$params['logfilepath']);
    $this->SetMessage("Saved");
    $this->RedirectToAdminTab('settings');
}

$tpl = $smarty->CreateTemplate( $this->GetTemplateResource('admin_settings_tab.tpl'), null, null, $smarty );

$logfilepath = $this->GetPreference('logfilepath');
if(!isset($logfilepath) || $logfilepath == ''){
    $logfilepath = cms_join_path(CMS_ROOT_PATH,'tmp','logs');;
}

$smarty->assign('logfilepath',$logfilepath);
$tpl->display();



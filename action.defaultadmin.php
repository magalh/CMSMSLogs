<?php
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(YelpRank::MANAGE_PERM) ) return;
$tpl = $smarty->CreateTemplate($this->GetTemplateResource('defaultadmin.tpl'),null,null,$smarty);

$smarty->assign('yelp_api',$this->GetPreference('yelprank_api'));
	$tpl->display();
	
	if( isset($params['submit']) ) {
	 $this->SetPreference('yelprank_api',$params['yelp_api']);
	 $this->SetMessage("Saved");
	 $this->RedirectToAdminTab();	
	}
?>
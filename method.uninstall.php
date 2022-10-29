<?php
if( !defined('CMS_VERSION') ) exit;
$this->RemovePermission(MANAGE_PERM);

// and template preferences
$this->DeleteTemplate();
$this->RemovePreference('yelprank_api');
// remove all templates and template types
try {
	$types = CmsLayoutTemplateType::load_all_by_originator($this->GetName());
	foreach( $types as $type ) {
		try {
			$templates = $type->get_template_list();
			if( is_array($templates) && count($templates) ) {
				foreach( $templates as $tpl ) {
					$tpl->delete();
				}
			}
		}
		
		catch( Exception $e ) {
			debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
			audit('',$this->GetName(),'Uninstall Error: '.$e->GetMessage());
		}
		
		$type->delete();
	}
}
catch( CmsException $e ) {
	debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
    audit('',$this->GetName(),'Uninstall Error: '.$e->GetMessage());
    return FALSE;
}

?>
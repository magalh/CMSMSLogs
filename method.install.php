<?php
if( !defined('CMS_VERSION') ) exit;
$this->CreatePermission(YelpRank::MANAGE_PERM,'Manage YelpRank');

$uid = get_userid();
// YelpRank Business detail - type and template
try {
	$yelprank_detail_template_type = new CmsLayoutTemplateType();
	$yelprank_detail_template_type->set_originator($this->GetName());
	$yelprank_detail_template_type->set_name('Detail');
	$yelprank_detail_template_type->set_dflt_flag(TRUE);
	$yelprank_detail_template_type->set_lang_callback('YelpRank::page_type_lang_callback');
	$yelprank_detail_template_type->set_content_callback('YelpRank::reset_page_type_defaults');
	$yelprank_detail_template_type->set_help_callback('YelpRank::template_help_callback');
	$yelprank_detail_template_type->reset_content_to_factory();
	$yelprank_detail_template_type->save();
} catch( CmsException $e ) {
	debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
	audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

try {
	$fn = cms_join_path(dirname(__FILE__), 'templates', 'default_yelprank_detail.tpl');
	
	if ( file_exists( $fn ) )
	{
		$template = @file_get_contents($fn);
		$tpl = new CmsLayoutTemplate();
		$tpl->set_name('YelpRank Profile Detail');
		$tpl->set_owner($uid);
		$tpl->set_content($template);
		$tpl->set_type($yelprank_detail_template_type);
		$tpl->set_type_dflt(TRUE);
		$tpl->save();
	}
} catch( CmsException $e ) {
	debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
	audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

// YelpRank Reviews - type and template
try {
	$yelprank_reviews_template_type = new CmsLayoutTemplateType();
	$yelprank_reviews_template_type->set_originator($this->GetName());
	$yelprank_reviews_template_type->set_name('Reviews');
	$yelprank_reviews_template_type->set_dflt_flag(TRUE);
	$yelprank_reviews_template_type->set_lang_callback('YelpRank::page_type_lang_callback');
	$yelprank_reviews_template_type->set_content_callback('YelpRank::reset_page_type_defaults');
	$yelprank_reviews_template_type->set_help_callback('YelpRank::template_help_callback');
	$yelprank_reviews_template_type->reset_content_to_factory();
	$yelprank_reviews_template_type->save();
} catch( CmsException $e ) {
	debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
	audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

try {
	$fn = cms_join_path(dirname(__FILE__), 'templates', 'default_yelprank_reviews.tpl');
	
	if ( file_exists( $fn ) )
	{
		$template = @file_get_contents($fn);
		$tpl = new CmsLayoutTemplate();
		$tpl->set_name('YelpRank Reviews');
		$tpl->set_owner($uid);
		$tpl->set_content($template);
		$tpl->set_type($yelprank_reviews_template_type);
		$tpl->set_type_dflt(TRUE);
		$tpl->save();
	}
} catch( CmsException $e ) {
	debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
	audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}

try {
	
	$fn = cms_join_path(dirname(__FILE__), 'css', 'yelprank.css');
	$template = @file_get_contents($fn);
	
	$css_ob = new CmsLayoutStylesheet();
	$css_ob->set_name('YelpRank');
	$css_ob->set_description('CSS for YelpRank Items');
	$css_ob->set_content($template);
	$css_ob->save();
	
} catch( CmsException $e ) {
	debug_to_log(__FILE__.':'.__LINE__.' '.$e->GetMessage());
	audit('',$this->GetName(),'Installation Error: '.$e->GetMessage());
}
?>
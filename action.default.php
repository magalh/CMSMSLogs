<?php
if( !defined('CMS_VERSION') ) exit;

$themeObject = cms_utils::get_theme_object();
//$themeObject->set_action_module($module);
$txt = '<link rel="stylesheet" href="' . $this->GetModuleURLPath() . '/css/yelprank.css" type="text/css" media="screen" />';
$themeObject->add_headtext($txt);

echo str_replace('</head>', '<script type="text/javascript" src="js/another_script.js"></script></head>', $contents);
	
	
$template = null;
if (isset($params['template'])) {
    $template = trim($params['template']);
}
else {
    $tpl = CmsLayoutTemplate::load_dflt_by_type('YelpRank::Detail');
    if( !is_object($tpl) ) {
        audit('',$this->GetName(),'No default profile template found');
        return;
    }
    $template = $tpl->get_name();
}

$cache_id = '|ns'.md5(serialize($params));
$tpl = $smarty->CreateTemplate($this->GetTemplateResource($template),$cache_id,null,$smarty);

if( !$tpl->IsCached() ) {
	
	$error = null;
	$message = null;
	try{
		$API_KEY = $this->GetPreference('yelprank_api');
		if(!isset($API_KEY) || $API_KEY == ''){
				throw new \LogicException($this->Lang('error_api'));
			}
		$BIZ_ID = $params['biz'];
		if(!isset($BIZ_ID)){
				throw new \LogicException($this->Lang('error_biz'));
			}

		$query = new YelpWizard;
		$query->biz = $BIZ_ID;
		$query->yelp_key = $API_KEY;
		$result = $query->get_business();

		$pretty_response = json_decode($result);

		 if($pretty_response->error){
			 throw new \LogicException($this->Lang($pretty_response->error->code));
		 }
		
		 $pretty_response->star_css = $this->tocss($pretty_response->rating);

	}
	catch (LogicException $e) {
		$error = 1;	
		$message = $e->getMessage();
	}

	if( isset($params['field']) ) {
		echo $pretty_response->{$params['field']};
		return;
	} 
	if( isset($params['assign']) ) {
		$smarty->assign($params['assign'],$pretty_response);
		return;
	}

	$tpl->assign('message',$message);
	$tpl->assign('error',$error);
	
	
	$tpl->assign("item",$pretty_response);
}
	
	
	$tpl->display();


?>
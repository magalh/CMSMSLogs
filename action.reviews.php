<?php
if( !defined('CMS_VERSION') ) exit;

$template = null;
if (isset($params['template'])) {
    $template = trim($params['template']);
}
else {
    $tpl = CmsLayoutTemplate::load_dflt_by_type('YelpRank::Reviews');
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
		$result = $query->get_reviews();

		$pretty_response = json_decode($result);

		 if($pretty_response->error){
			 throw new \LogicException($this->Lang($pretty_response->error->code));
		 }

	}
	catch (LogicException $e) {
		$error = 1;	
		$message = $e->getMessage();
	}

	if( isset($params['assign']) ) {
		$smarty->assign($params['assign'],$pretty_response);
		return;
	}

	$tpl->assign('message',$message);
	$tpl->assign('error',$error);
	$tpl->assign("items",$pretty_response->reviews);
}
	
$tpl->display();


?>
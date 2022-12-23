<?php

if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(CMSMSLogs::MANAGE_PERM) ) return;

$startelement = 0;
$pagenum = 1;
$agelimit = -1;
$pagelimit = 10000;
$thispage = 1;

if ( isset($params['pagenum']) ) $thispage = (int)$params['pagenum'];

$tpl = $smarty->CreateTemplate($this->GetTemplateResource('admin_logs_tab.tpl'),null,null,$smarty);

$error = null;
$message = null;


//print_r($logitem);

$query = new LogQuery;
$logs = $query->GetMatches();


/*
try{

    $logfilepath = $this->GetPreference('logfilepath');
    $tpl->assign('logfilepath',$logfilepath);

    //$query = new LogQuery($logfilepath);
    //$logs = $query->GetMatches();

    // get the count
    $matchcount = count($logs);

    // calculate page variables
    $npages = (int)($matchcount / $pagelimit);
    if ( $matchcount % $pagelimit > 0 ) $npages++;
    $startoffset = ($thispage - 1)*$pagelimit;


} catch (LogicException $e) {
    $error = 1;	
    $message = $e->getMessage();
}
*/
//rsort($logs);

$tpl->assign('message',$message);
$tpl->assign('error',$error);
$tpl->assign('logs',$logs);
$tpl->display();
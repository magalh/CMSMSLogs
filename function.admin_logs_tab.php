<?php

if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission(CMSMSLogs::MANAGE_PERM) ) return;

$tpl = $smarty->CreateTemplate($this->GetTemplateResource('admin_logs_tab.tpl'),null,null,$smarty);

$error = null;
$message = null;

try{

    $logfilepath = $this->GetPreference('logfilepath');
    $tpl->assign('logfilepath',$logfilepath);

    $query = new LogQuery;
    $query->filepath = $logfilepath;
    $logs = $query->GetMatches();

} catch (LogicException $e) {
    $error = 1;	
    $message = $e->getMessage();
}


$tpl->assign('message',$message);
$tpl->assign('error',$error);
$tpl->assign('logs',$logs);
$tpl->display();

function getLines($file)
    {
        $f = fopen($file, 'r');
        if (!$f) throw new Exception();
        while ($line = fgets($f)) {
            yield $line;
        }
        fclose($f);
    }

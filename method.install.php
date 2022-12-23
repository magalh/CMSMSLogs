<?php
if( !defined('CMS_VERSION') ) exit;
$this->CreatePermission(CMSMSLogs::MANAGE_PERM,'Manage CMSMSLogs');
//$this->SetPreference('logfilepath', CMS_ROOT_PATH);

$db = $this->GetDb();
$dict = NewDataDictionary($db);
$taboptarray = array('mysql' => 'TYPE=MyISAM');
$flds = "
 id I KEY AUTO,
 name C(255),
 type C(255),
 description X,
 file C(255),
 line I,
 created ".CMS_ADODB_DT."
";
$sqlarray = $dict->CreateTableSQL(CMS_DB_PREFIX.'module_cmsmslogs',$flds,$taboptarray);
$dict->ExecuteSQLArray($sqlarray);


?>
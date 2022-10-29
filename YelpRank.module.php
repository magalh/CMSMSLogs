<?php
class YelpRank extends CMSModule
{
	const MANAGE_PERM = 'manage_yelprank';
	const API_HOST = "https://api.yelp.com";
	const BUSINESS_PATH = "/v3/businesses/";  // Business ID will come after slash.
	const SEARCH_PATH = "/v3/businesses/search"; // for future
	const REVIEWS_PATH = "/reviews"; // for future
	
	public function GetVersion() { return '1.0'; }
	public function GetFriendlyName() { return $this->Lang('friendlyname'); }
	public function GetAdminDescription() { return $this->Lang('admindescription'); }
	public function IsPluginModule() { return TRUE; }
	public function HasAdmin() { return TRUE; }
	public function VisibleToAdminUser() { return $this->CheckPermission(self::MANAGE_PERM); }
	public function GetAuthor() { return 'Pixel Solutions'; }
	public function GetAuthorEmail() { return 'info@pixelsolutions.biz'; }
	public function UninstallPreMessage() { return $this->Lang('ask_uninstall'); }
	public function GetAdminSection() { return 'extentions'; }
	public function GetDependencies() { return array('DesignManager'=>'1.1.9'); }
	public function GetHelp(){return $this->Lang("help").'<style>code { background: hsl(220, 80%, 90%); }pre {font-size: 12px;white-space: pre-wrap;min-width: 50%}</style>';}
	
	public function InitializeFrontend() {
		$this->RegisterModulePlugin();
		$this->SetParameterType('biz',CLEAN_STRING);
	}

	 public function InitializeAdmin() {
		 $this->SetParameters();
	 }
	
	function SetParameters() {
		// syntax for creating a parameter is parameter name, default value, description
		$this->CreateParameter('biz', '', $this->Lang('param_biz'));
		$this->CreateParameter('action', 'default', $this->Lang('help_action'));
		$this->CreateParameter('field', '', 'Used to display a single value into your template');
	  }
	
	public static function reset_page_type_defaults(CmsLayoutTemplateType $type)
	{
		if( $type->get_originator() != 'YelpRank' ) throw new CmsLogicException('Cannot reset contents for this template type');
		
		$fn = null;
		switch( $type->get_name() ) {
			case 'Detail':
				$fn = 'default_yelprank_detail.tpl';
				break;
			case 'Reviews':
				$fn = 'default_yelprank_reviews.tpl';
				break;
		}
		
		$fn = cms_join_path(__DIR__,'templates',$fn);
		if( file_exists($fn) ) return @file_get_contents($fn);
	}
	
	public static function page_type_lang_callback($str)
    {
        $mod = cms_utils::get_module('YelpRank');
        if( is_object($mod) ) return $mod->Lang('type_'.$str);
    }
	
	public static function template_help_callback($str)
    {
        $str = trim($str);
        $mod = cms_utils::get_module('YelpRank');
        if( is_object($mod) ) {
            $file = $mod->GetModulePath().'/doc/tpltype_'.$str.'.inc';
            if( is_file($file) ) return file_get_contents($file);
        }
    }
	
	protected function _output_header_css()
    {
        $out = '';
        $urlpath = $this->GetModuleURLPath()."/css";
        $fmt = '<link rel="stylesheet" type="text/css" href="%s/%s"/>';
        $cssfiles = array('yelprank.css');
        foreach( $cssfiles as $one ) {
            $out .= sprintf($fmt,$urlpath,$one);
        }

        return $out;
    }
	
	public function tocss($rating)
    {
        return $rating * 4;
    }

}

?>
<?php
if (!isset($gCms)) exit;
$config = cmsms()->GetConfig();
$f = $config['root_url']."/modules/CMSFoundation/assets/";
$cache_id = '|ns'.md5(serialize($params));
$compile_id = '';
$str = "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";
$str .= "<link href=\"".$f."/stylesheets/foundation.min.css\" type=\"text/css\" rel=\"stylesheet\" />\n";
$str .= "<script src=\"".$f."/javascripts/modernizr.foundation.js\" type=\"text/javascript\"></script>\n";
$str .= "<script src=\"".$f."/javascripts/foundation.min.js\" type=\"text/javascript\"></script>\n";
echo $str;
$obj = cge_utils::get_module('JQueryTools');
if( is_object($obj) )
{
$tmpl = <<<EOT
{JQueryTools action='incjs' exclude='form,ui,tablesorter,fileupload,fancybox,cluetip,lightbox,cgform,jquerytools,json'}
EOT;
echo $this->ProcessTemplateFromData($tmpl);
}
?>
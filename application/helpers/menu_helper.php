<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 

if ( ! function_exists('active_link'))
{
    function active_link($controller)
    {
        $CI =& get_instance();
         
        $class = $CI->router->fetch_class();
 
        return ($class == $controller) ? 'active' : '';
    }
}
if ( ! function_exists('utf8_urldecode'))
{
  function utf8_urldecode($str) {
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');;
  }
}

function get_sv() {
        $CI =& get_instance();
         
        $CI->load->model('mktx');
        $CI->mktx->test();
 
}
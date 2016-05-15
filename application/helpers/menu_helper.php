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

function xep_loai($stc, $dtb, $drl) {
    if( $stc >= 10 && $dtb >= 9 && $drl == 1)
        return 'Xuất sắc';
    else if( $stc >= 10 && $dtb >= 8 && $drl == 0.8)
        return 'Giỏi';
    else if( $stc >= 10 && $dtb >= 7 && $drl == 0.6)
        return 'Khá';
}

function muc_hoc_bong($stc, $dtb, $drl) {
    if( $stc >= 14 && $dtb >= 9 && $drl == 1)
        return 640000;
    else if( $stc >= 10 && $dtb >= 9 && $drl == 1)
        return 320000;
    else if( $stc >= 14 && $dtb >= 8 && $drl == 0.8)
        return 580000;
    else if( $stc >= 10 && $dtb >= 8 && $drl == 0.8)
        return 290000;
    else if( $stc >= 14 && $dtb >= 7 && $drl == 0.8)
        return 520000;
    else if( $stc >= 10 && $dtb >= 7 && $drl == 0.8)
        return 260000;
}
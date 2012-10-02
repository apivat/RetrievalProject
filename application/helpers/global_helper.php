<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function substr_utf8( $str, $start_p , $len_p){  
 return preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start_p.'}'.  
  '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len_p.'}).*#s',  
  '$1' , $str );  
};  
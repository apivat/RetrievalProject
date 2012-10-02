<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class ExLibs {
 
        function index()
        {
                ini_set('include_path',ini_get('include_path').':'.dirname(FCPATH).'/application/extlibs/');
        }
 
}
?>

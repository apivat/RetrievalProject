<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/
$route['scaffolding_trigger'] = "";
$route['default_controller'] = "home";
$route['register'] = "home/register";
$route['login'] = "home/login";
$route['logout'] = "home/logout";
$route['search'] = "home/search";
$route['resultdata'] = "home/resultdata";
$route['searchcondition'] = "home/searchcondition";
$route['detail/(:num)'] = "home/detail/$1";

//$route['tourist/search'] = "home/search";
//$route['tourist/detail/(:num)'] = "tourist/detail/$1";
//
//$route['dss'] = "dss/index";
//$route['dss/display'] = "dss/display";
//$route['dss/display/compare'] = "dss/compare";
//$route['dss/getdata'] = "dss/getdata";
//
//$route['webboard'] = "home/coming_soon";
//$route['news'] = "home/coming_soon";
//$route['gallery'] = "home/coming_soon";
//$route['about_us'] = "home/coming_soon";
//$route['contact_us'] = "home/contact_us";
//$route['default_controller'] = "home";
//$route['scaffolding_trigger'] = "";

//$route['vote/(:num)'] = "board/vote/$1";
//$route['post/(:num)'] = "board/post/$1";

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */
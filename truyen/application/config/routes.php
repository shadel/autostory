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
|	example.com/class/method/id/
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';
$route['category/(:any)/page/(:num)'] = 'category/page/$1/$2';
$route['category/(:any)'] = 'category/index/$1';
$route['page/(:num)'] = 'welcome/page/$1';
$route['truyen/(:any)/page/(:num)'] = 'story/get_page/$1/$2';
$route['truyen/(:any)/(:any)'] = 'story/get_chapter/$1/$2';
$route['truyen/themtruyen'] = 'story/new_story';
$route['truyen/(:any)'] = 'story/get/$1';
$route['auto'] = 'crawl/auto';
$route['crawl/set_story'] = 'crawl/set_story';
$route['crawl'] = 'crawl/get';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
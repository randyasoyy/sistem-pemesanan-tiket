<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// AUTH //

$route['login']    = 'auth/login';
$route['register'] = 'auth/register';
$route['logout']   = 'auth/logout';


// USER //

$route['home']              = 'home';
$route['detail/(:num)']     = 'home/detail/$1';

$route['booking/(:num)']        = 'booking/checkout/$1';
$route['booking/cancel/(:num)'] = 'booking/cancel/$1';
$route['my-tickets']            = 'booking/my_tickets';

$route['payment/(:num)']         = 'payment/pay/$1';
$route['payment/success/(:num)'] = 'payment/success/$1';


// ADMIN //

$route['admin']                             = 'admin/dashboard';
$route['admin/events']                      = 'admin/events';
$route['admin/events/create']               = 'admin/events/create';
$route['admin/events/edit/(:num)']          = 'admin/events/edit/$1';
$route['admin/events/delete/(:num)']        = 'admin/events/delete/$1';

$route['admin/users']                       = 'admin/users';
$route['admin/users/delete/(:num)']         = 'admin/users/delete/$1';
$route['admin/users/toggle_role/(:num)']    = 'admin/users/toggle_role/$1';

$route['admin/transactions']                = 'admin/transactions';
$route['admin/transactions/cancel/(:num)']  = 'admin/transactions/cancel/$1';


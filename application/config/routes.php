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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Services';
$route['admin'] = 'admin/dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['gstregisteration'] = 'services/gstregisteration';
$route['msmeregisteration'] = 'services/msmeregisteration';
$route['profesional_tax_registeration'] = 'services/profesional_tax_registeration';
$route['import_export_code'] = 'services/import_export_code';
$route['digital_signature_cert'] = 'services/digital_signature_cert';
$route['pf_esi_registeration'] = 'services/pf_esi_registeration';
$route['gem_registeration'] = 'services/gem_registeration';
$route['startup_india_registeration'] = 'services/startup_india_registeration';
$route['iso_9001_certification'] = 'services/iso_9001_certification';
$route['iso_13485_certification'] = 'services/iso_13485_certification';
$route['iso_14001_certification'] = 'services/iso_14001_certification';
$route['iso_22000_certification'] = 'services/iso_22000_certification';
$route['iso_27001_certification'] = 'services/iso_27001_certification';
$route['iso_45001_certification'] = 'services/iso_45001_certification';
$route['iso_50001_certification'] = 'services/iso_50001_certification';
$route['other_compliance_certificate'] = 'services/other_compliance_certificate';



// Admin Locations
$route['admin/location/country/add'] = 'admin/location/country_add';

$route['admin/location/country/edit/(:num)'] = 'admin/location/country_edit/$1';


$route['admin/location/country/del/(:num)'] = 'admin/location/country_del/$1';


$route['admin/staff/add'] = 'admin/staff/staff_add';
$route['admin/staff/edit/(:num)'] = 'admin/staff/staff_edit/$1';
$route['admin/staff/del/(:num)'] = 'admin/staff/staff_del/$1';


$route['admin/services/add'] = 'admin/services/services_add';
$route['admin/services/edit/(:num)'] = 'admin/services/services_edit/$1';
$route['admin/services/del/(:num)'] = 'admin/services/services_del/$1';


$route['admin/location/city/add'] = 'admin/location/city_add';
$route['admin/location/city/edit/(:num)'] = 'admin/location/city_edit/$1';
$route['admin/location/city/del/(:num)'] = 'admin/location/city_del/$1';

//Staff Locations

$route['staff'] = 'staff/Staffcontroller';



//User Locations

$route['login']   = 'dashboard/login';
$route['llp']     = 'dashboard/llp';
$route['contact'] = 'dashboard/contact';

$route['singleblog'] = 'dashboard/singleblog';


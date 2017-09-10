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
$route['default_controller'] = 'page/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/**
 * -- Backend --
 */
$route['focus'] = 'admin/index';
$route['focus/login'] = 'admin/index';
$route['focus/login/auth'] = 'admin/validate_credentials';
$route['focus/logout'] = 'admin/logout';


// Pages
$route['focus/pages'] = 'page/all';
$route['focus/pages/(:num)'] = 'page/all/$1';
$route['focus/pages/(:num)/(:num)'] = 'page/all/$1/$2';
$route['focus/pages/new'] = 'page/create';
$route['focus/pages/edit/(:num)'] = 'page/edit/$1';
$route['focus/pages/remove/(:num)'] = 'page/remove/$1';

// -- Widgets --
$route['focus/pages/(:num)/widgets'] = 'page/get_all_widget/$1';
$route['focus/widgets/remove/(:num)'] = 'widget/remove/$1';



// Cuadricula
$route['focus/cuadricula/new/(:num)'] = 'widget_cuadricula/create/$1';
$route['focus/cuadricula/edit/(:num)'] = 'widget_cuadricula/edit/$1';
$route['focus/cuadricula/(:num)'] = 'widget_cuadricula/detail/$1';

// Row
$route['focus/row/new/(:num)'] = 'widget_row/create/$1';
$route['focus/row/edit/(:num)'] = 'widget_row/edit/$1';
$route['focus/row/(:num)'] = 'widget_row/detail/$1';

// Slide
$route['focus/slide/new/(:num)'] = 'widget_slide/create/$1';
$route['focus/slide/edit/(:num)'] = 'widget_slide/edit/$1';
$route['focus/slide/(:num)'] = 'widget_slide/detail/$1';
	

// Contacts
$route['focus/contacts'] =  'contact/all';
$route['focus/contacts/(:num)'] =  'contact/all/$1';
$route['focus/contacts/remove/(:num)'] =  'contact/remove/$1';
//$route['focus/contacts/create'] =  'contact/index';

// Menu
$route['focus/menu'] =  'widget_menu/index';
$route['focus/menu/new'] =  'widget_menu/create';
$route['focus/menu/ordered'] =  'widget_menu/set_order';
$route['focus/menu/remove/(:num)'] =  'widget_menu/remove/$1';



/**
 * -- Frontend --
 * 
 * Todo contenido estatico para que no sea sobre escrito
 * ubicarlo antes de los routes de páginas
 */

// Fracciones
// $route['fracciones'] = 'fracciones/index';
// $route['fracciones/distrito'] = 'fracciones/get_por_distrito';
// $route['fracciones/cuadricula'] = 'fracciones/get_cuadricula';
// $route['fracciones/mapa-svg'] = 'fracciones/get_mapa_svg';

$route['contactanos'] = 'contact/index';


// Paginas
$route['(:any)'] = 'page/index/$1';



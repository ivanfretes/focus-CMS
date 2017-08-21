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
$route['default_controller'] = 'pages/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/**
 * -- Backend --
 */
$route['gestion'] = 'gestion_admin/index';
$route['gestion/login'] = 'gestion_admin/index';
$route['gestion/login/auth'] = 'gestion_admin/validate_credentials';
$route['gestion/logout'] = 'gestion_admin/logout';


// Pages
$route['gestion/pages'] = 'gestion_pages/all';
$route['gestion/pages/(:num)'] = 'gestion_pages/all/$1';
$route['gestion/pages/new'] = 'gestion_pages/create';
$route['gestion/pages/edit/(:num)'] = 'gestion_pages/edit/$1';
$route['gestion/pages/remove/(:num)'] = 'gestion_pages/remove/$1';

// -- Widgets --
$route['gestion/widgets/(:num)'] = 'gestion_widget/get_all/$1';
$route['gestion/pages/(:num)/widgets'] = 'gestion_widget/all/$1';
$route['gestion/widgets/remove/(:num)'] = 'gestion_widget/remove/$1';

	// e.g gestion/row/183
	$route['gestion/(:any)/(:num)'] = 'gestion_widget/get/$1/$2';

	// Cuadricula
	$route['gestion/cuadricula/new/(:num)'] = 'gestion_cuadricula/create/$1';
	$route['gestion/cuadricula/edit/(:num)'] = 'gestion_cuadricula/edit/$1';

	// Row
	$route['gestion/row/new/(:num)'] = 'gestion_row/create/$1';
	$route['gestion/row/edit/(:num)'] = 'gestion_row/edit/$1';

	// Slide
	$route['gestion/slide/new/(:num)'] = 'gestion_slide/create/$1';
	$route['gestion/slide/edit/(:num)'] = 'gestion_slide/edit/$1';

	



// Contacts
$route['gestion/contacts'] =  'gestion_contacts/index';
$route['gestion/contacts/(:num)'] =  'gestion_contacts/index/$1';
$route['gestion/contacts/detail/(:num)'] =  'gestion_contacts/get_contact/$1';
$route['gestion/contacts/create'] =  'gestion_contacts/index';

// Menu
$route['gestion/menu'] =  'gestion_menu/index';
$route['gestion/menu/new'] =  'gestion_menu/create';
$route['gestion/menu/ordered'] =  'gestion_menu/order';
$route['gestion/menu/remove'] =  'gestion_menu/remove';



/**
 * -- Frontend --
 * 
 * Todo contenido estatico para que no sea sobre escrito
 * ubicarlo antes de los routes de páginas
 */

// Fracciones
$route['fracciones'] = 'fracciones/index';
$route['fracciones/distrito'] = 'fracciones/get_por_distrito';
$route['fracciones/cuadricula'] = 'fracciones/get_cuadricula';
$route['fracciones/mapa-svg'] = 'fracciones/get_mapa_svg';

// Contacto
$route['contacto'] = 'contacts/index';
$route['contacto/send'] = 'contacts/create'; // recibimos un nuevo contacto
$route['contacto/message'] = 'contacts/get_success_msg'; // recibimos un nuevo contacto

// Infosite
$route['la-empresa'] = 'infosite/index';

// Encasular carpetas imagenes
$route['uploads'] = 'pages/index';
$route['uploads/images'] = 'pages/index';
$route['uploads/images/resized'] = 'pages/index';


// Paginas
$route['(:any)'] = 'pages/index/$1';



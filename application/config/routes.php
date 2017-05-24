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
$route['gestion/pages'] = 'gestion_pages/index';
$route['gestion/pages/add'] = 'gestion_pages/create_page';
$route['gestion/pages/edit/(:num)'] = 'gestion_pages/get_page/$1';
$route['gestion/pages/update'] = 'gestion_pages/edit_page';
$route['gestion/pages/remove'] = 'gestion_pages/remove_page';
$route['gestion/pages/(:num)'] = 'gestion_pages/index/$1'; //$1 = page number


// Components/widgets
$route['gestion/widgets/add/(:any)'] = 'gestion_widgets/create/$1';
$route['gestion/widgets/remove'] = 'gestion_widgets/remove';
$route['gestion/widgets/edit/(:any)'] = 'gestion_widgets/edit/$1';
$route['gestion/widgets/ordered'] = 'gestion_widgets/ordered';

// Lotes
$route['gestion/lotes/(:num)'] = 'gestion_lotes/index/$1';
$route['gestion/lotes/edit/(:num)/georef'] = 
									'gestion_lotes/edit_lote_georef/$1';

// Fracciones 
$route['gestion/fracciones'] = 'gestion_fracciones/index'; 
$route['gestion/fracciones/(:num)'] = 'gestion_fracciones/index/$1'; #page
$route['gestion/fracciones/edit/(:num)/georef'] = 
								'gestion_fracciones/edit_georef/$1'; 
$route['gestion/fracciones/(:num)/georef'] = 
								'gestion_fracciones/get_georef/$1'; 




// Contacts
$route['gestion/contacts'] =  'gestion_contacts/index';
$route['gestion/contacts/(:num)'] =  'gestion_contacts/index/$1';
$route['gestion/contacts/detail/(:num)'] =  'gestion_contacts/get_contact/$1';
$route['gestion/contacts/create'] =  'gestion_contacts/index';

// Menu
$route['gestion/menu'] =  'gestion_menu/index';
$route['gestion/menu/add'] =  'gestion_menu/create';
$route['gestion/menu/ordered'] =  'gestion_menu/order';
$route['gestion/menu/remove'] =  'gestion_menu/remove';



// Infosite
$route['gestion/infosite'] =  'gestion_infosite/index';
$route['gestion/infosite/edit'] =  'gestion_infosite/edit';


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

// Paginas
$route['(:any)'] = 'pages/index/$1';






/**
 * API
 */



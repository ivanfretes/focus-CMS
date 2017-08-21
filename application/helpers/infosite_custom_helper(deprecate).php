<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 *
 * @package		GestionCMS
 * @subpackage	Website/infosite
 * @category	Helpers
 * @author		Ivan Fretes
 */

/**
 * Carga los datos de la empresa y las configuraciones iniciales
 */
if (! function_exists('load_infosite')){
	function load_infosite(){
		$ci = &get_instance();
		$ci->load->model('General/infosite_model','infosite_model');
		$ci->load->library('session');

		/**
		 * Cargamos los datos del infosite en la session
		 */
		if (FALSE === $ci->session->has_userdata('data_infosite')) {
			$data_infosite = (array) $ci->infosite_model->get_infosite();
			$ci->session->set_userdata('data_infosite', $data_infosite);
		}
	}
}




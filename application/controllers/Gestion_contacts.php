<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Fretes
 */
class Gestion_contacts extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('General/Contact_model','contact_model');
	}

	/**
	 * 
	 * Listado de todos los contactos
	 * @return {void}
	 */
	public function index(){
		$this->contact_model->get_all_contacts();


		$data['main_content'] = 'admin/dashboard';
		$this->load->view('admin/template',$data);
	}


	public function get_contact($contact_id){
		$data['contact'] = $this->contact_model->get_contact($contact_id);

		// Cargamos una vista, o directamente retornamos como json
	}



}


?>
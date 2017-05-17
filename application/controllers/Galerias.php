<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Galerias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('General/galerias_model','gm');
	}

	public function index(){

	}

	public function create(){

		if ($this->session->has_userdata('login')){
			$this->gm->create();

			echo "Cargamos los datos";
		}
		else {
			redirect('gestion/login');
		}

		
	}


	
}
?>
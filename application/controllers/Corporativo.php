<?

defined('BASEPATH') OR exit('No direct script access allowed');

class Trace extends CI_Controller {

	public function __construct(){
		parent::__construct();	
		
		$this->load->model('General/corporativo_model','cm');
		$this->empresa_data = $this->cm->get_detail();
	}


	public function index(){

		$data['empresa'] = $this->empresa_data[0];

		$data['title'] = 'Nosotros';

		$this->load->view('Frontend/theme/header.php',$data);
		$this->load->view('Frondend/Page_corporativo_view.php');
		$this->load->view('Frontend/theme/footer.php');
	}

	public function contacto(){
		$data['title'] = 'La Inmobiliaria';
		$this->load->view('Frontend/theme/header.php',$data);
		
		$this->load->view('Frondend/Contacto_form_view.php');
		$this->load->view('Frontend/theme/footer.php');
	}
}

?>
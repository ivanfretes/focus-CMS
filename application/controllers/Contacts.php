<?
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	* @package GestionCMS
	* @subpackage Website/Pages/Contacts
	* @author Ivan Fretes
	*/
	class Contacts extends CI_Controller {
		
		public function __construct(){
			parent::__construct();

			$this->load->model('General/contact_model','contact_model');
		}


		/**
		 * Pagina principal de contacto
		 * @return {void}
		 */
		public function index(){
			$data['page_title'] = 'Contactános';

			// Datos estaticos de la página
			$data['page'] = array('page_title' => 'Contactános',
								  'page_subtitle' => NULL ,
								  'page_portada_url' => NULL
							);

			$data['page'] = (object) $data['page'];

			;
			$data['main_content'] = 'frontend/pages/contact';
			$this->load->view('frontend/template',$data);
		}

		/**
		 * Create a new contact 
		 * @return {string} Retorna un JSON, si se envio o no el contacto
		 */
		public function create(){

			if (NULL !== $this->input->post('contact_submit')) {
				$firstname = $this->input->post('contact_firstname');
				$lastname = $this->input->post('contact_lastname');
				$dni = $this->input->post('contact_dni');
				$phone = $this->input->post('contact_phone');
				$movil = $this->input->post('contacto_movil');
				$mail = $this->input->post('contact_mail');
				$direction = $this->input->post('contact_dir');
				$reference = $this->input->post('contact_reference');
				$description = $this->input->post('contact_description');


				/**
				 * Numero de telefono o correo deben exitir
				 */
				if (NULL !== $firstname && 
					( NULL !== $phone || NULL !== $mail )){
					$this->contact_model->create_contact($firstname,$lastname,
										$dni,$phone,$movil,$mail,$direction,
										$reference,$description,'pendiente');	

					$this->session->set_userdata('contact_success');
					redirect('contacto/message');

				}
			}
		}


		/**
		 * 
		 * Muestra el mensaje de agradecimiento al contacto
		 * @return {void}
		 */
		public function get_success_msg(){
			$data['page_title'] = 'Buenisimo, recibimos su contacto!';

			// Datos estaticos de la página
			$data['page'] = (object) 
							array('page_title' => 'Recibimos su contacto',
								  'page_subtitle' => 'En la brevedad recibira noticias nuestras' ,
								  'page_portada_url' => NULL
							);
			

			$this->load->view('frontend/template',$data);
		}
	}

?>
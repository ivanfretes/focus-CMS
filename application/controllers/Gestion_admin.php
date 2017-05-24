<?

defined('BASEPATH') OR exit('No direct script access allowed');

//require 'Auth.php';

/**
 * 
 * This class control a loggin admin
 * 
 * @author Ivan Fretes
 * @example gestion/admin/create
 * 			gestion/login
 * 			gestion/login/auth
 * 			gestion/logout
 */
class Gestion_admin extends CI_Controller { 

	/**
	 * Encrypt the string password
	 * @param {string} $password
	 */
	protected function _encrypt_password($password){
		return sha1($password);
	}


	/**
	 * Verify the user session init 
	 * 
	 * if not init session, redirect to login page
	 * else 
	 */
	public function index(){
		// Para no generar conflicto con el autoload de session
		//load_infosite();
	
		if ($this->session->has_userdata('logged_in')){
			redirect('gestion/pages');
		}
		else {
			$data['title'] = 'Inicio de Session';

			$this->load->view('admin/users/login', $data);
		}
	}


	/**
	 * Remove all session
	 * @return void
	 */
	public function logout(){
		$this->session->sess_destroy();
		redirect('gestion/login');
	}


	/**
	 * Validate send data form, the login
	 * @example gestion/login/auth
	 * 
	 * if data is incorrect reload the login
	 */
	public function validate_credentials() {	

		$this->load->model('General/user_model', 'u_m');

		$username = $this->input->post('username');
		$password = $this->_encrypt_password($this->input->post('password'));
		$is_valid = $this->u_m->validate($username, $password);


		// Verificamos que sea valido el inicio de session
		if($is_valid){
			
			$data = array(
				'username' => $username,
				'logged_in' => true
			);

			
			$this->session->set_userdata($data);

			// Cargamos el contenido de infosite por defecto si 
			// inicializamos los datos
			redirect('gestion/pages');
		}
		else { // Redirecciona al inicio de session
			// $data['title'] = 'Inicio Session';		
			// $data['message_error'] = TRUE;		
			// $this->load->view('admin/users/login', $data);	
			redirect('gestion/login');
		}
	}	
	


}
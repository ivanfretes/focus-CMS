<?

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 * Verifica el acceso, e inicia la session de acceso, en caso de que los 
 * datos sean correctos
 * 
 * @package focusCMS
 * @author Ivan Fretes
 */
class Admin extends CI_Controller { 

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
		
		// Si la session esta no esta activa, muestra la pantalla del login
		if ($this->session->has_userdata('logged_in')){
			redirect('focus/pages');
		}
		else {
			$data['title'] = 'Inicio de Session';
			$this->load->view('admin/users/user-login', $data);
		}
	}


	/**
	 * Remove all session
	 * @return void
	 */
	public function logout(){
		$this->session->sess_destroy();
		redirect('focus/login');
	}


	/**
	 * Validate send data form, the login
	 * @example focus/login/auth
	 * 
	 * if data is incorrect reload the login
	 */
	public function validate_credentials() {	

		$this->load->model('General/user_model', 'user_model');

		$username = $this->input->post('username');
		$password = $this->_encrypt_password($this->input->post('password'));
		$is_valid = $this->user_model->validate($username, $password);


		// Verificamos que sea valido el inicio de session
		if($is_valid){
			
			$data = array(
				'username' => $username,
				'logged_in' => true
			);

			$this->session->set_userdata($data);

			// Redireccionamos a la pantalla principal
			redirect('focus/pages');
		}
		else { 
			redirect('focus/login');
		}
	}	
	


}
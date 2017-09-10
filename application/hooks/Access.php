<?

/**
 * Si la session no esta activa, envia a la pantalla del login
 */

class Access {
	protected $CI;


	public function __construct(){
		$this->CI = & get_instance();

		// Si la session no esta inicializada
		if (!isset($this->CI->session))
			$this->CI->load->library('session');
	}


	/**
	 * Generamos el espacio de trabajo,
	 * Dependiendo del espacio de trabajo, genera el path de donde 
	 * llamar los datos de la vista admin/frontend
	 * 
	 * Si es la pagina cliente o el adminsitrador
	 * 
	 */
	public function space_area(){
		
		if (FALSE !== strpos($_SERVER['PHP_SELF'], '/focus/')){
			$this->CI->session->set_userdata('view', 'admin/');
			$this->_login();
		}
		else 
			$this->CI->session->set_userdata('view', 'frontend/');
	}


	// Verificamos si el usuario inicio session
	protected function _login(){
		
		if (!$this->CI->session->userdata('logged_in') && 
			FALSE == strpos($_SERVER['PATH_INFO'],'login')) {
			
			redirect(base_url('focus/login'));

		}

	}

}

?>
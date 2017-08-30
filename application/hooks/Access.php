<?

/**
 * Verifica antes de cualquier 
 */

class Access {
	var $CI;


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

		if (0 === strpos($_SERVER['PATH_INFO'], '/gestion/')){
			$this->CI->session->set_userdata('view', 'admin/');

			// Verificamos login
			$this->_login();

		}
		else 
			$this->CI->session->set_userdata('view', 'frontend/');
	}


	/**
	 * Verificamos si la carpeta no es login, y si la session esta inicializa
	 * En caso que se cumple esto, se redirecciona al login
	 */
	protected function _login(){
		// Si la session logged_in no esta inicialziada y no es path login
		if (!$this->CI->session->userdata('logged_in') && 
			FALSE == strpos($_SERVER['PATH_INFO'],'login')) {
			
			redirect(base_url('gestion/login'));

		}
	}
}

?>
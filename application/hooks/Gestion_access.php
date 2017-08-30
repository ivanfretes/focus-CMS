<?

/**
 * Verifica antes de cualquier 
 */

class Gestion_access {
	var $CI;


	public function __construct(){
		$this->CI = & get_instance();

		// Si la session no esta inicializada
		if (!isset($this->CI->session))
			$this->CI->load->library('session');
	}

	public function login(){

		if (0 === strpos($_SERVER['PATH_INFO'], '/gestion/')){

			// Por defecto generamos la vista, para el admin
			$this->CI->session->set_userdata('view', 'admin');

			// Si la session logged_in no esta inicialziada y no es path login
			if (!$this->CI->session->userdata('logged_in') && 
				FALSE == strpos($_SERVER['PATH_INFO'],'login')) {
				redirect(base_url('gestion/login'));
			}
			
		}
		else 
			$this->CI->session->set_userdata('view', 'frontend');
	}
}

?>
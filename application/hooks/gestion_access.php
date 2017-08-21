<?

/**
 * Verifica antes de cualquier 
 */

class Gestion_access {

	public function __construct(){
		$this->ci = & get_instance();
	}

	public function login(){
		/*if (0 ===  strpos($_SERVER['PATH_INFO'], '/gestion/')){



			if ($this->ci->session->has_userdata('logged_in')){
				redirect('gestion/pages');
			}
			else {
				//redirect('gestion/pages');
				//$data['title'] = 'Inicio de Session';
				//$this->load->view('admin/users/user-login', $data);
				echo 'tEST';
			}

		}*/
	}
}

?>
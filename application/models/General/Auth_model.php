<?

	class Auth_model extends  CI_Model {


		public function __construct(){
			parent::__construct();
		}


		public function iniciar_session($username,$password){
			//$this->session->set_userdata('')
			
			$this->db->where('username', $username);
			$this->db->where('password', sha1($password));
			$this->db->limit(1);
			$query = $this->db->get('page_users');

			return $query->result();
		}
	}

?>
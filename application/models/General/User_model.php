<?

	/**
	* @author Ivan Fretes
	*/
	class User_model extends CI_Model{
		
		public function __construct(){
			parent::__construct();
		}


		/**
	    * Validate the login's data with the database
	    * @param string $user_name
	    * @param string $password
	    * @return void
	    */
		public function validate($username, $password){
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$query = $this->db->get('users');

			if (1 === $query->num_rows()){
				return TRUE;
			}		
		}

	}

?>
<?
	class Corporativo_model extends CI_Model { 

		public function __construct(){
			parent::__construct();
		}

		
		public function edit($data){
			$this->db->set($data);
		}


		// Retorna los datos de la empresa
		public function get_detail(){
			$this->db->limit(1);
			$this->db->order_by('id_empresa','desc');
			$query = $this->db->get('empresa');

			return $query->result();
		}
	}

?>
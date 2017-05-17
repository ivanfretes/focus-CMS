<?
	class Galerias_model extends CI_Model { 

		

		public function create(){

			$data = array(
				'location_image' => '../img/file.png'		
			);
			$this->db->insert('images',$data);
		}

		public function edit(){
			
			$data = array(
				'location_image' => '../img/file.png'		
			);

			$this->db->set();
		}
	}

?>
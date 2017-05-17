<?

	/**
	* @author Ivan Fretes
	*/
	class Infosite_model extends CI_Model{
		
		public function __construct(){
			parent::__construct();
		}
		


		/**
		 * Crea contenido el contenido 
		 * referente a la informacion de la empresa
		 * con los contenidos en blanco
		 */
		public function create(){
			$this->db->set('page_info_name','Mi Negocio');
			$this->db->insert('page_info');
		}



		/**
		 * Retorna los datos de la empresa
		 * @return {objetc} 
		 */
		public function get_infosite(){
			$this->db->limit(1);
			$this->db->order_by('id_page_info','ASC');
			$query = $this->db->get('page_info');	

			return $query->row();
		}

	}
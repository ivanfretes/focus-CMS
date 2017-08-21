<?

	/**
	* 
	*/
	class Menu_model extends CI_Model {
		
		public function __construct(){
			parent::__construct();
		}


		/**
		 * Crea un nuevo item del menu
		 */
		public function create_menu($menu_name,$menu_link,$menu_order){

			$this->db->set('menu_name',$menu_name);
			$this->db->set('menu_link',$menu_link);
			$this->db->set('menu_order',$menu_order);

			if($this->db->insert('menu')) return TRUE;
			return FALSE;
		}



		/**
		 * Retorna un menu en particular con el nuevo ID
		 * 
		 * @param {number} $menu_id
		 * @return {object} 
		 */
		public function get_menu($menu_id){
			$this->db->where('id_menu',$menu_id);

			$query = $this->db->get('menu');
			return $query->row();
		}


		/**
		 * Elimina cualquier elemento del menu
		 * @param {number} $menu_id
		 */
		public function remove_menu($menu_id){

			$this->db->where('id_menu',$menu_id);
			$this->db->delete('menu');
		}



		/**
		 * @param {string} $menu_name
		 * @param {string} $menu_link
		 * @param {number} $menu_order
		 * 
		 * @return {boolean}
		 */
		public function edit_menu($menu_name,$menu_link,$menu_order = -1){

			$this->db->set('menu_name',$menu_name);
			$this->db->set('menu_link',$menu_link);

			if (-1 !== $menu_order)	
				$this->db->set('menu_order');

			$this->db->update('menu');



		}


		/**
		 * Lista todos los menu, existentes
		 */
		public function get_all(){
			$this->db->order_by('menu_order','asc');
			$query = $this->db->get('menu');

			return $query->result();
		}


		/**
		 * Order the menu asc
		 * @param $paramname description
		 */
		public function ordered($menu_id, $menu_order){
			$this->db->set('menu_order', $menu_order);
			$this->db->where('id_menu', $menu_id);

			$this->db->update('menu');
		}
	}

?>
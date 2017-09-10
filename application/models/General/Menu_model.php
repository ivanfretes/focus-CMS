<?

	/**
	* 
	*/
class Menu_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->table = 'menus';
	}


	/**
	 * Retorna el mayor elemento del menu, del orden generado
	 * 
	 * @return {number} 1 o el numero actual del orden
	 */
	public function get_max_order(){
		$this->db->select_max('menu_order','menu_order');
		$query = $this->db->get($this->table);
		$order = $query->row()->menu_order;

		if (!not_value($order))
			return 1;

		return intval($order);
	}

	/**
	 * Crea un nuevo item del menu
	 * 
	 * @param {array} $data : Datos del menu
	 * @return {array} : Retorna los datos insertado 
	 */
	public function create($data){
		// Orden actual del menu
		$data['menu_order'] = $this->get_max_order() + 1;
		if($this->db->insert($this->table,$data)) 
			return $data;
		
		return FALSE;
	}


	/**
	 * Retorna un menu por ID
	 * 
	 * @param {number} $id
	 * @return {object} : Datos del menu
	 */
	public function get($id){
		$this->db->where('menu_id',$id);

		$query = $this->db->get($this->table);
		return $query->row();
	}


	/**
	 * Elimina cualquier elemento del menu
	 * @param {number} $menu_id
	 * @return {boolean} 
	 */
	public function remove($id){
		$this->db->where('menu_id',$id);
		if ($this->db->delete($this->table))
			return TRUE;

		return FALSE;
	}



	/**
	 * 
	 * Edita un elemento del menu
	 * 
	 * @param {number} $id _ Id del Menu
	 * @param {array} : Elemento a ser editado
	 * @return {boolean}
	 */
	public function edit($id, $data){

		if ($this->db->update($this->table,$data))
			return TRUE;

		return FALSE;

	}


	/**
	 * Lista todos los menu, existentes
	 * 
	 * @return {array}
	 */
	public function get_all(){
		$this->db->order_by('menu_order','asc');
		$query = $this->db->get($this->table);

		return $query->result_array();
	}


	/**
	 * Ordena el menu ascendentemente
	 * 
	 * @param {number} $id : Id del Menu
	 * @param {number} $index : Nro de orden del menu
	 * @return {boolean} Si asigno el index al menu
	 */
	public function set_order($menu_id, $index){
		$this->db->set('menu_order', $index);
		$this->db->where('menu_id', $menu_id);

		if ($this->db->update($this->table))
			return TRUE;

		return FALSE;
	}
}

?>
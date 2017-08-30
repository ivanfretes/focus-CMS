<?

/**
 * -- Modelo de Páginas --
 * @package GestionCMS
 * @subpackage Website/pages
 */
class Page_model extends CI_Model {


	public function __construct(){
		parent::__construct();
		$this->table = 'page';
	}



	/**
	 * Creamos una nueva página
	 * 
	 * @param {array} $data : Datos a ser insertados en la db
	 * @return {mixed} : El id o False en caso de no insertarse la pagina 
	 */
	public function create(){
		$slug_id = $this->get_max_id() + 1;

		// Verificamos que la página que queremos crear sea index (principal)
		$data['page_date_modified'] = current_date();
		$data['page_url'] = 'pagina-sin-ser-verificada-'.$slug_id;
		$data['page_main'] = NULL;

		// Verifica si el slug ya existe a otra pagina
		if ($this->db->insert($this->table,$data)) {
			return $this->db->insert_id();
		}	

		return FALSE;

	}	



	/**
	 * Retorna el mayor Id de la tabla
	 * 
	 * @return {number}
	 */
	public function get_max_id(){
		$this->db->select_max('page_id','max_id');
		$query = $this->db->get($this->table);

		return $query->row()->max_id;
	}


	/**
	 * Actualiza la nueva pagina de inicio
	 * 
	 * @param {number} $page_main
	 * @return {mixed}
	 */
	protected function new_index_page(&$page_main){

		if (isset($page_main)){
			$this->_set_null_index_page();

			return 1;
		}	
		else
			return NULL;

	}


	/**
	 * Retorna la pagina principal
	 * 
	 * @return {object}
	 */
	public function get_index_page(){
		$this->db->where('page_main', 1);
		$query = $this->db->get($this->table);

		return $query->row();
	}


	/**
	 * Actualiza a null la pagina principal anterior 
	 * 
	 * @return {boolean} 
	 */
	protected function _set_null_index_page(){

		$this->db->set('page_main', NULL);
		if ($this->db->update($this->table))
			return TRUE;


		return FALSE;

	}


	/**
	 * Retorna la cantidad de páginas
	 * @return {number} 
	 */
	public function get_count(){
		$this->db->select('COUNT(1) AS cantPages');
		$query = $this->db->get($this->table);

		return $query->row()->cantPages;    
	}

	/**
	 * Edita una ṕagina principal
	 * 
	 * @param {string} $page_title
	 * @return
	 */
	public function edit($page_id, $data){

		// Verificamos que la página que queremos crear sea index (principal)
	    if (isset($data['page_main']))
	    	$data['page_main'] = $this->new_index_page($data['page_main']);
	    
	    $data['page_date_modified'] = current_date();
		$this->db->where('page_id',$page_id);
		if ($this->db->update($this->table,$data)) return TRUE;
		
		return FALSE;
	}	



	/**
	 * Elimina una página
	 * 
	 * @param {number} $page_id
	 */
	public function remove($page_id){
		$this->db->where('page_id', $page_id);

		if ($this->db->delete($this->table)) return TRUE;
		return FALSE;

	}

	/**
	 * Get the page by Id
	 * 
	 * @param {number} $page_id
	 * @return {object} 
	 */
	public function get($page_id){
		$this->db->where('page_id',$page_id);
		$query = $this->db->get($this->table);

		return $query->row();
	}


	/**
	 * Retorna todas las paginas
	 * @return {object}
	 */
	public function get_all($start, $cant){

		$this->db->limit($cant, $start);
		$this->db->order_by('page_date_modified', 'DESC');
		$query = $this->db->get($this->table);

		return $query->result();	
	}

	/**
	 * Retorna una pagina por su slug de URL
	 * 
	 * @param {string} $slug
	 * @return {object} : Página encontrada
	 */
	public function get_by_slug($slug){
		
		$this->db->where('page_url',trim($slug));
		$query = $this->db->get($this->table);

		return $query->row();
	}

	/**
	 * Verifica si el slug ya fue creado
	 * 
	 * @param {string} $slug 
	 * @return {boolean}
	 */
	public function get_exist_slug(&$slug){

		$page = $this->get_by_slug($slug);

		if (NULL !== $page) return TRUE;
		return FALSE;			

	}


	/**
	 * Verifica si existe una pagina
	 * 
	 * @param {number} $page_id
	 * @return {boolean}
	 */
	public function get_exist($page_id){
		if (isset($this->get($page_id)->page_id))
			return TRUE;

		return FALSE;
	}

	/**
	 * Consulta en particular, podria ser utilizada para busqueda
	 * por ejemplo
	 * 
	 * $param {array} : $data : Contiene los datos a ser buscados
	 */
	public function get_custom_query(){

	}


	

}

?>
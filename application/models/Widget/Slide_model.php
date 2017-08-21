<?

/**
 * -- Modelo de Widget Slide --
 * @package GestionCMS
 * @subpackage Website/pages
 */
class Slide_model extends CI_Model {


	public function __construct(){
		parent::__construct();
		$this->table = 'widget_slide';
	}



	/**
	 * Creamos una nueva slide
	 * 
	 * @param {number} $widget_id
	 * @return {boolean}
	 */
	public function create($widget_id, $order){
		$this->db->set('slide_order',$order);
		
		$this->db->set('widget',$widget_id);	
		if ($this->db->insert($this->table)) {
			return $this->db->insert_id();
		}	

	
		return FALSE;

	}	


	/**
	 * Edita una slide
	 * 
	 * -- Modificar --
	 * 
	 * @param {string} $widget_id 
	 * @param {array} $data :  Datos de edicion
	 * @return {boolean}
	 */
	public function edit($widget_id, $data){
		
		var_dump($data);
		return;
		$this->db->where('widget',$widget_id);
		if ($this->db->update($this->table,$data)) 
			return TRUE;
		
		return FALSE;
		
		
	}	


	/**
	 * Retorna los datos de un widget del tipo slide
	 * con el contenido de cada uno de los slides y 
	 * ordenados mediante slide_order
	 * 
	 * @param {number} $widget_id
	 * @return {array} 
	 */
	public function get_all($widget_id){
		$this->db->where('widget',$widget_id);
		$query = $this->db->get($this->table);

		return $query->result();
	}



	/**
	 * Asigna un numero a un item de la slide. ordenado
	 * 
	 * @param {number} $widget_id
	 * @param {number} $order_index
	 */
	public function set_order($widget_id,$order_index){

		$this->db->where('widget', $widget_id)
			 ->set('slide_order',$order_index);

		if ($this->db->update($this->table))
			return TRUE;

		return FALSE;
	}

	
	/**
	 * Retorna la slide en orden asc, respecto a slide_order
	 * 
	 * @return {number} $widget_id
	 * @return {number}
	 */

	public function get_last_order($widget){
		$this->db->select_max('slide_order', 'last_order')
			->where('widget',$widget_id);

		$query = $this->db->get($this->table);
		return $query->row()->last_order;
	}

}

?>
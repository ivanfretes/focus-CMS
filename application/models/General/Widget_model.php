<?

/**
 * -- Modelo Widget -- 
 * 
 * @package GestionCMS
 * @author Ivan Fretes
 * 
 */
class Widget_model extends CI_Model { 


	/**
	 * Creamos un widget sin datos
	 * solo con el id de la pagina a la cual pertenece y 
	 * asignamos por el orden por defecto
	 * 
	 * @param {number} $page_id
	 * @param {string} $widget_name : Nombre del widget a insertar
	 * @return {boolean}
	 */
	public function create($page_id,$widget_name){
		$order = 1;

		// Generamos el ultimo widget ordenado
		if (!not_value($this->get_last_order($page_id)))
			$order = $this->get_last_order($page_id) + 1;
			

		$this->db->set('widget_order',$order);
		$this->db->set('widget_type',$widget_name);
		$this->db->set('page',$page_id);
		$this->db->set('widget_date_modified', current_date());

		if ($this->db->insert($this->table)) {
			return $this->db->insert_id();
		}	
		return FALSE;
	}	



	public function __construct(){	
		parent::__construct();
		$this->table = 'widget';
	}


	/**
	 * Retorna el valor del ultimo widget ordenado(mayot)
	 * 
	 * @return {number} $page_id
	 * @return {number}d
	 */

	public function get_last_order($page_id){
		$this->db->select_max('widget_order', 'last_order')
			->where('page',$page_id);

		$query = $this->db->get($this->table);
		return $query->row()->last_order;
	}

	/**
	 * Retorna todos los widget de una pagina, ordenados
	 * por el campo widget_order
	 * 
	 * @param {number} $page_id
	 * @return {array}
	 * 
	 */
	public function get_all($page_id){
		$this->db->where('page',$page_id);
		$this->db->order_by('widget_order','asc');

		$query = $this->db->get($this->table);
		
		return $query->result_array();
	}


	/**
	 * Genera el query para ingresar a la table de un widget 
	 * en particular los datos de cualquier widget (Comodin)
	 * 
	 * @param {number} $widget_id
	 * @param {string} $widget_type : Representa el nombre de la tabla
	 * @return {mixed} Retorna todos los elementos de los widgets
	 */
	public function get_widget($widget_id, $widget_type){

		$this->db->where('widget', $widget_id);
		$query = $this->db->get('widget_'.$widget_type);

		return $query->result();
	}


	/**
	 * Retorna todos los widget por pagina
	 * 
	 * @param {number} $numero de página
	 * @return {array} : Registros de varios tipos de widget
	 */
	public function get_all_widget($page_id){
		
		$this->db->select('widget_id,widget_type, widget_slug')	
			 ->where('page', $page_id);

		$query = $this->db->get($this->table);
		$widget_list = $query->result();

		// Widgets generados, de tablas diferentes
		$widget_result = array();

		// Recorremos los widgets existentes y generamos los widget
		foreach ($widget_list as $widget_data) {

			// Retorna todos los registro/s dependiendo del tipo
			$widget_row = $this->get_widget($widget_data->widget_id,
							   				$widget_data->widget_type);
			
			// Anexamos al objeto generado, el tipo de widget
			$widget_row['type'] = $widget_data->widget_type;
			$widget_row['id'] = $widget_data->widget_id;
			$widget_row['slug'] = $widget_data->widget_slug;

			array_push($widget_result, $widget_row);
			
		}

		return $widget_result;
	}



	/**
	 * Asigna el valor correspondiente al orden de un widget
	 * 
	 * @param {number} $widget_id
	 * @param {number} $order_index : Valor del nuevo orden
	 * 
	 * @return {boolean} Si se modifico el orden
	 */
	public function set_order($widget_id,$order_index){

		$this->db->where('widget_id', $widget_id)
			 ->set('widget_order',$order_index);

		if ($this->db->update($this->table))
			return TRUE;

		return FALSE;
	}



	/**
	 * Elimina un widget
	 * 
	 * @param {number} $widget_id
	 */
	public function remove($widget_id){
		$this->db->where('widget_id', $widget_id);

		if ($this->db->delete($this->table)) 
			return TRUE;
		
		return FALSE;

	}


	/**
	 * Retorna si existe un widget
	 * 
	 * @param {number} $widget_id
	 * @return {boolean}
	 */
	public function get_exist($widget_id){
		$this->db->where('widget_id',$widget_id);
		$query = $this->db->get($this->table);

		if (NULL !== $query->row())
			return TRUE;

		return FALSE;	
	}
}

?>
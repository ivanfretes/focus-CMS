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
	 * @return {mixed} : El Widget Generado, o FALSE en caso de error
	 */
	public function create($page_id,$widget_name){

		// Valor de orden del ultimo elemento
		$order = $this->get_last_order($page_id) + 1;

		$data = array(
			'widget_order' => $order,
			'widget_slug'=> $this->get_slug(),
			'widget_type'=> $widget_name,
			'page' => $page_id 
		);

		$this->db->set('widget_date_modified', current_date());

		if ($this->db->insert($this->table, $data)) {
			$data['widget_id'] = $this->db->insert_id();
			
			return $data;
		}	

		return FALSE;
	}	


	/**
	 * Genera un slug aleatorio para los widgets
	 * @return {string}
	 */
	protected function get_slug(){
		$widget_slug = sha1(current_datetime());
		$widget_slug = substr($widget_slug, 0, 16);

		return $widget_slug;
	}


	public function __construct(){	
		parent::__construct();
		$this->table = 'widgets';
	}


	/**
	 * Retorna el valor del ultimo widget ordenado(mayor)
	 * 
	 * @return {number} $page_id
	 * @return {number}
	 */

	public function get_last_order($page_id){
		$this->db->select_max('widget_order', 'last_order')
			->where('page',$page_id);

		$query = $this->db->get($this->table);
		
		$last_order = $query->row()->last_order;
		if (!not_value($last_order))
			return $last_order; 

		return 1;
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
	 * Retorna los datos de los items de un widget
	 * 
	 * @example row, slide, cuadricula, etc
	 * 
	 * @param {number} $widget_id ,
	 * @param {string} $widget_type : Representa el nombre de la tabla
	 * @return {mixed} Retorna todos los elementos de los widgets
	 */
	public function get_widget($widget_id, $widget_type){

		$this->db->where('widget', $widget_id);
		$query = $this->db->get('widget_' . $widget_type . 's');

		return $query->result();
	}


	/**
	 * Retorna todos los widget por pagina, con sus subcomponentes
	 * 
	 * @param {number} $numero de página
	 * @return {array} : Registros de varios tipos de widget
	 */
	public function get_all_widget($page_id){
		
		// Query de listado de widgets
		$this->db->select('widget_id,widget_type,widget_slug')	
			 ->where('page', $page_id);

		$query = $this->db->get($this->table);
		$widget_list = $query->result_array();
		$widget_result = array();

		// Recorremos los widgets existentes y generamos los subwidget (row)
		// widget_row no hace referencia al widget del tipo row
		foreach ($widget_list as $widget_row) {

			// Retorna todos los registro/s dependiendo del tipo
			$widget_data = $this->get_widget(
				$widget_row['widget_id'],
				$widget_row['widget_type']
			);

			// En caso que solo el widget cuente con un elemento -> un objeto
			if (not_value($widget_data[1]))
				$widget_row['widget'] = $widget_data[0];
			else 
				$widget_row['widget'] = $widget_data;

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
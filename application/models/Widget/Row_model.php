<?

/**
 * -- Modelo de Widget row --
 * 
 * Fila como maximo de dos columnas
 * 
 * @package GestionCMS
 * @subpackage Website/pages
 */
class Row_model extends CI_Model {


	// agregar cover
	// Alineacion posible del row de dos columnas
	protected $row_align = array('left' => 'Izq.',
								 'right' => 'Der.',
								 'center' => 'Cen'); 


	/**
	 * Retorna las orientaciones del widget row
	 */
	public function get_row_align(){
		return $this->row_align;
	}

	public function __construct(){
		parent::__construct();
		$this->table = 'widget_row';
	}



	/**
	 * Creamos una nueva row, por el valor de widget_id
	 * 
	 * @param {number} $widget_id
	 * @return {boolean}
	 */
	public function create($widget_id){
		$this->db->set('widget',$widget_id);	

		if ($this->db->insert($this->table)) 
			return $this->db->insert_id();
			
		return FALSE;

	}	


	/**
	 * Edita una row
	 * 
	 * @param {string} $widget_id 
	 * @param {array} $data :  Datos de edicion
	 * @return {boolean}
	 */
	public function edit($widget_id, $data){
		
		if (!not_value($widget_id)){
	    
			$this->db->where('widget',$widget_id);
			if ($this->db->update($this->table,$data)) 
				return TRUE;
			
			return FALSE;
		}
		
	}	


	/**
	 * Retorna los datos de un widget del tipo row
	 * 
	 * @param {number} $widget_id
	 * @return {object} 
	 */
	public function get($widget_id){
		$this->db->where('widget',$widget_id);
		$query = $this->db->get($this->table);

		return $query->row();
	}


}

?>
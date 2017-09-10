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


	/**
	 * Retorna las orientaciones del widget row
	 */
	public function get_row_align(){
		return $this->row_align;
	}

	public function __construct(){
		parent::__construct();
		$this->table = 'widget_rows';
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
	 * @param {string} $row_id 
	 * @param {array} $data :  Datos de edicion
	 * @return {boolean}
	 */
	public function edit($row_id, $data){
		
		if (!not_value($row_id)){

			// Solucionamos el x frame del video
			if (isset($data['row_video_url'])){
				$data['row_video_url'] = video_embed_provider(
											$data['row_video_url']);	
			}

			$this->db->where('row_id',$row_id);
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
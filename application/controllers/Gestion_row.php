<?
/**
 * (*) 	Clase para generar un componente del tipo portfolio
 * 		por el momento no se encuentra activa
 */


class Gestion_row extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		if(!$this->session->userdata('logged_in')){
            redirect('gestion/login');
        }
        
        $this->load->model('Widget/row_model','row_model');

	}

	/**
	 * Creamos un widget cuadricula
	 * @param {number} $page_id
	 */
	public function create($page_id){

		// Si se creo el widget, podemos crear la cuadricula 
		if ($widget_id = $this->_create_widget($page_id)){

			// Crea el widget row
			if ($this->row_model->create($widget_id))
				redirect(base_url("gestion/row/$widget_id"));
			
		}
		else 
			echo json_encode(FALSE);
	}



	/**
	 * Editamos un widget del tipo row, el id del row
	 * es enviado entre el nombre del key del $_REQUEST
	 * 
	 * @param {number} $widget_id
	 */
	public function edit($widget_id){

		// Si se envia el formulario
		if ($this->input->post('g-submit')){

			// Id del row
			$numbers = number_in_string(key($_POST));
			$row_id = $numbers[0];

			// Datos a editar en la tabla
			$widget_data = fieldname_to_entity(array("/g-(\d*)_/" => 'row_'), 
											   $_POST, TRUE);

			$this->row_model->edit($row_id,$widget_data);
		}
	}

	/**
	 * Creamos un nuevo widget
	 * Enlace de creacion
	 * 
	 * @param {number} $page_id
	 * @return {mixed} : id del widget o FALSE
	 */
	protected function _create_widget($page_id){

		$this->load->model('General/widget_model','widget_model');

		// En caso que enviemos el formulario y existe la pagina
		if (isset($_REQUEST['g-submit']) && $this->_get_page_exist($page_id)){

			if ($widget_id = $this->widget_model->create($page_id,'row'))
				return $widget_id;

		}

		return FALSE;

	}


	/**
	 * Verifica si la pagina existe a la que queremos asignar el 
	 * widget
	 * 
	 * @param {number} $page_id
	 * @return {boolean}
	 */
	protected function _get_page_exist($page_id){
		$this->load->model('General/page_model','page_model');
		if ($this->page_model->get_exist($page_id))
			return TRUE;

		return FALSE;
	}


	public function index(){
		show_404();
	}


}

?>
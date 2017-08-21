<?

class Gestion_slide extends CI_Controller {

	// Limita la cantidad de slide
	protected $cant_slide = 5;

	public function __construct(){
		parent::__construct();
		
		if(!$this->session->userdata('logged_in')){
            redirect('gestion/login');
        }
        
        $this->load->model('Widget/slide_model','slide_model');

	}


	/**
	 * Editamos un widget del tipo slide
	 */
	public function edit($widget_id){

		// El dato que desea modificar de la base de datos
		fieldname_to_entity(array('g-' => 'row_'),$_POST);
	}

	/**
	 * Creamos un widget cuadricula
	 * @param {number} $page_id
	 */

	public function create($page_id){


		// Si se creo el widget, podemos crear la cuadricula 
		if ($widget_id = $this->_create_widget($page_id)){

			// Inserta slide hasta cant_slide
			for ($i = 1; $i <= $this->cant_slide; $i++) { 
				$this->slide_model->create($widget_id,$i);
			}

			// Cargamos la vista generada
			redirect(base_url("gestion/slide/$widget_id"));
		}
		else 
			echo json_encode(FALSE);
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

			if ($widget_id = $this->widget_model->create($page_id,'slide'))
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
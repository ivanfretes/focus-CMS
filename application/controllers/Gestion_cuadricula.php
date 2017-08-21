<?
/**
 * (*) 	Clase para generar un componente del tipo portfolio
 * 		por el momento no se encuentra activa
 */


class Gestion_cuadricula extends CI_Controller {

	// Cantidad de items por cuadricula
	protected $cant_cuadricula = 10;

	public function __construct(){
		parent::__construct();
		
		// if(!$this->session->userdata('logged_in')){
  //           redirect('gestion/login');
  //       }
        
        $this->load->model('Widget/cuadricula_model','cuadricula_model');
        $this->load->model('General/widget_model','widget_model');

        // Si se especifico una cantidad, la cantidad
        $this->set_cant_cuadricula($this->input->get('cant-cuadricula'));
	}


	/**
	 * Actualizamos la cantidad de cuadriculas a crear
	 * 
	 * @param {number} $cant
	 */
	protected function set_cant_cuadricula($cant){
		if (!not_value($cant))
			$this->cant_cuadricula = $cant;
	}


	/**
	 * Creamos un widget cuadricula
	 * @param {number} $page_id
	 */
	public function create($page_id){


		// Si se creo el widget, podemos crear la cuadricula 
		if ($widget_id = $this->_create_widget($page_id)){

			// Insertamos hasta cant_cuadricula item cuadricula
			for ($i = 1; $i <= $this->cant_cuadricula; $i++) { 
				$this->cuadricula_model->create($widget_id,$i);
			}

			// Cargamos la vista generada
			redirect(base_url("gestion/cuadricula/$widget_id"));
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

		// En caso que enviemos el formulario y existe la pagina
		if (isset($_REQUEST['g-submit']) && $this->_get_page_exist($page_id)){

			// widget_id
			if ($wi_id = $this->widget_model->create($page_id,'cuadricula'))
				return $wi_id;

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

	/**
	 * Edita la cuadricula generada por widget
	 * 
	 * @param {number} $widget_id
	 * @return {void} 
	 */
	public function edit($widget_id){
		

		// Si el widget existe
		if ($this->widget_model->get_exist($widget_id))
			echo "string";


		return;


		// En caso que enviemos el formulario y existe la pagina
		if (isset($_REQUEST['g-submit']) && 
			$this->widget_model->get_exist($widget_id)){
			

			// Cargamos los datos del widget
			var_dump($data);
			return;
			if ($this->page_model->edit($widget_id, $data)){

			}
		}

		
	}


}

?>
<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package GestionCMS
 * @author Ivan Fretes
 */
class Gestion_widget extends CI_Controller {



	public function __construct(){
		parent::__construct();
		
		// if(!$this->session->userdata('logged_in')){
  //           redirect('gestion/login');
  //       }
        
        $this->load->model('General/widget_model','widget_model');
		$this->load->library('widget_custom');

		//$this->output->enable_profiler();

	}

	/**
	 * Lista todos los widget por pagina
	 * 
	 * @param {number} $page_id
	 */
	public function all($page_id){

		// Si existe la pagina
		if ($this->get_exist($page_id)){

			// Listado de widget
			$widget_list = $this->widget_model->get_all($page_id);

			foreach ($widget_list as $index => $widget) {
				
				// Generamos la vista para cada widget
				$this->get($widget['widget_type'], $widget['id_widget']);
					
			}

			
		}
		else
			show_404();

		
	}


	/**
	 * Function comodin, ejecuta una funcion producto de la concatenacion
	 * de la palabra get + $widget_type
	 * 
	 * @param {string} $widget_type : e.g (row, slide, cuadricula, etc);
	 * @param {number} $widget_id
	 */
	public function get($widget_type, $widget_id){

		// Nombre de la funcion a llamar
		$fn_call = "get_$widget_type";

		// Si el metodo existe
		if (method_exists($this, $fn_call)){
			call_user_func_array(array($this,$fn_call),array($widget_id));
		}
		else 
			show_404();
	}



	/**
	 * Imprime la vista del widget row
	 * 
	 * @param {number} $widget_id
	 */
	public function get_row($widget_id){

		$this->load->model('Widget/row_model','row_model');

		$data = (array) $this->row_model->get($widget_id);					
		$data['row_align'] = $this->row_model->get_row_align();
		$data['widget_id'] = $widget_id;

		// Cargamos la vista	
		$this->load->view('admin/widgets/widget-row',$data);
	}


	/**
	 * 
	 * Impreme la vista del widget slide
	 * 
	 * @param {number} $widget_id
	 */
	public function get_slide($widget_id){
		$this->load->model('Widget/slide_model','slide_model');

		$data['slide_list'] = $this->slide_model->get_all($widget_id);
		$data['widget_id'] = $widget_id;

		// Cargamos la vista	
		$this->load->view('admin/widgets/widget-slide',$data);

	}


	/**
	 * Impreme la vista del widget cuadricula
	 */
	public function get_cuadricula($widget_id){
		$this->load->model('Widget/cuadricula_model','cuadricula_model');

		$data['cuadricula_list'] = $this->cuadricula_model->get_all($widget_id);
		$data['widget_id'] = $widget_id;

		// Cargamos la vista	
		$this->load->view('admin/widgets/widget-cuadricula',$data);
	}



	/**
	 * Creamos un nuevo widget
	 * Enlace de creacion
	 * 
	 * @param {number} $page_id
	 * @return {mixed} : id del widget o FALSE
	 */
	protected function _create($page_id){

		// En caso que enviemos el formulario y existe la pagina
		if (isset($_REQUEST['g-submit']) && $this->get_exist($page_id)){

			if ($widget_id = $this->widget_model->create($page_id))
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
	protected function get_exist($page_id){
		$this->load->model('General/page_model','page_model');
		if ($this->page_model->get_exist($page_id))
			return TRUE;

		return FALSE;
	}

	
	

	/**
	 * Removemos un widget
	 * 
	 * @param {number} $widget_id
	 * @return {void}
	 */
	public function remove($widget_id){

		// Si existe el widget
		if ($this->widget_model->get_exist($widget_id)){

			// Si el boton esta activo
			if (isset($_REQUEST['g-submit']))  {

				// Eliminamos el widget
				if ($this->widget_model->remove($widget_id))
					echo json_encode(TRUE);
				else
					echo json_encode(FALSE);	
				

			}

		}
		else show_404();
		
	}


	/**
	 * Ordena los componentes por pagina
	 * 
	 * -- Modificar --
	 * 
	 * @param {number} $page_id
	 * @return {void} 
	 */
	public function ordered($page_id){

		/**
		 * @var {array} contiene los valores del orden (id)
		 */
		$widget_order = $this->input->post('order');

		var_dump($widget_id);
		return;


		// Si se encuentra los valores de ordenamiento
		if (!not_value($arr_order)){


			//$this->widget_model->set_order();
		}


		//$this->widget_custom->ordered($arr_order,$page_id);
	}

}

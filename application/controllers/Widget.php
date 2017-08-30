<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package GestionCMS
 * @author Ivan Fretes
 */
class Widget extends CI_Controller {

	/**
	 * @var {array} Listado de vistas
	 */
	protected $list_views = [];


	public function __construct(){
		parent::__construct();
        
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

			// Listado de vistas generadas
			$data['widget_list'] = [];

			// Listado de widget
			$widget_list = $this->widget_model->get_all($page_id);


			// Cargamos las vista en un array
			foreach ($widget_list as $index => $widget) {
		
				// Anexamos la vista del widget a un array
				$a = $this->get_widget($widget['widget_type'], 
								       $widget['widget_id']);

				array_push($data['widget_list'], $a);
					
			}

			$data['page_id'] = $page_id;
			$data['main_content'] = 'admin/widgets/widget-list-per-page';
			$this->load->view('admin/template',$data);

			
		}
		else
			show_404();

		
	}


	/**
	 * Imprime una vista HTML de un widget generado dinamicamente
	 * 
	 * @param {string} $widget_type : e.g (row, slide, cuadricula, etc);
	 * @param {number} $widget_id
	 */
	public function get($widget_type, $widget_id){
		echo $this->get_widget($widget_type, $widget_id);
	}



	/**
	 * Function comodin, ejecuta una funcion producto de la concatenacion
	 * de la palabra get + $widget_type
	 * 
	 * @param {string} $widget_type : e.g (row, slide, cuadricula, etc);
	 * @param {number} $widget_id
	 * 
	 * @return {string}
	 */
	protected function get_widget($widget_type, $widget_id){
		// Nombre de la funcion a llamar
		$fn_call = "get_$widget_type";

		// Si el metodo existe
		if (method_exists($this, $fn_call)){
			$a = call_user_func_array(array($this,$fn_call),array($widget_id));
			
			// Retornamos la visya con los componetes del widget en un <LI>
			return $this->_li_view_widget($widget_id,$a);
		}
		else 
			show_404();
	}



	/**
	 * Retorna la vista de un widget row
	 * 
	 * @param {number} $widget_id
	 * @return {string} 
	 */
	protected function get_row($widget_id){

		$this->load->model('Widget/row_model','row_model');

		$data = (array) $this->row_model->get($widget_id);					
		
		// Alineaciones posibles de la fila
		$data['row_align'] = $this->row_model->get_row_align();
		$data['widget_id'] = $widget_id;

		// Cargamos la vista	
		return $this->load->view('admin/widgets/widget-row',$data, TRUE);
	}


	/**
	 * 
	 * Retorna la vista del widget slide
	 * 
	 * @param {number} $widget_id
	 * @return {string} 
	 */
	protected function get_slide($widget_id){
		$this->load->model('Widget/slide_model','slide_model');

		$data['slide_list'] = $this->slide_model->get_all($widget_id);
		$data['widget_id'] = $widget_id;

		// Cargamos la vista	
		return $this->load->view('admin/widgets/widget-slide',$data ,TRUE);
		
	}


	/**
	 * Retorna la vista del widget cuadricula
	 */
	protected function get_cuadricula($widget_id){
		$this->load->model('Widget/cuadricula_model','cuadricula_model');

		$data['cuadricula_list'] = $this->cuadricula_model->get_all(
																$widget_id);
		$data['widget_id'] = $widget_id;

		// Cargamos la vista	
		return $this->load->view('admin/widgets/widget-cuadricula',$data,TRUE);
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
	 * Procedimiento para agregar los componentes HTML, que 
	 * necesita la vista, y no duplicar codigo
	 * 
	 * @param {number} $widget_id 
	 * @param {string} $view : Ruta de la vista del widget 
	 * @return {string} : Retorna la vista con los botones y datos del widget
	 */
	protected function _li_view_widget($widget_id,$view){
		$str = "<li data-widget-id='$widget_id'><div class=\"widget-item\">";
		$str .= "<a href=".base_url("gestion/widgets/remove/$widget_id")." data-action=\"remove\"><span class=\"glyphicon glyphicon-trash\">";
		$str .= "</span> Eliminar</a>".$view;
		$str .= "</div></li>";

		return $str;
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


		if ($this->input->post('g-submit')){
			// Array de Widget Id, para ordenar de forma secuancial
			$widget_order_list = $this->input->post('order');

			
			var_dump($widget_order_list);
			return;
			// Ordenamos si el array no esta vacio
			if (!not_value($widget_order_list)){

				foreach ($widget_order_list as $order_index => $widget_id) {
					$this->widget_model->set_order($widget_id, $order_index);
				}

			}

		}

		
	}

}

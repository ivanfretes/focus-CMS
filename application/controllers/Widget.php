<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * @package GestionCMS
 * @author Ivan Fretes
 * 
 * Modificar Widget, que all funcione en el controlador Page
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

			// Cargamos datos de la página
			

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
			$data['page_url']= $page_data->page_url;
			$data['main_content'] = 'admin/widgets/widget-list-per-page';
			$this->load->view('admin/template',$data);

			
		}
		else
			show_404();

		
	}



	/**
	 * Verifica si la pagina existe a la que queremos asignar el 
	 * widget
	 * 
	 * @param {number} $page_id
	 * @return {boolean}
	 */
	protected function get_exist_page($page_id){
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
			if (!not_value($this->input->post('g-submit')))  {

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

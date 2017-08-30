<?

class Widget_menu extends CI_Controller {
	
	public function __construct(){
		parent::__construct();

		$this->load->model('General/menu_model', 'menu_model');
	}


	/**
	 * Listado de Menus Generados
	 */
	public function index(){
		$data['list_menu'] = $this->menu_model->get_all();
		
		$data['main_content'] = 'admin/pages/page-menu';
		$this->load->view('admin/template',$data);
	}



	/**
	 * Creamos una nuevo item Menu
	 * 
	 * @return {void}
	 */
	public function create(){
		
		// En caso que enviemos el formulario
		if ($this->input->post('g-submit')){
			$menu_data = fieldname_to_entity(array('g-' => 'menu_'), $_POST);
			
			// Redimencionamos la imagen,a la edicion si se creo 
			if ($last_page = $this->menu_model->create($menu_data)){
				echo json_encode(TRUE);
			}
			else 
				echo json_encode(FALSE);
		}

	}



	/**
	 * Eliminamos cualquier item del menu, por su id
	 * @param {number} $menu_id
	 * 
	 * @return {string} Si fue o no eliminado
	 */	
	public function remove($menu_id){

		if(!not_value($_POST['g-submit'])){

			if ($this->menu_model->remove($menu_id))
				echo json_encode(TRUE);
			else 
				echo json_encode(FALSE);
		}
		else 
			show_404();
		
	}


	/**
	 * ordena los datos del menu
	 */
	public function ordered(){
		$arr_order = $this->input->post('order');

		if (count($arr_order) > 0){
			foreach ($arr_order as $index => $menu_id) {
				$this->menu_model->ordered($menu_id, $index + 1);
			}

			return print_json_msg('Se ordenó el ménu correctamente' , 0);
		}

		return print_json_msg('No se ordenó el ménu correctamente',1);
		
	}
}

?>
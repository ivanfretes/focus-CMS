<?

/**
 * 
 * Controlador de Menu, se considera un widget para evitar ambiguedad con el 
 * termino menu, en caso de una entidad gastronomica
 * 
 * @package focusCMS
 * @author Ivan Fretes
 */
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
		
		$data['main_content'] = 'admin/menu/menu-list';
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
			msg_boolean_json($this->menu_model->create($menu_data));
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
	 * Ordena los items del menu

	 */	
	public function set_order(){

		// Listado de elementos recibidos en orden, con sus id menu
		$order_element = $this->input->post('order');


		// Si se enviaron elementos del menu, y el submit esta inicializado
		if (!not_value($order_element) &&  isset($_POST['g-submit'])){

			foreach ($order_element as $index => $menu_id) {
				
				$a = $this->menu_model->set_order($menu_id, $index + 1);
				if (FALSE  === $a)
					break;
			}


			msg_boolean_json($a);

		}

	}
}

?>
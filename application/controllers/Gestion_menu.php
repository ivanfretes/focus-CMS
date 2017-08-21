<?

	/**
	* 
	*/
	class Gestion_menu extends CI_Controller {
		
		public function __construct(){
			parent::__construct();

			if(!$this->session->userdata('logged_in')){
	            redirect('gestion/login');
	        }

			$this->load->model('General/menu_model', 'menu_model');
		}


		/**
		 * Listado de menus, creados
		 */
		public function index(){
			$data['list_menu'] = $this->menu_model->get_all_menu();
			$data['g_category'] = 'Menú';

			$data['main_content'] = 'admin/pages/page_menu';
			$this->load->view('admin/template',$data);
		}



		/**
		 * Creamos un nuevo menu, 
		 * 
		 * Si el menu fue creado, recarga la pagina
		 * @return {void}
		 */
		public function create(){
			$menu_name = $this->input->post('menu_name');
			$menu_link = $this->input->post('menu_link');

			if (!empty($menu_name) && !empty($menu_link)){

				// Creamos un nuevo menu
				$add = $this->menu_model->create_menu($menu_name, 
													  $menu_link, -1);

				if ($add) {
					// se inserto correctamente, json
					print_json_msg('Se creó el menu' , 0);
				}
				else {
					print_json_msg('Algo salio mal' , 1);
				}	
			}
			else print_json_msg('No se creó el menú' , 1);
		}



		/**
		 * Eliminamos cualquier item del menu, por su id
		 * @param {number} $menu_id
		 * 
		 * @return {string} Si fue o no eliminado
		 */	
		public function remove(){

			$menu_id = $this->input->post('param');

			if (NULL === $menu_id) print_json_msg('No se elímino el menú', 1);
			else {
				$this->menu_model->remove_menu($menu_id);
				print_json_msg('Se elímino el menú', 1);
			}
		}


		/**
		 * ordena los datos del menu
		 */
		public function order(){
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
<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * Contralador de Pagina, Crea, lista y elimina
 * 
 * @package focusCMS
 * @author Ivan Fretes
 */
class Page extends CI_Controller {


	public function __construct(){
		parent::__construct();
        $this->load->model('General/page_model','page_model');
		
        // Carpeta seleccionada para la vista
		$this->folder_view = $this->session->view;
		//$this->output->enable_profiler();	
	}


	
	/**
	 * Listado de Páginas
	 * 
	 * @param {number} $page_index : Nro de Página
	 * @return {void}
	 */
	public function all($page_index = 1){
		// Verificamos que el numero sea positivo
		$page_index = get_minor_positive_number($page_index);

		// Si el usuario desea ver una cantidad distinta de filas
		if (!not_value($_GET['rows']))
			$per_page = $this->input->get('rows');
		else 
			$per_page = 25;



		// Retorna el registro inicial, para inicial el conteo
		$data['row_init'] = get_init_row($page_index, $per_page);
		
	
		// Listado de páginas
		$data['page_list'] = $this->page_model->get_all($data['row_init'], 
														$per_page);
		
		// Generamos Pagination
		$data['total_row'] = $this->page_model->get_count();
		$data['pagination'] = pagination_custom(
			'focus/pages/', 
			$data['total_row'],
			$per_page
		);

		// Cargamos la vista
		$data['main_content'] = 'admin/pages/page-list';
		$this->load->view('admin/template', $data);
		
	}



	/**
	 * Lista todos los widget de una pagina
	 * 
	 * @param {number} $page_id
	 * @return {array} : Contiene una matriz de objetos
	 */
	protected function _list_widget($page_id){
		$this->load->model('General/widget_model','widget_model');		
		$data['folder_view'] = $this->folder_view;

		// Listado de widget diferentes tipos de widgets
		return $this->widget_model->get_all_widget($page_id);

	}


	/**
	 * Genera los datos de todos los widget
	 * 
	 * @param {number} $page_id
	 */
	public function get_all_widget($page_id){

		// Listado de widgets generados, con sus respectivos subtipos
		$data = (array) $this->page_model->get($page_id);

		$data['widget_list'] = $this->_list_widget($page_id);
		$data['main_content'] = 'admin/widgets/widget-list-per-page';

		// Cargamos la vista
		$this->load->view('admin/template',$data);

	}

	/**
	 * Muestra la pagina genera para el usuario
	 * 
	 * @param {string} $param_url : Slug de URL recibido
	 */
	public function index($param_url = NULL){

		/**
		  * Si no existe slug en el base url
		  * Selecciona la pagina principal
		  */ 
		if (NULL === $param_url) {
			$data = (array) $this->page_model->get_index_page();
			$data['title'] = 'Inicio';
		}
		else {
			$data = (array) $this->page_model->get_by_slug($param_url);

			if (!not_value($data))
				$data['title'] = $data['page_title'];
			
		} 

		// Generamos el menu
		$this->load->model('General/menu_model','menu_model');
		$data['menu_list'] = (array) $this->menu_model->get_all();
		

		// Si existe el id de la pagina
		if (isset($data['page_id']) && !not_value($data['page_status'])){

			// Listado de widget generados
			$data['widget_list'] = $this->_list_widget($data['page_id']);
			
			// Cargamos la vista, Lstado de widget por pagina
			$data['main_content'] = 'frontend/widgets/widget-list-per-page';
			$this->load->view('frontend/template',$data);

		}
		else 
			show_404();

	}


	/**
	 * Editamos una página
	 * 
	 * @param {number} $page_id
	 * @return {void} 
	 */
	public function edit($page_id){

		// En caso que enviemos el formulario
		if ($this->input->post('g-submit')){

			$text_data = fieldname_to_entity(array('g-' => 'page_'), $_POST);

			// Subimos las imagenes, generamos los nombres de los campos
			$image_data = $this->_image_upload(); 

			// Generamos los datos de la pagina para la db
			if (NULL !== $image_data)
				$page_data = array_merge($image_data,$text_data);
			else 
				$page_data = $text_data;

			// Si no pudo editarse
			if (!$this->page_model->edit($page_id, $page_data))
				echo json_encode(FALSE);

			
		}

		// Informacion de la pagina
		$data = (array) $this->page_model->get($page_id);

		// Cargamos la vista
		$data['main_content'] = 'admin/pages/page-form';
		$this->load->view('admin/template',$data);


	}



	/**
	 * Modificar, que reciba por post el g-submit
	 * 
	 * Creamos una nueva página, recorda que el slug / url es requerido
	 * 
	 * @return {void}
	 */
	public function create(){
		
		
		// Redimencionamos la imagen,a la edicion si se creo 
		if ($last_page = $this->page_model->create()){
			redirect(base_url('focus/pages/edit/'.$last_page));
		}
		// else 
		// 	echo json_encode(FALSE);

	}


	/**
	 * 
	 * Retorna un array con los nombre de campos y las rutas generadas
	 * @return {array} description 
	 */
	protected function _image_upload(){
		// Subimos los archivos, y generamos las rutas
		$image_uploaded = upload_images();

		if (!not_value($image_uploaded)){
			$image_data = array_shift($image_uploaded);
			$iformat = $image_data['image_type'];
			if ('gif' !== $iformat)
				$iroute = resize_image_by_height($image_data, 768);
			else {
				$iname = $image_data['file_name'];
				$iroute = 'uploads/images/raw/'.$portada_name;
			}
			return array('page_portada_url' => $iroute);
		}

		return NULL;

	}


	/**
	* Elimina una página
	* @param {number} $page_id
	*/
	public function remove($page_id){

		if ($this->input->post('g-submit')){
			msg_boolean_json($this->page_model->remove($page_id));
		}
		else
			redirect(base_url('focus/pages'));

	}	



}
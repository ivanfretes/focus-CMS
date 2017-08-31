<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * Contralador de Gestion de los elementos relacionos con las páginas
 * 
 * @package GestionCMS
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
		$data['pagination'] = pagination_custom('gestion/pages/', 
											    $data['total_row']);

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
	 * Pagina por 
	 * 
	 */
	public function index($param_url = NULL){

		/**
		  * Si no existe slug en el base url
		  * Selecciona la pagina principal
		  */ 
		if (NULL === $param_url) {
			$data = (array) $this->page_model->get_index_page();
			$data['page_title'] = 'Inicio';
		}
		else 
			$data = (array) $this->page_model->get_by_slug($param_url);
		

		// Retornamos el menu
		$this->load->model('General/menu_model','menu_model');
		$data['menu_list'] = (array) $this->menu_model->get_all();
		

		// Si existe el id de la pagina
		if (isset($data['page_id'])){

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
			redirect(base_url('gestion/pages/edit/'.$last_page));
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

			// Indice y rutas de la imagen para insertar en la base de datos
			$image_data = fieldname_to_entity(array('g-' => 'page_'), 
											  $image_uploaded);

			$portada_name = $image_data['page_portada_url']['file_name'];
			$portada_format = $image_data['page_portada_url']['image_type'];

			// Si la imagen es un gif, no redimensiona
			if ('gif' !== $portada_format)
				$portada_route = resize_image_with_gd(1025,576, $portada_name);
			else 
				$portada_route = 'uploads/images/raw/'.$portada_name;

			// Retorna el campo con 
			return array('page_portada_url' => $portada_route);
		}

		return NULL;

	}

	

	/**
	* Elimina una página
	* @return {void}
	*/
	public function remove($page_id){
		

		// Si boton de la pagina se activo
		if ($this->input->post('g-submit')){

			// Si se elimina la pagina, mostramos true
			if ($this->page_model->remove($page_id))
				json_encode(TRUE);
			else
				json_encode(FALSE);
		}
		else
			redirect(base_url('gestion/pages'));

	}	



}
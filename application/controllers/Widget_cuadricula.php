<?
/**
 * (*) 	Clase para generar un componente del tipo portfolio
 * 		por el momento no se encuentra activa
 * 
 * @package focusCMS
 * @author Ivan Fretes
 */


class Widget_cuadricula extends CI_Controller {

	// Cantidad de items por cuadricula
	protected $cant_cuadricula = 10;

	public function __construct(){
		parent::__construct();
		$this->load->model('Widget/cuadricula_model','cuadricula_model');
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

		if (!not_value($_POST['g-submit'])){

			// Si se creo el widget, podemos crear la cuadricula 
			$data = $this->_create_widget($page_id);

			if (!not_value($data)){
				$widget_id = $data['widget_id'];
				for ($i = 1; $i <= $this->cant_cuadricula; $i++) { 
					$this->cuadricula_model->create($widget_id, $i);
				}

				$data['widget'] = $this->cuadricula_model->get_all( 
					$widget_id
				);
				$this->load->view('admin/widgets/widget-form', $data);
			}
			else 
				echo json_encode(FALSE);	
		}
		else 
			show_404();
		
	}



	/**
	 * Retorna la vista del widget cuadricula
	 */
	public function detail($widget_id){
		$this->load->model('Widget/cuadricula_model','cuadricula_model');
		$data['cuadricula_list'] = $this->cuadricula_model->get_all(
			$widget_id 
		);
		$data['widget_id'] = $widget_id;
		$this->load->view('admin/widgets/widget-cuadricula', $data);
	}


	/**
	 * Retornamos todos los datos relacionados a un widget
	 * 
	 * @param {number} $page_id
	 * @return {mixed} : id del widget o FALSE
	 */
	protected function _create_widget($page_id){

		$this->load->model('General/widget_model','widget_model');

		// Retornamos los datos de la página si existiese
		$this->_get_page($page_id);

		if (!not_value($this->page_data)){
			$w_data = $this->widget_model->create($page_id,'cuadricula');
			if (!not_value($w_data)){
				$page_data = (array) $this->page_data;
				$data = array_merge($page_data, $w_data);
			}
			return $data;
		}
		else
			show_404();
		

	}


	/**
	 * 
	 * Retorna un array con los nombre de campos y las rutas generadas
	 * @return {array} description 
	 */
	protected function _image_upload(){
		// Subimos los archivos, y generamos las rutas
		$image_uploaded = upload_images();

		// Generamos los datos de la imagen
		if (!not_value($image_uploaded)){
			$image_data = array_shift($image_uploaded);
			$iformat = $image_data['image_type'];
			if ('gif' !== $iformat)
				$iroute = resize_image_by_width($image_data, 300);
			else {
				$iname = $image_data['file_name'];
				$iroute = 'uploads/images/raw/'.$iname;
			}
			return array('cuadricula_image' => $iroute);
		}

		return NULL;

	}


	/**
	 * Retorna los datos de una página
	 * 
	 * @param {number} $page_id
	 * @return {boolean}
	 */
	protected function _get_page($page_id){
		$this->load->model('General/page_model','page_model');
		$this->page_data = $this->page_model->get($page_id);
	}


	public function index(){
		show_404();
	}


	/**
	 * Editamos un widget del tipo CUADRICULA
	 * @param {number} $widget_id
	 */
	public function edit($widget_id){
		// Si se envia el formulario
		if ($this->input->post('g-submit')){
			
			// Si el dato es un archivo o texto plano
			if (!not_value($_FILES)){
				$this->_edit_image();				
			}
			else {
				$this->_edit_plain_text();
			}
			
		}
	}

	/**
	 * Carga una nueva imagen y edita la ruta en la base de datos
	 */
	protected function _edit_image(){

		// Eliminamos los archivo no inicilizados del vector $_FILES
		$f = remove_empty_files();
		$numbers = number_in_string(key($f));
		$cuadricula_id = $numbers[0];	

		// Datos serializados de la imagen
		$image_data = $this->_image_upload();
		msg_boolean_json(
			$this->cuadricula_model->edit($cuadricula_id, $image_data)
		);

	}



	/**
	 * Actualiza los registros de la base de datos
	 */
	protected function _edit_plain_text(){
		// Obtenemos el valor del id
		$numbers = number_in_string(key($_POST));
		$cuadricula_id = $numbers[0];

		// Datos de la cuadricula
		$text_data = fieldname_to_entity(
			array(
				"/g-(\d*)_/" => 'cuadricula_'
			),
			$_POST, 
			TRUE
		);
		msg_boolean_json(
			$this->cuadricula_model->edit($cuadricula_id, $text_data)
		);
	}




}

?>
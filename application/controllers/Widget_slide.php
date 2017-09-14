<?


/**
 * Controlador de slide
 * 
 * @package focusCMS
 * @author Ivan Fretes
 */

class Widget_slide extends CI_Controller {

	// Limita la cantidad de slide
	protected $cant_slide = 5;

	public function __construct(){
		parent::__construct();
        $this->load->model('Widget/slide_model','slide_model');
	}

	/**
	 * 
	 * Retorna la vista del widget slide,
	 * -- No utilizado --
	 * 
	 * @param {number} $widget_id
	 * @return {string} 
	 */
	public function detail($widget_id){
		$this->load->model('Widget/slide_model','slide_model');

		$data['slide_list'] = $this->slide_model->get_all($widget_id);
		$data['widget_id'] = $widget_id;

		// Cargamos la vista	
		$this->load->view('admin/widgets/widget-slide',$data);
	}


	/**
	 * 
	 * Retorna un array con los nombre de campos y las rutas generadas
	 * @return {array}
	 */
	protected function _image_upload(){
		// Subimos los archivos, y generamos las rutas
		$image_uploaded = upload_images();

		if (!not_value($image_uploaded)){
			// Datos de la imagen
			$image_data = array_shift($image_uploaded);
			$iformat = $image_data['image_type'];
			if ('gif' !== $iformat){
				$iroute = resize_image(900, 560, $iname);
				//$iroute = resize_image_by_width($image_data, 300);
				resize_image(450, 280, $iname);
			}
			else {
				$iname = $image_data['file_name'];
				$iroute = 'uploads/images/raw/'.$iname;
			}
			return array('slide_image' => $iroute);
		}
		return NULL;

	}


	/**
	 * Editamos un widget del tipo slide
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

		// Eliminamos los campos no inicializados del formulario
		$f = remove_empty_files();
		$numbers = number_in_string(key($f));
		$slide_id = $numbers[0];

		// Datos de la imagen
		$image_data = $this->_image_upload();

		// Insertamos el slide
		msg_boolean_json(
			$this->slide_model->edit(
				$slide_id,
				$image_data
			)
		);
	}


	/**
	 * Actualiza los registros de la base de datos
	 */
	protected function _edit_plain_text(){

		// Obtenemos el valor del id
		$numbers = number_in_string(key($_POST));
		$slide_id = $numbers[0];

		// Datos del slide
		$text_data = fieldname_to_entity(
			array("/g-(\d*)_/" => 'slide_'),
			$_POST, 
			TRUE
		);

		// Editamos el slide
		msg_boolean_json($this->slide_model->edit($slide_id,$text_data));
		
	}



	/**
	 * Creamos un widget cuadricula
	 * @param {number} $page_id
	 */

	public function create($page_id){

		if(!not_value($_POST['g-submit'])){
			
			$data = $this->_create_widget($page_id);

			// Si se creo el widget, podemos crear la slide 
			if (!not_value($data)){
				$widget_id = $data['widget_id'];
				for ($i = 1; $i <= $this->cant_slide; $i++) { 
					$this->slide_model->create($widget_id,$i);
				}
				$data['widget'] = $this->slide_model->get_all($widget_id);
				$this->load->view('admin/widgets/widget-form',$data);
			}
			else 
				echo json_encode(FALSE);	

		}
		else
			show_404();
	}



	/**
	 * Retorna todos los datos relacionados al widget
	 * 
	 * @param {number} $page_id
	 * @return {mixed} : widget creado o FALSE
	 */
	protected function _create_widget($page_id){

		$this->load->model('General/widget_model','widget_model');
		$this->_get_page($page_id);

		if (!not_value($this->page_data)) {
			if ($w_data = $this->widget_model->create($page_id, 'slide')){
				$page_data = (array) $this->page_data;
				$data = array_merge($w_data, $page_data);
			}
			return $data;
		}
		else
			show_404();

	}


	/**
	 * Retorna los datos de una pagina
	 * 
	 * @param {number} $page_id
	 * @return {object}
	 */
	protected function _get_page($page_id){
		$this->load->model('General/page_model','page_model');
		$this->page_data = $this->page_model->get($page_id);
	}


	public function index(){
		show_404();
	}


}

?>
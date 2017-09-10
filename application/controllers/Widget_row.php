<?
/**
 * @package focusCMS
 * @author Ivan Fretes
 */

class Widget_row extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('Widget/row_model','row_model');
	}

	/**
	 * Creamos un widget cuadricula
	 * @param {number} $page_id
	 */
	public function create($page_id){

		if (!not_value($_POST['g-submit'])){

			// Se carga los datos del widget
			$data = $this->_create_widget($page_id);

			if (FALSE !== $data){
				$widget_id = $data['widget_id'];

				if ($last_row = $this->row_model->create($widget_id)){
					$data['widget'] = $this->row_model->get($widget_id);
					$this->load->view('admin/widgets/widget-form', $data);
				}
				
			}	
		}
		else
			show_404();

	}



	/**
	 * Editamos un widget del tipo row, el id del row
	 * es enviado entre el nombre del key del $_REQUEST
	 * 
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
	 * Actualiza los registros de la base de datos
	 */
	protected function _edit_plain_text(){

		// Obtenemos el valor del id
		$numbers = number_in_string(key($_POST));
		$row_id = $numbers[0];

		// Datos de la fila
		$text_data = fieldname_to_entity(array("/g-(\d*)_/" => 'row_'),
											   $_POST, TRUE);


		// Mostramos mensaje si se edito la fila
		msg_boolean_json($this->row_model->edit($row_id,$text_data));
		
	}

	/**
	 * Carga una nueva imagen y edita la ruta en la base de datos
	 */
	protected function _edit_image(){
		// Eliminamos los campos no inicializados del formulario
		$f = remove_empty_files();
		$numbers = number_in_string(key($f));
		$row_id = $numbers[0];

		// Datos de la imagen
		$image_data = $this->_image_upload();

		// Insertamos la fila
		msg_boolean_json($this->row_model->edit($row_id,$image_data));

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
			$iname = $image_data['file_name'];
			$iformat = $image_data['image_type'];

			// Si la imagen es un gif, no redimensiona
			if ('gif' !== $iformat){
				$iroute = resize_image(900, 560, $iname);
				resize_image(450, 280, $iname);
			}
			else 
				$iroute = 'uploads/images/raw/'.$iname;

			// Retorna el campo con 
			return array('row_image' => $iroute);
		}

		return NULL;

	}


	/**
	 * Retorna todos los datos relacionados al widget
	 * 
	 * @param {number} $page_id
	 * @return {mixed} : widget creado o FALSE
	 */
	protected function _create_widget($page_id){

		$this->load->model('General/widget_model','widget_model');
		
		// Cargamos los datos de la pagina
		$this->_get_page($page_id);

		if (!not_value($this->page_data)) {

			if ($widget_data = $this->widget_model->create($page_id,'row')){
				$page_data = (array) $this->page_data;
				$data = array_merge($widget_data, $page_data);
				
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
	 * @return {boolean}
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
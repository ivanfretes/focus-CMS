<?


/**
 * Controlador de slide
 * 
 * @package gestioncms
 * @author Ivan Fretes
 */

class Widget_slide extends CI_Controller {

	// Limita la cantidad de slide
	protected $cant_slide = 5;

	public function __construct(){
		parent::__construct();
		
		if(!$this->session->userdata('logged_in')){
            redirect('gestion/login');
        }
        
        $this->load->model('Widget/slide_model','slide_model');

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

			// Retorna el indice del primer elemento eliminado
			$image_data = array_shift($image_uploaded);
			$iname = $image_data['file_name'];
			$iformat = $image_data['image_type'];

			// Si la imagen es un gif, no redimensiona
			if ('gif' !== $iformat)
				$iroute = resize_image_with_gd(1025, 576, $iname);
			else 
				$iroute = 'uploads/images/raw/'.$iname;

			// Retorna el campo con 
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

			// Datos del slide
			$text_data = fieldname_to_entity(array("/g-(\d*)_/" => 'slide_'),
											   $_POST, TRUE);


			// Id del slide
			$numbers = number_in_string(key($_POST));
			$slide_id = $numbers[0];

			// Sube la imagen y retorna la ruta
			$image_data = $this->_image_upload();
			var_dump($image_data);

			// Generamos los datos de la pagina para la db
			if (NULL !== $image_data)
				$widget_data = array_merge($image_data,$text_data);
			else 
				$widget_data = $text_data;


			// Insertamos el slide
			if ($this->slide_model->edit($slide_id,$widget_data))
				echo json_encode(TRUE);
			else
				echo json_encode(FALSE);
		}
	}

	/**
	 * Creamos un widget cuadricula
	 * @param {number} $page_id
	 */

	public function create($page_id){


		// Si se creo el widget, podemos crear la cuadricula 
		if ($widget_id = $this->_create_widget($page_id)){

			// Inserta slide hasta cant_slide
			for ($i = 1; $i <= $this->cant_slide; $i++) { 
				$this->slide_model->create($widget_id,$i);
			}

			// Cargamos la vista generada
			redirect(base_url("gestion/slide/$widget_id"));
		}
		else 
			echo json_encode(FALSE);
	}



	/**
	 * Creamos un nuevo widget
	 * Enlace de creacion
	 * 
	 * @param {number} $page_id
	 * @return {mixed} : id del widget o FALSE
	 */
	protected function _create_widget($page_id){

		$this->load->model('General/widget_model','widget_model');

		// En caso que enviemos el formulario y existe la pagina
		if (isset($_REQUEST['g-submit']) && $this->_get_page_exist($page_id)){

			if ($widget_id = $this->widget_model->create($page_id,'slide'))
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
	protected function _get_page_exist($page_id){
		$this->load->model('General/page_model','page_model');
		if ($this->page_model->get_exist($page_id))
			return TRUE;

		return FALSE;
	}


	public function index(){
		show_404();
	}


}

?>
<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package GestionCMS
 * @subpackage Pages/Widgets
 * @author Ivan Fretes
 */
class Gestion_widgets extends CI_Controller {

	protected $error = 0;	

	public function __construct(){
		parent::__construct();

		$this->load->library('widget_custom');
	}

	/**
	 * Create the component
	 * 	
	 * @example gestion/widgets/add/'single_row'
	 * @param {string} $widget_name
	 */
	public function create($widget_name = NULL){

		$config['page_id'] = $this->input->post('page'); 
		$config['widget_order'] = $this->input->post('order');
		$config['widget_name'] = $widget_name;

		if (NULL !== $config['page_id']) {

			$this->widget_custom->initialize($config);
			$this->widget_custom->create();
			echo $this->widget_custom->get();	

			return;
		
		}
		else {
			$msg = 'No se creó el widget';
			$this->error = 1;
		}


		// Print the msg
		$msg = htmlentities($msg);
		echo json_encode(array('msg' => $msg, 'error' => $this->error ));
		
	}


	/**
	 * Edit a subcomponent/ sub 
	 * @param {string} $widget_name Refiere al nombre del widget
	 * @return {void}
	 */
	public function edit($widget_name){


		// Recibe el nombre widget, independientemente, de su tipo
		$config['widget_name'] = $widget_name;

		/**
		 * component_id representa el id de portolio, slide, o
		 * cualquier componente, fuera de 
		 */
		$data_widget['widget_id'] = $this->input->post('component_id');

		/**
		 * Valor que se obtiene de las tag name mediante el $_RESQUEST
		 * @var {mixed} [widget_'value-replace'_id]
		 */

		$w_value = $config['widget_name'].'_value_'.$data_widget['widget_id'];
		


		// Verificamos que se encuentre inicializado el widget id
		if (NULL !== $data_widget['widget_id']){
			
			/**
			 * @var {string} A component img
			 */	
			$data_widget['widget_img']  = upload_custom($this->upload,
								 	str_replace('value','img', $w_value));


			/**
			 * @var {string} Title Widget/Subcomponent
			 */
			$data_widget['widget_title'] = 
				$this->input->post(str_replace('value','title', $w_value));
			

			/**
			 * @var {string} Link del video 
			 */
			$data_widget['widget_video'] = 
				$this->input->post(str_replace('value','video', $w_value));
			
			

			/**
			 * @var {string} btn link
			 */
			$data_widget['btn_link'] = 
				$this->input->post(str_replace('value','btn_link', $w_value));

			/**
			 * @var {string} btn link
			 */
			$data_widget['btn_title'] = 
				$this->input->post(str_replace('value','btn_title', $w_value));


			/**
			 * @var {string} Subtitle
			 */
			$data_widget['widget_subtitle'] = 
				$this->input->post(str_replace('value','subtitle', $w_value));

			/**
			 * @var {string} Descripcion del widget
			 */

			$data_widget['widget_description'] = $this->input->post(
								str_replace('value','description',$w_value));

			
			/**
			 * @var {string} alineacion de la imagen/video
			 */
			$data_widget['row_align'] = 
				$this->input->post(str_replace('value','align', 
												$w_value));

			// Inicializamos la librerua de widget custom
			$this->widget_custom->initialize($config,$data_widget);
			$this->widget_custom->edit();
		}

		
	}

	

	/**
	 * Remove the parent component
	 */
	public function remove(){

		if (NULL !== $this->input->post('data_send')) {
			
			$widget_id = $this->security->xss_clean(
							$this->input->post('data_send'));	
			$this->widget_custom->remove($widget_id);
		}

	}


	/**
	 * Ordered the all component / widgets
	 */
	public function ordered(){
		$arr_order = $this->input->post('order');
		$page_id = $this->input->post('page');

		if (NULL === $page_id) show_404();

		$this->widget_custom->ordered($arr_order,$page_id);
	}

}

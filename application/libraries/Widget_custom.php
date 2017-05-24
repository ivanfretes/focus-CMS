<?
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	/**
	 * Page component Library custom 
	 * 
	 * Component view folder is $this->config['path_view'].'/widgets/*'
	 *
	 * # Examples
	 * @example $config 
	 * 	
	 * --
	 * 
	 * @var $config['path_view'] description
	 * @var $config['path_view'] description
	 * @var $config['path_view'] description
	 * @var $config['path_view'] description
	 * @var $config['path_view'] description
	 * @var $config['path_view'] description
	 * @var $config['path_view'] description
	 * @var $config['path_view'] description
	 * @var $config['path_view'] description
	 * 
	 * --		
	 *  	
	 * @package GestionCMS
	 * @subpackage Website/pages/widgets
	 * @author Ivan Fretes
	 * 
	 */
	class Widget_Custom {

		protected $CI;
		protected $config;
		protected $all_widget_name = array(
									'' => '--', #default option
									'portfolio' => 'Portfolio',
									'single_row' =>'Fila',
									'slide' => 'Slide',
									/*'single_video' => 'Video'*/); 


		/**
		 * @var {array} Orientation/align the row component
		 */
		protected $row_align = array(
									'center' => '1 Columna / Imagen Arriba ',
									'right' => '2 Columnas / Imagen a la Izquierda',
									'left' =>'2 columnas / Imagen derecha'); 



		/**
		 * @var {array} Alineaciones posibles
		 */
		protected $video_aling = array(
									'center' => '',
									'left' => '',
									'right' => '',
									'single' => ''
								);



		/**
		 * @return {array} Retorna las alineaciones posibles de un componente
		 * de video
		 */
		public function get_video_align(){
			return $this->video_align;
		}

		/**
		 * @var content_tmp Is a data receibed in the outher class
		 */

		protected $data_widget = array();


		/**
		 * @param {array} $data
		 * @return {array} if initialized
		 */
		public function set_data_widget($data){
			$this->$data_widget = $data;
		}

		public function get_data_widget(){
			return $data_widget;
		}

		/**
		 * @return {array} row align
		 */
		public function get_row_align(){
			return $this->row_align;
		}


		/**
		 * @return array Gets the components name
		 */
		public function get_widget_name(){
			return $this->all_widget_name;
		}	

		

		public function __construct(){

			//if ($this->session->has_userdata('lib_'))


			$this->CI =& get_instance();
			$this->CI->load->model('General/widget_model','w_m');

			$this->w_m = $this->CI->w_m;
			
			//$this->initialize(array());
		}


		/**
		 * Initialize feature component
		 * 
		 * Verify if initialize: 
		 * 		the component name
		 * 		path_view is view's template return
		 * 		
		 * @param {array} $config
		 * @param {array} $data default NULL
		 * @return {void}
		 */
		public function initialize($config = array(),$data = NULL){
			$this->config = $config;

			if (!isset($this->config['path_view']))
				$this->config['path_view'] = 'admin';

			$this->config['path_view'] = $this->config['path_view'].'/';


			// Asignamos los datos por defecto, si es que disponemos de ello
			if(NULL !== $data){
				$this->data_widget = $data;
			}

		}



		/**
		 * List all component / widget by id
		 */
		public function get_all_widgets(){
			/**
			 * @var {array} Stack of the widget_view (template)
			 */
			$widget_view_file = [];


			try {


				// Verify page id initialized
				if (!isset($this->config['page_id']))
					throw new Exception("Unidentified page");	
				

				// get the current widget in the db
				$arr_widget = $this->w_m->get_widget_list(
													$this->config['page_id']);



				foreach ($arr_widget as $widget) {
					$this->config['widget_id'] = $widget->id_widget;
					$this->config['widget_name'] = $widget->component;
					$this->config['widget_order'] = $widget->widget_orderly;

					array_push($widget_view_file, $this->get());
				}

				return $widget_view_file;

			} catch (Exception $e) {
				echo $e->getMessage();
			}

			
		}


		/**
		 * Return a component by page_component id
		 * 
		 */
		public function create(){

			if (!isset($this->config['page_id']))
				throw new Exception("Unidentified page");		


			if (!isset($this->config['widget_name']))
				throw new Exception("Unidentified component name");	
			
			$this->create_widget();
			
			
			$this->amorphe_core('create_');
			
		}


		/**
		 * Get the particular component by id
		 */
		public function get(){
			return $this->amorphe_core('get_');							
		} 


		/**
		 * Edit the particular component by id
		 */
		public function edit(){

			if (!isset($this->config['widget_name']))
				throw new Exception("Unidentified component name");	
			
			if (!isset($this->data_widget['widget_id']))
				throw new Exception("Unidentified ".$this->config['widget_name']);		

			$this->amorphe_core('edit_');						
		} 


		/**
		 * this function is a selected 
		 * @example get_component
		 * 			create_component
		 * 			edit_component
		 */
		protected function amorphe_core($pref_call_back){
			try {
				
				;
				/**
				 * Concat the pref  call back function and the widget name
				 * @example 'get_'+'portfolio'
				 */
				$fn_call_back = $pref_call_back.$this->config['widget_name'];
				$fn_call_back = trim($fn_call_back);
			
				if (method_exists($this, 'edit_slide')){
					return call_user_func_array(array($this,$fn_call_back), 
										  	array());
				}
				else {
					throw new Exception("El metodo no existe");
				}
				

			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}


		
		
		
		/**
		 * Get the portfolio component
		 */
		public function get_portfolio(){

			$data['widget_order'] = $this->config['widget_order'];
			$data['widget_id'] = $this->config['widget_id'];


			/**
			 * @var {array} Listado de items pertenecientes a
			 * un portfolio
			 */
			$data['portfolio_list'] = $this->w_m->get_portfolio_list(
												$this->config['widget_id']);

			return $this->CI->load->view($this->config['path_view'].
										'widgets/portfolio',
										 $data, TRUE);
		}

		/**
		 * Get the slide component
		 */
		public function get_slide(){

			$data['widget_id'] = $this->config['widget_id'];
			$data['widget_order'] = $this->config['widget_order'];

			/**
			 * @var {array} Listado de Items pertenecientes a un slide
			 */
			$data['slide_list'] = $this->w_m->get_slide_list(
									$this->config['widget_id']);
			

			return $this->CI->load->view($this->config['path_view'].
										'widgets/slide',$data,TRUE);
		}

		/**
		 * Get the single row view
		 */
		public function get_single_row(){
			
			$data['widget_id'] = $this->config['widget_id'];
			$data['widget_order'] = $this->config['widget_order'];
			$data['row_align'] = $this->row_align;


			/**
			 * @var {object} Objecto con informacion acerca de la 
			 * configuracion de la fila
			 */
			$data['row'] = $this->w_m->get_single_row(
									$this->config['widget_id']);

			return $this->CI->load->view($this->config['path_view'].
										'widgets/single_row',
										$data, TRUE);
		}



		/**
		 * Creating a single row component
		 */

		public function create_single_row(){
			
		 	$this->content_inside = $this->w_m->create_single_row(
				'Título','Subtítulo','Editar Contenido [ aquí ]', 'Más Información',
				 base_url().'','right',
				 $this->config['widget_id'], NULL);

		}


		/**
		 * Creating a single video component
		 * 
		 * Modo [ Edit ]
		 */

		// public function create_single_video(){
			
		//  	$this->content_inside = $this->w_m->create_single_row(
		// 		'','','', '','','right',
		// 		 $this->config['widget_id']);

		// }


		/**
		 * Created a abstract component, later to created 
		 * the detail component
		 * 
		 * Raw component
		 */
		protected function create_widget(){

			$this->config['widget_id'] = $this->w_m->create_widget(
									$this->config['page_id'], 
									$this->config['widget_name'] , 
									'', $this->config['widget_order']);
		}


		/**
		 * Creating the portfolio component
		 */
		public function create_portfolio($cant_items = 10){			

			for ($i = 1; $i <= $cant_items; $i++) { 
				$this->w_m->create_portfolio(
								$this->config['widget_id'], '', 
								'', '', $i);
			}

		}


		/**
		 * Create the slide component
		 */
		public function create_slide($cant_items = 5){

			for ($i = 1; $i <= $cant_items; $i++) { 
				$this->w_m->create_slide($this->config['widget_id'],
										'', '', '', $i);

			}

		}



		/**
		 * Remove the page_component,
		 * Not important the component page by id
		 * 
		 * @return {void}
		 */
		public function remove($widget_id){			
			$this->w_m->remove_widget($widget_id);
		}

		public function __destruct(){
			unset($this);	
		}


		/**
		 * Ordered component ASC, dependiendo del grupo 
		 * de ID, en el cual se encuentra ordenados
		 * 
		 * @param {array} $arr_order Grupo de ID, en el actual orden
		 * @param {number} $page_id
		 * @return {boolean} 
		 */
		public function ordered($arr_order,$page_id){

			if (count($arr_order) > 0){
				foreach ($arr_order as $index => $widget_id) {
					$this->w_m->ordered($widget_id, $index + 1);
				}

				return TRUE;
			}

			return FALSE;
		}


		/**
		 * Edit the slide 
		 */
		public function edit_slide(){

			$this->w_m->edit_slide($this->data_widget['widget_id'], 
								   $this->data_widget['widget_img'],
								   $this->data_widget['widget_title'], 
								   $this->data_widget['widget_description'], 
								   '');

		}

		public function edit_single_row(){

	        if (!isset($this->data_widget['widget_description']))
	        	$this->data_widget['widget_description'] = NULL;
	        

	        /**
			 * @var $this->data_widget['widget_id'] 
			 * Refiere al ID del componente no la ID del widget 
			 * description
			 */

	        
	        $edit = $this->w_m->edit_single_row(
	        						$this->data_widget['widget_title'],
	        						$this->data_widget['widget_subtitle'],
									$this->data_widget['widget_description'],
									$this->data_widget['btn_title'],
									$this->data_widget['btn_link'], 
									$this->data_widget['row_align'],
									$this->data_widget['widget_video'],
									$this->data_widget['widget_img'],
									$this->data_widget['widget_id']);

			return;

		}


		/**
		 * Edit the portfolio
		 */
		public function edit_portfolio(){
			$this->w_m->edit_portfolio(	$this->data_widget['widget_id'], 
								   	$this->data_widget['widget_img'],
								   	$this->data_widget['widget_title'], 
								   	'', 
								    '');

			echo $this->data_widget['widget_id'];
		}

		
		/**
		 * Retorna el mayor valor ordenado
		 * @return {number} 
		 */
		public function get_order(){
			return $this->w_m->get_last_order($this->config['page_id']);
		}

	/**
	 * -- New Widget(CRUD) --
	 */
}


?>
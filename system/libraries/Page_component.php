<?
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	/**
	 * Page component Library custom 
	 * 
	 * Component view folder is $this->config['path_view'].'/components/*'
	 *
	 * @package GestionCMS
	 * @subpackage library/components
	 * @author Ivan Fretes
	 */
	class CI_Page_component {

		protected $config;
		protected $components_name = array(
									'portfolio' => 'Portfolio',
									'single_row' =>'Fila Personalizada',
									'slide' => 'Slide'); 


		/**
		 * @var {array} Orientation/align the row component
		 */
		protected $row_align = array(
									'left' => 'Dos columnas / Imagen Izquierda',
									'right' =>'Dos columnas / Imagen derecha',
									'center' => 'Una Columna'); 

		/**
		 * @var content_tmp Is a data receibed in the outher class
		 */

		protected $content_outside;

		/**
		 * This variable content the distinct objects, 
		 * that has de data return in the case 
		 * 
		 * 
		 * @var {object}
		 */
		protected $content_inside;



		public function set_content($content_tmp){
			$this->$content_tmp = $content_tmp;
		}

		public function get_content(){
			return $content_tmp;
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
		public function get_component_name(){
			return $this->components_name;
		}	

		

		public function __construct(){

			//if ($this->session->has_userdata('lib_'))

			$this->CI =& get_instance();

			$this->CI->load->model('General/component_model','c_m');
			$this->CI->load->model('General/page_component_model','pc_m');

			$this->pc_m = $this->CI->pc_m;
			$this->c_m = $this->CI->c_m;


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
		 */
		public function initialize($config = array()){
			$this->config = $config;

			if (!isset($this->config['path_view']))
				$this->config['path_view'] = 'admin';

			$this->config['path_view'] = $this->config['path_view'].'/';


		}


		/**
		 * List all component by id
		 */
		public function get_all_components(){
			/**
			 * @var {array} Stack of the component view (template)
			 */
			$arr_component_view = [];


			
			
			try {

				if (!isset($this->config['page_id']))
					throw new Exception("Unidentified page");	
					
				$arr_component = $this->pc_m->page_component_list(
													$this->config['page_id']);



				foreach ($arr_component as $component) {
					$this->config['component_created_id'] = 
											  $component->id_page_component;
					$this->config['component_name'] = $component->component;
					$this->config['order_component'] = $component->orderly;

					array_push($arr_component_view, $this->get());
				}


				return $arr_component_view;

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


			if (!isset($this->config['component_name']))
				throw new Exception("Unidentified component name");	
			

			$this->create_component();
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
				
				$fn_call_back = $pref_call_back.$this->config['component_name'];

				if (method_exists($this, $fn_call_back))
					return call_user_func_array(array($this,$fn_call_back), 
										  	array());

			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}

		
		
		/**
		 * Get the portfolio component
		 */
		public function get_portfolio(){
			$data['portfolio_list'] = $this->c_m->portfolio_list(
									$this->config['component_created_id']);

			return $this->CI->load->view($this->config['path_view'].
										'components/portfolio',
										 $data, TRUE);
		}

		/**
		 * Get the slide component
		 */
		public function get_slide(){
			
			$data['slide_list'] = $this->c_m->slide_list(
									$this->config['component_created_id']);

			return $this->CI->load->view($this->config['path_view'].
										'components/slide',$data,
									 	TRUE);
		}

		/**
		 * Get the single row view
		 */
		public function get_single_row(){
			$data['row'] = $this->c_m->single_row_detail(
									$this->config['component_created_id']);

			$data['order_component'] = $this->config['order_component'];
			$data['row_align'] = $this->row_align;


			return $this->CI->load->view($this->config['path_view'].
										'components/single_row',
										$data, TRUE);
		}



		/**
		 * Creating a single row component
		 */

		public function create_single_row(){
			
		 	$this->content_inside = $this->c_m->single_row_create(
				'Título','','Contenido', 'Más Información',
				 base_url().'','right',
				 $this->config['component_created_id']);

		}


		/**
		 * Created a abstract component, later to created 
		 * the detail component
		 * 
		 * Raw component
		 */
		protected function create_component(){
			$this->config['component_created_id'] = $this->pc_m->create(
									$this->config['page_id'], 
									$this->config['component_name'] , 
									'', $this->config['order_component']);
		}


		/**
		 * Creating the portfolio component
		 */
		public function create_portfolio($cant_items = 10){			

			for ($i = 1; $i <= $cant_items; $i++) { 
				$this->c_m->portfolio_create(
								$this->config['component_created_id'], '', 
								'Modifiqué el titulo', 
								'Sin Descripción', $i);
			}

		}


		/**
		 * Create the slide component
		 */
		public function create_slide($cant_items = 5){

			for ($i = 1; $i <= $cant_items; $i++) { 
				$this->c_m->slide_create($this->config['component_created_id'],
										'', '', '', $i);

			}

		}



		/**
		 * Remove the page_component,
		 * Not important the component page by id
		 * 
		 * @return {void}
		 */
		public function remove($component_created){			
			$this->pc_m->page_component_remove($component_created);
		}

		public function __destruct(){
			unset($this);	
		}



		/**
		 * Ordered component ASC
		 */
		public function ordered($arr_order,$page_id){

			if (count($arr_order) > 0){
				foreach ($arr_order as $index => $page_component) {
					echo $index;
					$this->pc_m->ordered($page_component, $index + 1);
				}	
			}
		}


		public function edit_slide(){

		}

		public function edit_single_row(){

			$config['upload_path'] = './uploads/';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size'] = 100;

	        $this->CI->load->library('upload');


        	if (!$this->upload->do_upload('portfolio_'.$portfolio_id)){
        		var_dump($this->upload->display_errors());
        		$portfolio_image = '';
        	}
        	else { 
        		$portfolio_image = $this->upload->data()['file_name'];
        	}

			$this->c_m->portfolio_edit($portfolio_id, $portfolio_image,
									   $portfolio_title, 
									   $portfolio_description, 99);
			
	        
		}


		/**
		 * Edit the portfolio
		 */
		public function edit_portfolio(){

		}

}


?>
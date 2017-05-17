<? defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * @package GestionCMS
 * @subpackage Inmobiliaria/fracciones
 * @author Ivan Fretes
 */
class Gestion_fracciones extends CI_Controller {


	public function __construct(){
		parent::__construct();

		$this->load->model('inmobiliaria/fraccion_model','fraccion_model');
		$this->base_url = base_url().'gestion/fracciones/';

		//$this->output->enable_profiler(TRUE);
	}

	/**
	 * -- Basic operation --
	 */


	/**
	 * Lista todas las fracciones
	 * @return {void} 
	 */
	public function index(){
		$this->load->library('pagination');
		$data['title'] = 'Fracciones';
		$config['base_url'] = $this->base_url;
		$page_num = $this->uri->segment(3);

        // Si page_num no se encuantra inicializado
		if (NULL === $page_num) $page_num = 1;
		

		// Cantidad de Fracciones
		$data['count_products'] =  $this->fraccion_model->count_fracciones();
		$config['total_rows'] = $data['count_products'];
		$config = pagination_custom($config);

		// limit per page
		$limit_end = ($page_num - 1) * $config['per_page'];

		/**
		 * Valor inicial del primer item
		 * @example page 2 page_init = 11
		 */
		$data['page_init'] = $limit_end + 1;
		
		// Listado de fracciones
		$data['list_fracciones'] = $this->fraccion_model->get_fracciones(
													$config['per_page'],
													$limit_end);

		// Inicialimoz el pagination
		$this->pagination->initialize($config);

		// Load the views
		$data['fraccion_url'] = $this->base_url;
		$data['main_content'] = 'admin/inmobiliaria/fracciones/list';
		$this->load->view('admin/template', $data);
	}


	/**
	 * -- Georeferenciacion --
	 */

		/**
		 * Retorna el georef de la edicion de la fraccion
		 * 
		 * @param {number} $fraccion_id
		 */
		public function get_georef($fraccion_id){
			$fraccion_georef = $this->fraccion_model->get_georef($fraccion_id);
			
			echo $fraccion_georef->georef;
		}


		/**
		 * Crea una nueva georefencia
		 * Por defecto la creamos vacia
		 * 
		 * @param {number} $fraccion_id
		 * @return {boolean} Si se inserta retorna TRUE
		 */
		public function create_georef($fraccion_id){
			$this->fraccion_model->create_georef($fraccion_id,'');
		}



		/**
		 * Edita una georeferencia
		 * 
		 * @param  $paramname description
		 * @return {boolean} descriptionSi se modifica 
		 * la georeferencia retorna TRUE
		 */
		public function edit_georef($fraccion_id){
			$fraccion_georef = $this->input->post('fraccion_georef');

			//var_dump($fraccion_georef);	

			if (isset($fraccion_georef))
				$this->fraccion_model->edit_georef(
										$fraccion_id,$fraccion_georef);


		}


		/**
		 * Upload the thumbnail fraccion  
		 * Que sera insertada en el geojson
		 */
	
		public function upload_thumbnail(){
			
			// setting the upload
			$config['upload_path'] = './uploads';
	        $config['allowed_types'] = 'gif|jpg|png';
	        $config['max_size'] = 100;
	        $config['max_width'] = 1024;
	        $config['max_height'] = 768;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file')){
				$error = array('error' => $this->upload->display_errors());
				echo 'Problema al subir';
			}
	        else {
	         	echo base_url().'test_img/'.$this->upload->data('file_name');
	        }

		}

}

?>
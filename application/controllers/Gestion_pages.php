<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package GestionCMS
 * @subpackage Website/pages 
 * @author Ivan Fretes
 * 
 */
class Gestion_pages extends CI_Controller {

	protected $error = 0;


	public function __construct(){
		parent::__construct();
		$this->base_url = base_url().'gestion/pages/';

		if(!$this->session->userdata('logged_in')){
            redirect('gestion/login');
        }

        $this->load->model('General/page_model','p_m');
        $this->load->model('General/widget_model','w_m');

        $this->load->library('upload');

       	//$this->output->enable_profiler(TRUE);


       	$this->link_route = print_link_route($this->uri);
	}

	
	/**
	 * Lista todas las páginas
	 * @return {void}
	 */
	public function index(){
		$this->load->library('pagination');
		$data['g_category'] = 'Páginas';


		$config['base_url'] = base_url().'gestion/pages/';
		$page_num = $this->uri->segment(3);

		// Si el page num esta inicializada
		if (NULL === $page_num) $page_num = 1;

		// Cantidad de elementos a ser visualizados
		$data['count_products'] =  $this->p_m->count_pages();
		$config['total_rows'] = $data['count_products'];
		$config = pagination_custom($config);

		// Limite de items/pages a ser visualizados		
		$limit_end = ($page_num - 1) * $config['per_page'];

		/**
		 * Valor inicial del primer item
		 * @example page 2 page_init = 11
		 */
		$data['page_init'] = $limit_end + 1;

		// Listado de páginas
		$data['list_pages'] = $this->p_m->get_pages($config['per_page'],
													$limit_end);

		
		//initializate the panination helper 
		$this->pagination->initialize($config);

		//load the view
		$data['page_url'] = $this->base_url;
		$data['main_content'] = 'admin/pages/page_list';
		$this->load->view('admin/template', $data);
		
	}


	/**
	 * Data load in the page and respectives components 
	 * of the page by ID
	 * @return {} description
	 */
	public function get_page($page_id){ 



		if (!$this->p_m->get_page_by_id($page_id)){
			show_404();
		}

		$data['g_category'] = 'Páginas » Editar';

		// list component by page_id
		$list_component = $this->w_m->get_widget_list($page_id);

		// Load the page component library
        $this->load->library('widget_custom');

        //setting the component library
        $config['page_id'] = $page_id;
        $this->widget_custom->initialize($config);
        

        $data['components_name'] = $this->widget_custom->get_widget_name();
		$data['page_detail'] = $this->p_m->get_page_by_id($page_id);
		$data['array_component'] = $this->widget_custom->get_all_widgets();
		
		
		$data['page_url'] = $this->base_url;

		
		// load the view
		$data['main_content'] = 'admin/pages/page_detail';
		$this->load->view('admin/template',$data);

	}


	/**
	 * Edit a page
	 * @param {number} $page_id
	 */
	public function edit_page($page_id = NULL){

		// Verififica que exista la página
		if (NULL !== $this->p_m->get_page_by_id($page_id)){

			$page_title = $this->security->xss_clean(
									$this->input->post('p_title'));
			$page_subtitle = $this->security->xss_clean(
									$this->input->post('p_subtitle'));
			$page_description = trim($this->security->xss_clean(
									$this->input->post('p_description')));

			
			$page_portada = upload_custom($this->upload, 'page_portada');

			// Creamos una nueva página
			$add = $this->p_m->edit_page($page_id, $page_title, 
										$page_subtitle, $page_description, 
										'',$page_portada, 
										date("Y-m-d H:i:s"));

			if ($add) $msg = 'Se editó la página';
			else {
				$msg = 'No se creó la página';
				$this->error = 1;
			}

		}
		else {
			$msg = '';
			$this->error = 1;
		}
		

		// Print the msg
		$msg = htmlentities($msg);
		echo json_encode(array('msg' => $msg, 'error' => $this->error ));
	}


	/**
	 * Create a page
	 * 
	 * @return {void}
	 */
	public function create_page(){
		

		$page_url = $this->security->xss_clean(
										$this->input->post('p_url'));

		/**
		 * Verifica que la URL se encuentre disponibled y no este
		 * vacia
		 */
		if (NULL === $this->p_m->get_page_by_url($page_url) && 
			strlen($page_url) > 0){

			// limpiamos la URL
			$page_url = convert_accented_characters($page_url);


			$page_title = $this->security->xss_clean(
									$this->input->post('p_title'));
			$page_subtitle = $this->security->xss_clean(
									$this->input->post('p_subtitle'));
			$page_description = trim($this->security->xss_clean(
									$this->input->post('p_description')));


			// Realizamos el proceso de subida, cargamos el helper
			$page_portada = upload_custom($this->upload, 'page_portada');

			// Creamos una nueva página
			$add = $this->p_m->create_page($page_title, $page_subtitle, 
							   $page_description, $page_url,
							   $page_portada, date("Y-m-d H:i:s"));
			


			// Mensaje de creacion de la página
			if ($add) $msg = 'Se creó la página';
			else {
				$msg = 'No se creó la página';
				$this->error = 1;
			}
				
		}
		else {
			$msg = 'No se creó la página';
			$this->error = 1;
		}


		// Print the msg
		$msg = htmlentities($msg);
		echo json_encode(array('msg' => $msg, 'error' => $this->error ));
		
	}


	/**
	* Remove Page
	* @return {void}
	*/
	public function remove_page(){
		$page_id = intval($this->security->xss_clean(
							$this->input->post('data_send')));
		
		//if (!$page_id) show_404();

		$remove = $this->p_m->remove_page($page_id);

		if ($remove) json_encode('No se eliminó la página');
		else json_encode('Se eliminó la página');
	}	

}
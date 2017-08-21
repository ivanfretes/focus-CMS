<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * Contralador de Gestion de los elementos relacionos con las páginas
 * 
 * @package GestionCMS
 * @author Ivan Fretes
 */
class Gestion_pages extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->base_url = base_url().'gestion/pages/';

		if(!$this->session->userdata('logged_in')){
            redirect('gestion/login');
        }

        $this->load->model('General/page_model','page_model');

		//$this->output->enable_profiler(TRUE);
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
		
		// Cantidad de registros por pagina 
		$per_page = 25;

		// Si el usuario solicita otra cantidad de registros a ser visualizado
		if (NULL !== $this->input->get('rows'))
			$per_page = $this->input->get('rows');


		// Retorna el registro inicial, para inicial el conteo
		$data['row_init'] = get_init_row($page_index, $per_page);
		
	
		// Listado de páginas
		$data['page_list'] = $this->page_model->get_all($data['row_init'], 
														$per_page);
		
		// Generamos Pagination
		$data['total_row'] = $this->page_model->get_count();
		$pagination = pagination_custom($per_page, $data['total_row']);
		$this->pagination->initialize($pagination);

		//Cargamos la vista
		$data['cant_row'] =  $this->page_model->get_count();
		$data['main_content'] = 'admin/pages/page-list';
		$this->load->view('admin/template', $data);
		
	}



	/**
	 * Inicio redireccion a all pages
	 */
	public function index(){
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
			$page_data = fieldname_to_entity(array('g-' => 'page_'), $_POST);

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
	 * Creamos una nueva página
	 * 
	 * @return {void}
	 */
	public function create(){
		
		// En caso que enviemos el formulario
		if ($this->input->post('g-submit')){
			$page_data = fieldname_to_entity(array('g-' => 'page_'), $_POST);
			

			if ($last_page = $this->page_model->create($page_data))
				//echo json_encode(TRUE);
				redirect(base_url('gestion/pages/edit/'.$last_page));
			else 
				echo json_encode(FALSE);

			exit();
		}

		// Cargamos la vista
		$data['main_content'] = 'admin/pages/page-form';
		$this->load->view('admin/template',$data);

	}

	

	/**
	* Elimina una página
	* @return {void}
	*/
	public function remove($page_id){
		
		if ($this->input->post('g-submit')){
			$remove = $this->page_model->remove($page_id);
			json_encode($remove);
		}
		else
			redirect(base_url('gestion/pages'));

	}	

}
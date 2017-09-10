s<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * -- No Activo --
 * @package focusCMS
 * @author Ivan Fretes
 */
class User extends CI_Controller { 


	public function __construct(){
		parent::__construct();


		// Por el momento redireccionamos a pages
		redirect(base_url('focus/pages'));
	}


	/**
	 * Lista todos los usuarios generados
	 */
	public function all(){

	}


	/**
	 * Crea un nuevo usuario
	 */
	public function create(){

	}



	/**
	 * Edita un usuario por ID
	 * 
	 * @param {number} $user_id
	 */
	public function edit($user_id){

	}



	/**
	 * Elimina un usuario por ID
	 * 
	 * El ID se recibe por POST
	 */
	public function remove(){

	}


}
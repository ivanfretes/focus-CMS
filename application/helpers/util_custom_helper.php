<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 *
 * @package		GestionCMS
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Ivan Fretes
 */



// Verify the 'Ñ' letter	
if (! function_exists('verify_chars')){
	function verify_chars($value){
		return str_replace('Ã‘', 'Ñ', $value);
	}
}

// custom feature pagination 
if (! function_exists('pagination_custom')){
	function pagination_custom($custom_config = array()){
		
		//pagination settings
        $config['per_page'] = 10;
        $config['base_url'] = '';

        // echo $config['base_url'];
        // return;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 2;
        $config['full_tag_open'] = `<nav aria-label="Pagination">
        								<ul class="pagination">`;
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        // $config['next_tag_open'] = '<li>';
        // $config['next_tag_close'] = '</li>';
        // $config['prev_tag_open'] = '<li>';
        // $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = '«';
        $config['last_link'] = '»';
        $config['next_link'] = '';
        $config['prev_link'] = '';
		

		if (0 < count($custom_config)){
			foreach ($custom_config as $key => $value) {
				$config[$key] = $value;
			}	
		}
		
		return $config;
	}
} 



/**
 * Custom Upload
 * @param {objetc} $upload_library is $CI->upload
 */
if (! function_exists('upload_custom')){
	function upload_custom(	$uplaod_library, $file_tag_name, 
							$custom_config = array() ){
		
		// upload setting
		$config['upload_path']          =  './uploads/images/';
  		$config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             =  300;
        //$config['max_width']            =  1024;
        //$config['max_height']           =  768;


        // Remplaza valores por defecto
		if (0 < count($custom_config)){
			foreach ($custom_config as $key => $value) {
				$config[$key] = $value;
			}	
		}


		// inicializamos la libreria upload
		$uplaod_library->initialize($config);

		// Subimos el archivo si esta inicializado
		if (!$uplaod_library->do_upload($file_tag_name))
	        $img_name = '';
		else {
			$file = $uplaod_library->data();
			$img_name = $file['file_name'];
		}

		
		return $img_name;
	}
}

// Verificamos si existen hasta 3 sub categorias para asignarle la ruta
if (! function_exists('print_link_route')){
	function print_link_route($uri){

		$url_route = [];

		if(NULL !== $uri->segment(2)) 
			array_push($url_route, $uri->segment(2));

		if(NULL !== $uri->segment(3)) 
			array_push($url_route, $uri->segment(3));

		if(NULL !== $uri->segment(4)) 
			array_push($url_route, $uri->segment(4));		

		return $url_route;
		
	}
}


// Mostramos un mensaje  en JSON
if (! function_exists('print_json_msg')){
	function print_json_msg($msg, $error){

		echo json_encode(array('msg' => $msg, 
								'error' => $error ));
		
	}
}








?>
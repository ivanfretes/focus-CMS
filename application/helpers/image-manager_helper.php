<?
/**
 * Funciones relacionadas al tratamiento con imagenes
 */


/**
 * Redimensiona una imagen con la libreria GD
 * 
 * @param {number} $width : Nuevo ancho de la imagen
 * @param {number} $height : nuevo alto de la imagen
 * @param {string} $source_image nombre de la imagen
 * 		  Se asume el directorio './uploads/images/', como base
 * @param {array} $custom_config : configuraciones personalizadas
 * 
 * @return {string} : Retorna la nueva ruta de la imagen redimensionada 
 * 					  o en caso contrario ''
 */
if (!function_exists('resize_image_with_gd')){
	function resize_image_with_gd($width, $height, $source_image, 
								  $custom_config = NULL){
		$ci = & get_instance();

		
		if (!not_value($source_image)){

			// Configuraciones por defecto
			$config['image_library'] = 'gd2';
			$config['source_image'] =  './uploads/images/'.$source_image;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['width']         = $width;
			$config['height']       = $height;
			$config['image_library'] = 'GD2';
			$config['new_image'] = './uploads/images/resized/'.$source_image;
		
			// Agrega o remplazamos confiraciones 
			if (0 < count($custom_config)){
				foreach ($custom_config as $key => $value) {
					$config[$key] = $value;
				}	
			}


			try {
				$ci->image_lib->initialize($config);

				if (!$ci->image_lib->resize())
					throw new Exception("Imagen no redimensionada");
				
				return ltrim($config['new_image'], './');

			} catch (Exception $e) {
				echo $ci->image_lib->display_errors();
				echo $e->getMessage();

			}	
		}

		return '';

	}
}

	

/**
 * Sube una imagen - Retorna el nombre del archivo que fue subido
 * @param {string} $file_tab_name : $_REQUEST[field_tab_name
 * @param {array} $custom_config : configuraciones personalizadas
 * 
 * @return {string} 
 */
if (! function_exists('upload_image')){
	function upload_image($file_tag_name, 
						  $custom_config = array()){

		$ci = & get_instance();
		
		// Configuraciones por defecto
		$config['upload_path']	=  './uploads/images/';
  		$config['allowed_types'] = 'gif|jpg|png';
  		$config['remove_spaces'] = TRUE;
  		$config['file_permissions'] = '0777';

        // Agrega o remplazamos configuraciones 
		if (0 < count($custom_config)){
			foreach ($custom_config as $key => $value) {
				$config[$key] = $value;
			}	
		}

		$ci->upload->initialize($config);



		// -- Modificar --
		// Remplazar por una excepcion, de carga de la imagen
		
		// Subimos el archivo en caso que no existan inc
		if (!$ci->upload->do_upload(trim($file_tag_name))){
	        $img_name = '';
		}
		else {
			$file = $ci->upload->data();
			$img_name = $file['file_name'];
		}

		return $img_name;

	}
}


/**
 * Verificar funcion
 * Redimensiona una imagen en base al heigth 
 * de forma proporcional
 * @param {number} $height : nueva altura en pixeles
 * @return {string} 
 */
if (! function_exists('resize_with_height')){ 
	/**
	 * Code
	 */
}


/**
 * Verificar funcion
 * Redimensiona una imagen en base al width
 * de forma proporcional
 * @param {number} $width : nuevo ancho en pixeles
 * @return {string} 
 */
if (! function_exists('resize_with_width')){ 
	/**
	 * Code
	 */
}





?>

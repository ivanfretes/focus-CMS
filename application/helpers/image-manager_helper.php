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
	function resize_image_with_gd($width, $height, $image_name, 
								  $custom_config = NULL){
		$ci = & get_instance();

		
		if (!not_value($image_name)){

			// Path base de las imagenes
			$bpath = './uploads/images/';
			
			// Renombramos la imagen a ser redefinida, imagen temporal (datos)
			$itmp = remove_extension_image($image_name);

			// Nombre de imagen _size_ y el tipo extension
			$iname = $itmp[0]."_size_".$width."_x_".$height.$itmp[1];
			$ipath = $bpath."resized/".$iname;
			
			
			// Configuraciones por defecto
			$config['source_image'] =  $bpath.'raw/'.$image_name;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['width']         = $width;
			$config['height']       = $height;
			$config['image_library'] = 'GD2';
			$config['new_image'] = $ipath;
			
			
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
 * Sube n cantidad de imagenes, en base a sus etiquetas
 * Retorna las rutas de los archivos subidos
 * 
 * @param {string} $file_list : Listado de archivos - $_FILES
 * @param {array} $custom_config : configuraciones personalizadas
 * 
 * @return {array} 
 */
if (! function_exists('upload_images')){
	function upload_images(){
		$array_return = [];

		// Listado de tags generados de los archivos subidos
		$file_tag_list = file_tag_list($_FILES);

		foreach ($file_tag_list as $tag_name) {

			if (!not_value($_FILES[$tag_name]['tmp_name']))
				
				// Datos del archivo {array}
				$array_return[$tag_name] = upload_file($tag_name);
		} 

		return $array_return;
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




/**
 * Verificar funcion
 * Redimensiona una imagen en base al width
 * de forma proporcional
 * @param {string} $file_name : Nombre de archivo 
 * @param {array} $extension_list : conjunto de extensiones a buscar
 * @return {array} or NULL
 */
if (! function_exists('remove_extension_image')){ 
	
	function remove_extension_image($file_name){

		$a = array('.JPG', '.jpg', '.JPEG','.jpeg','.PNG','.png');
		return remove_extension_files($file_name, $a);
	}	
}





?>

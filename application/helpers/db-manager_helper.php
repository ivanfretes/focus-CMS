<?


/**
 * Nombre de campos para la tabla
 * 
 * Configura la tag <input/select/textareas name="?"> y etiquetas html, 
 * para que sus claves puedan ser referenciadas en altas o modificaciones
 * de la base de datos y evitemos la replicacion de datos
 * 
 * Las tags por defecto tiene una g_* al inicio, pero puede ser cualquier 
 * prefijo. Extraemos la g_ y agregamos el fieldname_ de la tabla
 * 
 * Por otra parte es importante mencionar, que siempre, al nombre de nuestro
 * <input type='submit' name="submit"> , debemos asignarle la palabra
 * submit a la etiqueta name
 * 
 * (Obs) Queda pendentie agregar el post_fijo 
 *  
 * Remplazar por una expresion regular
 * 
 * @example [g_]nombre -> [organizacion_]nombre
 * 
 * @param {array} $remplace_field : prefijo remplazantes
 * @param {array} $defautl_prefix : prefijos a ser remplazados 
 * //@param {boolean} $reg_exp : Si es una expresion regular
 * 
 * @return {array} : Listado con claves modificadas 
 */

if (! function_exists('fieldname_to_entity')){
	function fieldname_to_entity($remplace_prefix = array(),  
							     $list = array(), $reg_exp = FALSE){
		$array_return = [];

		/**
		 * @var {array} $list Listado a recorrer
		 * @var $attr_name = $list['$attr_name']; eg $_REQUEST['$g_nombre'];
		 */
		

		try {
			if (0 >= count($list) || NULL == $list) 
				throw new Exception("Indice incorrecto del parametro list");

			// Array donde buscar las coincidencias 	
			foreach ($list as $attr_name => $value) {

				// Si no tiene la palabra submit /*&& !not_value($value)*/
				if (!strpos($attr_name, 'submit')){

					foreach ($remplace_prefix as $old_prefix => $new_prefix){


						// Si es una expresion regular
						if ($reg_exp){
							$key_tmp = preg_replace($old_prefix, $new_prefix,
												 	$attr_name);
						}
						else {
							$key_tmp = remplace_first_ocurrence($old_prefix, 
																$new_prefix,
																$attr_name);	
						}	
						

						// Si el campo es igual al elemento generado
						if (strcmp($key_tmp, $attr_name))
							break;
					}

					// Remplazamos la antigua clave del array y asignamos 
					// su valor
					$array_return[$key_tmp] = $value; 
				}
			}

			return $array_return;

		} catch (Exception $e) {
			echo $e->getMessage();	
		}

	}
}


/**
 * Busca en un listado ascendente un conjunto de coincidencias 
 * de cada clave y de estos genera sub arrays. 
 * 
 * Sirve para insertar o actualizar en más de una tabla 
 * sin necesidad de manegar el nombre de los campos.
 * 
 * (*) -- Se sugiere ver fieldname_to_entity() para generar los nombres 
 * 		  de los atributos automaticamente --
 * 
 * @param {array} $list : Listado de atributos
 * @param {string} or {array} $entity_name: Por ej. nombre de la tabla
 * 
 * @return {array}
 */
if (!function_exists('list_entity_attribute')){
	function list_entity_attribute($list = array(), $entity_name){
		$array_return = [];

		// Ordenamos por clave el listado (asc)
		ksort($list);

		foreach ($list as $fieldname => $value) {
			if (0 === strpos($fieldname, $entity_name))
				$array_return[$fieldname] = $value;	
		}

		return $array_return;
	}
}





/**
 * Busca en un listado ascendente un conjunto de coincidencias 
 * con la clave y genera otro array de este. Sirve
 * para insertar o actualizar una tabla sin necesidad de manegar
 * el nombre de los campos.
 * 
 * Se sugiere ver add_fieldname_in_tag() para el funcionamiento
 * automatico
 * 
 * @param {array} $list : Listado de 
 * @param {string} or {array} $entity_name: por ejemplo producto
 * @return {array}
 */
if (!function_exists('multiple_entity_attribute')){
	function multiple_entity_attribute(	$list = array(), 
									  	$entity_name = array(), 
										$dimension = FALSE){
		$array_return = [];

		// Ordenamos por clave el listado (asc)
		ksort($list);

		foreach ($entity_name as $patron_field) {
			$array_tmp = [];

			foreach ($list as $fieldname => $value) {
				if (0 === strpos($fieldname, $patron_field)){
					$array_tmp[$fieldname] = $value;
				}
				else 
					continue;
				
			}

			$array_return[$patron_field] = $array_tmp;	
			
		}

		return $array_return;
	}
}




?>
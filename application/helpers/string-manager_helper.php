<?

/**
* 
* Verifica la letra Ñ, entre otros caracteres especiales
* @param {string} $key description
* @return {string} 
*/ 
if (! function_exists('verify_chars')){
	function verify_chars($key_value){
		return str_replace('Ã‘', 'Ñ', $key_value);
	}
}




/**
 * Remplaza la primera ocurrencia, si existe, caso contrario
 * no modifica la cadena, 
 *	
 * -- Modificar por expresiones reguleres --
 * 
 * @param string $prefix : string a remplazar
 * @param string $prefix_replacement : string remplazador 
 * @param string $text : texto donde buscar
 * 
 * @return string 
 */
if(!function_exists('remplace_first_ocurrence')){
	function remplace_first_ocurrence($prefix, $prefix_replacement,$text){

		// Posicion de ocurrencia
		$position_occurrence =  strpos($text, $prefix);

		// Posicion de remplazo
		$position_replace = $position_occurrence + strlen($prefix);

		$text_1 = substr($text, 0, $position_replace);
		$text_2 = substr($text, $position_replace , strlen($text));

		$text_1 = str_replace($prefix, $prefix_replacement, $text_1);	
	
		return $text_1 . $text_2;
	}	
}

?>
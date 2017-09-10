<?


/**
 * Retorna el menor numero positivo 1
 * 
 * @param datatype $paramname description
 * @return {number} : numero positivo 
 */

if (! function_exists('get_minor_positive_number')){

	function get_minor_positive_number($number){
		
		if (0 >= $number) 
			return 1;

		return $number;
	}
}



/**
 * Retorna todos los numeros encontrtados en un string,
 * y los convierte en array
 * @param {string} $string 
 * 
 * @return {array}
 */
if (!function_exists('number_in_string')){
	function number_in_string($string){
		try {			
			if (!is_string($string))
				throw new Exception("Error tipo de dato "+$string);

			preg_match_all("/\d+/", $string, $matches);

			// Retornamos los numeros encontrados
			return $matches[0];
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}
}

?>
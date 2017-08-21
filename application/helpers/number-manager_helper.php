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
?>
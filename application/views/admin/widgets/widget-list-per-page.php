<?
/**
 *  Listado de widgets por pagina
 */
?>

<!-- Listado de Widgets posibles  -->
<form id="select-widget">
	<input value="row" type="radio" name="get-widget">
	<input value="slide" type="radio" name="get-widget">
	<input value="cuadricula" type="radio" name="get-widget">
</form>


<?

	// Verificamos que se hayan creados widgets para la pagina 
	if (!not_value($widget_list)){
		// Listao de  vistas de todos los widgets
		foreach ($widget_list as $widget) {
			
			// Anexamos la vista del widget a un array
			echo $widget;
			echo "<hr>";	
		}	
	}
	else {
		// La pagina aun no cuenta con widgets
	}


?>


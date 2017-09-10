<?
/**
 * Listado de widget por pagina 
 * 
 */

foreach ($widget_list as $widget_data) {
	$type = $widget_data['widget_type'];
	$this->load->view("frontend/widgets/widget-$type", $widget_data);
}
?>




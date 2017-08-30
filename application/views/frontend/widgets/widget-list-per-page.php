<?
/**
 * Listado de widget por pagina 
 * 
 * @var
 * $folder_view : Representa a la vista generada desde la session
 */


foreach ($widget_list as $widget_data) {

	$data['widget'] = $widget_data;

	$this->load->view($folder_view.'widgets/widget-'.$data['widget']['type'],
					  $data);
	
}

?>



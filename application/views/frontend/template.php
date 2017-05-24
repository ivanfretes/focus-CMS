
<? $this->load->view('frontend/theme/header'); ?>
<div id="wrapper">

<? 
	/**
	 * -- Cargamos el menu generado --
	 */	
	get_menu_front(); 
?>

<? $this->load->view('frontend/theme/page_cover'); ?>


<? 

	/**
	 * Si esta disponible, mostramos los 
	 * html generados, caso contrario buscamos un contenido customizado
	 * con main_page
	 */

	if (isset($list_components)){
		foreach ($list_components as $component) {
			echo $component;
		}	
	}
	else if (isset($main_content)) {
		$this->load->view($main_content);
	}	
?>


<? $this->load->view('frontend/theme/footer'); ?>
</div>




<div class="widget-container" data-page="<?= $page_id?>">


	<!-- Barra fija -->
	<div class="theme-container-head">
	    <div class="row">
	        <div class="col-md-9">
	            <ul id="widget-select">
					<li data-value="row">
						<span class="glyphicon glyphicon-list-alt"></span>
						Fila 
					</li>

					<li data-value="cuadricula" >
						<span class="glyphicon glyphicon-th"></span>
						Cuadricula 
					</li>

					<li data-value="slide">
						<span class="glyphicon glyphicon-blackboard"></span>
						Slide
					</li>
				</ul>
	        </div>
	    </div>
	</div>


	<? // Listado de vistas generadas ?>
	<div class="col-md-9">
	<ul id="widget-list">
<?

	// Verificamos que se hayan creados widgets para la pagina 
	if (!not_value($widget_list)){

		// Listao de vistas de todos los widgets
		foreach ($widget_list as $widget_view) {

			// Anexamos la vista del widget a un array
			echo $widget_view;
				
		}	

	}
	else {
		// La pagina aun no cuenta con widgets
	}

?>
	</ul>
	</div>
</div>


<div class="widget-container" data-page="<?= $page_id?>">


	<!-- Barra fija -->
	<div class="theme-container-head">
	    <div class="row">
	        <div class="col-md-6 col-md-offset-3">
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

			<div class="col-md-3 text-center">
				<div class="col-md-5">
					<span class="glyphicon glyphicon-edit"></span>
					<a href="<?= base_url("focus/pages/edit/$page_id") ;?>"><br>Editar Página</a>
	
				</div>
				<div class="col-md-5">
					<span class="glyphicon glyphicon-eye-open"></span>
					<a href="<?= base_url($page_url) ;?>"
					   target="parent" ><br>Ver Página</a>
					
				</div>
				
			</div>        
	
			

	    </div>
	</div>

	<div class="col-md-12 text-center">
		<h3 style="color: #753a88;font-weight: bold; text-shadow: 1px 1px 1px #777; font-size:30px"><?= $page_title; ?></h3>
	</div>

	<? // Listado de vistas generadas ?>
	<div class="col-md-9">
	
	

	<ul id="widget-list">
<?

	// Verificamos que se hayan creados widgets para la pagina 
	if (!not_value($widget_list)){

		foreach ($widget_list as $widget_data) { 

			// -- Contenedor de widget -- 
			$this->load->view('admin/widgets/widget-form', $widget_data);	
		}

	}

?>
	</ul>
	</div>
</div>
<?

/**
 * -- Modificar --
 * 
 *  Boton eliminar portada
 * 	Boton no visualizar portada
 *  
 */
?>

<div class="theme-container-head">
	<div class="col-md-8">
		<input type="text" class="form-control input-lg" 
			   name="g-title" id="g-title"
			   <?= default_value_input($page_title); ?>
			   placeholder="Título"><br>
			   
		<input type="text" class="form-control" name="g-url" 
		   id="g-url" <?= default_value_input($page_url); ?>
		   required>
	</div>
	
	<div class="col-md-1 text-center">
		<a href="<?= base_url("focus/pages/$page_id/widgets"); ?>">
				<span class="glyphicon glyphicon-plus-sign"></span>
				<br>Agregar Widget
		</a>
	</div>

	<div class="col-md-1 text-center">
		<span class="glyphicon glyphicon-eye-open"></span>
		<a href="<?= base_url(default_value($page_url)) ;?>"
		   target="parent" ><br>Ver Página</a>
	</div>
	
	<div class="col-md-2">
		<input type="submit" name="g-submit" value="Guardar"
			   class="btn btn-lg btn-success">
	</div>

	
</div>

<div class="clear"></div>

<form method="post" enctype="multipart/form-data" id="page-form">
	
	<div class="page-container">
			
		<!-- Imagen de portada-->
		<?	

			// Si existe portada
			if (!not_value($page_portada_url)) 
				$portada_url = base_url($page_portada_url);
			else 
				$portada_url = base_url('static/images/default_cover.png');
		?>
		
		<div class="page-portada-container"
		     style="background-image: url('<?= $portada_url;?>')">
					
			<!-- <a href="" id="" data data-action="remove">[ Eliminar Portada ]</a> -->

			<div class="page-portada-file" >
				<label for="g-portada_url">Portada:</label>
				<input type="file" name="g-portada_url" id="g-portada_url">
			</div>
	
		</div>
		
		

		<div class="form-group">
			<label for="g-subtitle">Descripción de Portada:</label>
			<div data-action="editable" id="g-subtitle" class="box-editable">
				<?= default_value($page_subtitle); ?>
			</div>
		</div>

		

		<div class="form-group">
			<label for="g-description">Contenido:</label>
			<div data-action="editable" id="g-description" 
				 class="box-editable">
				<?= default_value($page_description); ?>
			</div>
		</div>
		
		<div class="col-md-3">

			<div class="form-group">
				<label for="">Estado:</label>
				<select class="form-control" name="g-status" id="g-status"> 
					<?
						$page_state_list =  array('Borrador', 'Público');
						default_value_select2($page_state_list, $page_status);	
					?>
				</select>
			</div>	

		</div>
		<div class="col-md-3 text-center">

			<div class="form-group">
				<label for="g-main">Página Principal / Index:</label>
				<input <?= default_value_icheckbox($page_main, TRUE); ?>
				       type="checkbox" name="g-main" id="g-main" 
				       class="form-control">
			</div>
		</div>

		
		

	</div>
	

</form>
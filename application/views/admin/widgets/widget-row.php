<?
	/**
	 * Campos del formulario de edición de una fila
	 */

	$row = $widget;
	$row_id = $row->row_id;
	$widget_id = $row->widget;


	// Nombre de los labels e id's
	$title = "g-{$row_id}_title";
	$subtitle = "g-{$row_id}_subtitle";
	$content = "g-{$row_id}_content";
	$btn_title = "g-{$row_id}_btn_title";
	$btn_link = "g-{$row_id}_btn_link";
	$orientation = "g-{$row_id}_orientation";
	$background = "g-{$row_id}_background";
	$image = "g-{$row_id}_image";
	$image_position = "g-{$row_id}_image_position";
	$video_url = "g-{$row_id}_video_url";

	// Alineacion posible del row de dos columnas
	$row_align = array('left' => '2 columnas, imagen a la derecha',
					   'right' => '2 columnas, imagen a la izquierda',
					   'centro' => 'Sin columna'); 

?>

<form action="<?= base_url("focus/row/edit/$widget_id"); ?>"
  		  enctype="multipart/form-data"  method="post"
		  id="widget-form-<?= $widget_id; ?>">


	<div class="row">
		
		<!-- Titulo de la fila -->
		<div class="col-md-12">
			<label for="<?= $title ; ?>"> Título: </label>
			<input type="text" name="<?= $title ;?>" 
				   class="form-control input-lg" id="<?= $title ;?>"
				   placeholder="Título" 
				   <?= default_value_input($row->row_title);?>>

		</div>


		<!-- Subtitlo de la Fila -->
		<div class="col-md-12">
	        <label for="<?= $subtitle; ?>"> Subtítulo: </label>
	        <input type="text" name="<?= $subtitle; ?>" 
	               class="form-control input-lg" 
	               placeholder="Subtítulo" id="<?= $subtitle; ?>" 
	               <?= default_value_input($row->row_subtitle) ;?>>
	    </div>

		<!-- Contenido / Descripcion del documento -->
	    <div class="col-md-12">

	    	<label for="<?= $content ?>">Contenido: </label>
	        <div id="<?= $content ?>" data-action="editable" 
	             class="box-editable" data-fieldname="<?= $content ?>">
	            <?= default_value($row->row_content) ;?>
	        </div>

	    </div>

		
		<!-- Link del video -->
	    <div class="col-md-12">
	    	<label for="<?= $video_url; ?>" >Link del Video [URL]: </label>
	        <input type="text" name="<?= $video_url ;?>" 
	               class="form-control input-lg" id="<?= $video_url ;?>" 
	               <?= default_value_input($row->row_video_url) ;?>>
	    </div>
		
		<!-- Texto del Boton -->
	    <div class="col-md-6">
	    	<label for="<?= $btn_title; ?>" >Título del Botón: </label>
	        <input type="text" name="<?= $btn_title; ?>" 
	               class="form-control input-lg" id="<?= $btn_title; ?>" 
	               <?= default_value_input($row->row_btn_title) ;?>>
	    </div>


		<!-- Link del boton -->
	    <div class="col-md-6">
	    	<label for="<?= $btn_link; ?>" >Enlace del Botón: </label>
	        <input type="text" name="<?= $btn_link; ?>" 
	               class="form-control input-lg" id="<?= $btn_link; ?>" 
	               <?= default_value_input($row->row_btn_link) ;?>>
	    </div>
		


		<!-- Imagen de la fila -->
		<div class="col-md-8 container-image" >
	        
	        <div class="col-md-8">
	            <label for="<?= $image; ?>" class="control-label">
	            	Imagén : 
	            </label>

	            <input type="file" name="<?= $image; ?>" id="<?= $image; ?>" 
	               	   class="form-control input-lg">
	        </div>
			

			<!-- Imagen por defecto de la fila -->
	        <div class="col-md-4">

	<?
	    
		// Si la imagen esta vacia, asigna la de por defecto    
	    if (!not_value($row->row_image))
	        $row->row_image = base_url($row->row_image);            
	    else 
			$row->row_image = base_url('static/images/default_column.png');
	    
	?>

	          <img src="<?= $row->row_image; ?>" class="img-responsive img-portada">
	        </div>
	    </div>


		<!--  Lista la alineacion del texto  -->
	    <div class="col-md-4 text-center">
	    	
	    	<label for="<?= $orientation; ?>" >Orientación: </label>
			<select name="<?= $orientation; ?>" id="<? $orientation; ?>" 
					class="form-control input-lg" >
	<?  
		default_value_select2($row_align,$row->row_orientation);	
	?>
			</select>

	    </div>

	</div>

</form>

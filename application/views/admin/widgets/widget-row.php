<?
	/**
	 * Formulario de edición de una fila
	 */

	$id = $widget->row_id;

	// Nombre de los labels e id's
	$title = "g-{$id}_title";
	$subtitle = "g-{$id}_subtitle";
	$content = "g-{$id}_content";
	$btn_title = "g-{$id}_btn_title";
	$btn_link = "g-{$id}_btn_link";
	$orientation = "g-{$id}_orientation";
	$background = "g-{$id}_background";
	$image = "g-{$id}_image";
	$image_position = "g-{$id}_image_position";
	$video_url = "g-{$id}_video_url";



	var_dump($widget);
?>


<form action="<?= base_url("gestion/row/edit/$widget_id"); ?>"
      enctype="multipart/form-data"  method="post">

	<div class="row">
		
		<!-- Titulo de la fila -->
		<div class="col-md-12">
			<label for="<?= $title ; ?>"> Título: </label>
    		<input type="text" name="<?= $title ;?>" 
    			   class="form-control input-lg" id="<?= $title ;?>"
    			   placeholder="Título" 
    			   <?= default_value_input($widget->row_title);?>>

		</div>


		<!-- Subtitlo de la Fila -->
		<div class="col-md-12">
	        <label for="<?= $subtitle; ?>"> Subtítulo: </label>
	        <input type="text" name="<?= $subtitle; ?>" 
	               class="form-control input-lg" 
	               placeholder="Subtítulo" id="<?= $subtitle; ?>" 
	               <?= default_value_input($widget->row_subtitle) ;?>>
	    </div>

		<!-- Contenido / Descripcion del documento -->
	    <div class="col-md-12">

	    	<label for="<?= $content ?>">Contenido: </label>
            <div id="<?= $content ?>" data-action="editable" 
                 class="box-editable" data-fieldname="<?= $content ?>">
                <?= default_value($widget->row_content) ;?>
            </div>

	    </div>

		
		<!-- Link del video -->
	    <div class="col-md-12">
	    	<label for="<?= $video_url; ?>" >Link del Video [URL]: </label>
            <input type="text" name="<?= $video_url ;?>" 
                   class="form-control input-lg" id="<?= $video_url ;?>" 
                   <?= default_value_input($widget->row_video) ;?>>
	    </div>
		
		<!-- Texto del Boton -->
	    <div class="col-md-6">
	    	<label for="<?= $btn_title; ?>" >Título del Botón: </label>
            <input type="text" name="<?= $btn_title; ?>" 
                   class="form-control input-lg" id="<?= $btn_title; ?>" 
                   <?= default_value_input($widget->row_btn_title) ;?>>
	    </div>


		<!-- Link del boton -->
	    <div class="col-md-6">
	    	<label for="<?= $btn_link; ?>" >Enlace del Botón: </label>
            <input type="text" name="<?= $btn_link; ?>" 
                   class="form-control input-lg" id="<?= $btn_link; ?>" 
                   <?= default_value_input($widget->row_btn_link) ;?>>
	    </div>
		


		<!-- Imagen de la fila -->
		<div class="col-md-8 container-widget-portada" data-value="<?= $widget_id ?>">
            
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
        
        if (!not_value($widget->row_image))
            $widget->row_image = base_url($widget->row_image);            
        else 
 			$widget->row_image = base_url('static/images/default_column.png');
        
    ?>

              <img src="<?= $widget->row_image; ?>" class="img-responsive img-portada">
            </div>
        </div>


		<!--  Lista la alineacion del texto  -->
	    <div class="col-md-4 text-center">
	    	
	    	<label for="<?= $orientation; ?>" >Orientación: </label>
			<select name="<?= $orientation; ?>" id="<? $orientation; ?>" 
					class="form-control input-lg" >
	<?  
		default_value_select2($widget->row_align,$widget->row_orientation);	
	?>
			</select>

	    </div>


	</div>

</form>

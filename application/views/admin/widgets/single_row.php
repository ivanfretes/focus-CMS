<?

	/**
	 * Variable que son inicializadas desde el 
	 * contraloador/libreria
	 * 
	 * @var $row_align alineacion de la fila
	 * @var $widget_id Id del widget
	 * @var $widget_order Orden del widget
	 * @var $row {object} Conteniene todos los datos de la fila
	 * 
	 * 
	 * 
	 */

	if (NULL !== $row) :
		
		$row_id = $row->id_row;


?>
<li class="ui-sortable-component" 
	data-type-widget="single_row"
	data-order="<?= $widget_order ;?>" 
	data-widget="<?= $widget_id ;?>">   


	<h3>Fila</h3>

	<!-- Remove the component -->
	<div style="float:right;">        
		<a  class="btn btn-danger" 
				data-type="remove"
				href='<?= base_url().'gestion/widgets/remove/' ;?>' 
				data-widget="<?= $widget_id ;?>">
				<span class="glyphicon glyphicon-trash" 
							aria-hidden="true"></span>
		</a>
	</div>

	<form action="<?= base_url().'gestion/widgets/edit/single_row/';?>" 
			method="post" 
			enctype="multipart/form-data"
			data-component="<?= $row->id_row; ?>"
			id="single_row_form_<?= $widget_id; ?>">

		<div class="row">
			

			<!-- Titulo de la fila -->
			<div class="col-md-12">
				<label for="row_title"> Título: </label>
        		<input type="text" name="single_row_title_<?= $row_id; ?>" 
                     class="form-control input-lg" 
                     id="row_title" value="<?= $row->row_title ;?>"
                     placeholder="Título">

			</div>


			<!-- Subtitlo de la Fila -->
			<div class="col-md-12">
		        <label for="row_subtitle"> Subtítulo: </label>
		        <input type="text" name="single_row_subtitle_<?= $row_id; ?>" 
		               	class="form-control input-lg" 
		               	placeholder="Subtítulo"
		               	id="row_subtitle" 
		               	value="<?= $row->row_subtitle ;?>">
		    </div>

			<!-- Contenido / Descripcion del documento -->
		    <div class="col-md-12">

		    	<label for="row_description">Contenido: </label>
	            <div id="single_row_description_<?= $row_id ?>"
	                data-action="editable" 
	                class="box-editable">
	                <?= $row->row_content;?>
	            </div>

		    </div>

			
			<!-- Link del video -->
		    <div class="col-md-12">
		    	<label for="row_video" >Link del Video [URL]: </label>
                <input type="text" 
                       name="single_row_video_<?= $row_id; ?>" 
                       class="form-control input-lg" id="row_btn_title" 
                       value="<?= $row->row_video ;?>">
		    </div>
			
			<!-- Texto del Boton -->
		    <div class="col-md-6">
		    	<label for="row_btn_title" >Título del Botón: </label>
                <input type="text" 
                       name="single_row_btn_title_<?= $row_id; ?>" 
                       class="form-control input-lg" id="row_btn_title" 
                       value="<?= $row->row_btn_title ;?>">
		    </div>


			<!-- Link del boton -->
		    <div class="col-md-6">
		    	<label for="row_btn_link" >Enlace del Botón: </label>
                <input type="text" 
                       name="single_row_btn_link_<?= $row_id; ?>" 
                       class="form-control input-lg" id="row_btn_link" 
                       value="<?= $row->row_btn_link ;?>">
		    </div>
			


			<!-- Imagen de la fila -->

			<div class="col-md-8">
                
                <div class="col-md-8">
                    <label for="page_portada"
                       class="control-label">
                       Imagén : </label>

                    <input type="file" 
                    	name="single_row_img_<?= $row_id; ?>" 
                       	id="single_row_img_<?= $row_id; ?>" 
                       	class="form-control input-lg">
                </div>
				

				<!-- Imagen por defecto de la fila -->
                <div class="col-md-4">
                    <?
                        
                        if (NULL === $row->row_image)
                            $img_column = base_url().'static/images/default_column.png';
                        else {
                            $img_column = base_url().'uploads/images/'.$row->row_image; 
                        }

                    ?>

                    <img src="<?= $img_column; ?>" 
                        class="img-responsive img-portada">
                </div>
            </div>


			<!--  Lista la alineacion del texto  -->
		    <div class="col-md-4 text-center">
		    	
		    	<label for="row_align ;?>" >Alineacion: </label>

				<select name="single_row_align_<?= $row_id; ?>" 
						id="row_align" 
						class="form-control input-lg" >
					<?  
					// Verifica cual es el value por defecto
					foreach ($row_align as $align => $value) : 
						$selected_align = '';

						if ($row->row_orientation == $align) 
							$selected_align = 'selected';
					?>
							<option value="<?= $align; ?>" 
									<?= $selected_align; ?> >
									<?= $value; ?>
							</option>
					
					<? endforeach ?>
				</select>

		    </div>


		</div>
			
			
		<div class="clearfix"></div>
		<div class="form-group">	
			
		</div>

	</form>
		
</li>

<? 	endif ?>

<?
	
?>


<form method="post" id="form_`+order+`" enctype="multipart/form-data"
			data-row="<?= $row->id_row; ?>">


    <label for="row_title"> Título: </label>
    <input type="text" name="g_titulo" 
                 class="form-control input-lg" 
                 id="row_title" value="<?= $row->row_title ;?>">


    <label for="row_subtitle"> Subtítulo: </label>
    <input type="text" name="g_subtitulo" 
           class="form-control" 
           id="row_subtitle" value="<?= $row->row_subtitle ;?>">

    
    <div class="form-group">
        <label for="row_description">Contenido: </label>
        <div id="single_row_description_<?= $row_id ?>"
             data-action="edit" >
            <?= $row->row_content;?>
        </div>
    </div>
            
        
    <div class="form-group">
        <!-- Titulo del boton -->
        <label for="row_btn_title" 
               class="col-md-1">Título del Botón: </label>
        <div class="col-md-5">
            <input type="text" 
                   name="single_row_btn_title_<?= $row_id; ?>" 
                   class="form-control" id="row_btn_title" 
                   value="<?= $row->row_btn_title ;?>">
        </div>
        
        
        <!-- Linkdel Boton-->
        <label for="row_btn_link"
               class="col-md-1">Enlace del Botón: </label>
        <div class="col-md-5">
            <input type="text" 
                   name="single_row_btn_link_<?= $row_id; ?>" 
                   class="form-control" id="row_btn_link" 
                   value="<?= $row->row_btn_link ;?>">
        </div>
    </div>


		
		
	<div class="clearfix"></div>
	<div class="form-group">	
		<label for="row_align ;?>"
				class="col-md-1">Seleccionar Orientación: </label>
		<div class="col-md-5">
			<select name="single_row_align_<?= $row_id; ?>" 
					id="row_align" 
					class="form-control" >
				<?  
				// Verifica cual es el value por defecto
				foreach ($row_align as $align => $value) : 
					$selected_align = '';

					if ($row->row_orientation == $align) 
						$selected_align = 'selected';
				?>
						<option value="<?= $align; ?>" <?= $selected_align; ?> >
								<?= $value; ?>
						</option>
				
				<? endforeach ?>
			</select>
		</div>
	</div>

</form>
	


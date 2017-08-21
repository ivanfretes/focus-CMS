
<form action="<?= base_url("gestion/slide/edit/$widget_id");?>" 
      enctype="multipart/form-data" method="post">
	
    <ul class="grid_sortable">
    
    
<?  


    // Listado de todas las diapositivas
    foreach ($slide_list as $slide) : 
        
        // Id de cada slide
        $id = $slide->slide_id;
        

        // Si la slide tiene fondo/imagen
        if (!not_value($slide->slide_image))
            $bg_url = base_url($slide->slide_image);
        else 
            $bg_image = base_url('static/images/default_slide.png');

?>
        <li style="background-image: url(<?= $bg_image ;?>); " 
            data-slide-order="<?= $slide->slide_order; ?>" 
            data-slide-id="<?= $slide->slide_id; ?>">
          
          
            <div style="margin-top: 60px;">

                <input type="file" name="<?= "g-{$id}_image"; ?>" />
                <input <?= default_value_input($slide->slide_title); ?> 
                type="text" name="<?= "g-{$id}_title"; ?>" class="form-control" >

            </div>        
			</li>
		<? endforeach ?>
        <input type="submit" name="g-submit" value="Guardar">
        
	</ul>
</form>


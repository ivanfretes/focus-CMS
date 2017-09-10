
<form action="<?= base_url("focus/slide/edit/$widget_id");?>" 
      enctype="multipart/form-data" method="post" 
      id="widget-form-<?= $widget_id; ?>">
	
    <ul class="grid-sortable">

<?  

    $slide_list = $widget;

    // Listado de todas las diapositivas
    foreach ($slide_list as $slide) : 
        
        // Id de cada slide
        $id = $slide->slide_id;
        

        // Si la slide tiene fondo/imagen
        if (!not_value($slide->slide_image))
            $bg_image = base_url($slide->slide_image);
        else 
            $bg_image = base_url('static/images/default_slide.png');

?>
        <li style="background-image: url(<?= $bg_image ;?>);" 
            data-slide-order="<?= $slide->slide_order; ?>" 
            data-slide-id="<?= $slide->slide_id; ?>">
          
          
            <div style="margin-top: 60px;">

                <input type="file" name="<?= "g-{$id}_image"; ?>" />
                <input type="text" name="<?= "g-{$id}_title"; ?>" 
                       class="form-control" 
                       <?= default_value_input($slide->slide_title); ?> >

            </div>        
		</li>
		<? endforeach ?>
    
        <? //<input type="submit" name="g-submit" value="Enviar">  ?>
        
	</ul>
</form>


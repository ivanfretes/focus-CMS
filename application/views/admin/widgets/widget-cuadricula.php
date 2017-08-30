<form action="<?= base_url("gestion/cuadricula/edit/$widget_id"); ?>"
      enctype="multipart/form-data" method="post">

	<ul class="grid-sortable">
<?  

    // Cuadricula - Listado de cuadros
    foreach ($cuadricula_list as $item):

    	// Id de cada item de la cuadricula
    	$id = $item->cuadricula_id;


        // Si la cuadricula tiene fondo/imagen
        if (!not_value($item->cuadricula_image))
            $bg_image = base_url($item->cuadricula_image);
        else
        	$bg_image = base_url('static/images/default_cuadricula.png');
    
    	// Estructura del item de la cuadricula    
?>
        <li style="background-image: url(<?= $bg_image ;?>); " 
            data-cuadricula-order="<?= $item->cuadricula_order; ?>" 
            data-cuadricula-id="<?= "widget-cuadricula-{$id}" ;?>">   

            <div style="margin-top: 60px;">

                <input type="file" name="<?= "g-{$id}_image"; ?>" />
                <input <?= default_value_input($item->cuadricula_title); ?> type="text" name="<?= "g-{$id}_title"; ?>" class="form-control">

            </div>        
    	
        </li>

<?   endforeach   ?>

	</ul>
</form>
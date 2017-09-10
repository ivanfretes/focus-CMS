<?
    /**
     * @var {array} $cuadricula_list Listado de cuadriculas
     */

    $cuadricula_list = $widget;
?>

<form action="<?= base_url("focus/cuadricula/edit/$widget_id"); ?>"
      enctype="multipart/form-data" method="post"
      id="widget-form-<?= $widget_id; ?>">

	<ul class="grid-sortable">
<?  

  
    // Cuadricula - Listado de cuadros
    foreach ($cuadricula_list as $c):

         if (!is_object($c))
            break;

    	// Id de cada c de la cuadricula
    	$id = $c->cuadricula_id;


        // Imagen generada para la cuadricula
        if (!not_value($c->cuadricula_image))
            $c_image = base_url($c->cuadricula_image);
        else
        	$c_image = base_url('static/images/default_cuadricula.png');
    
    	// Estructura del c de la cuadricula    
?>
        <li style="background-image: url(<?= $c_image ;?>); " 
            data-cuadricula-order="<?= $c->cuadricula_order; ?>" 
            data-cuadricula-id="<?= "widget-cuadricula-{$id}" ;?>">   

            <div style="margin-top: 60px;">
                <? //Imagen y titulo de la cuadricula ?>
                <input type="file" name="<?= "g-{$id}_image"; ?>" />
                <input <?= default_value_input($c->cuadricula_title); ?> type="text" name="<?= "g-{$id}_title"; ?>" class="form-control">

            </div>        
    	
        </li>

<?   endforeach   ?>

	</ul>
</form>
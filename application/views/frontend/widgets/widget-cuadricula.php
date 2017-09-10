<?
    // Listado de Cuadricula
    $cuadricula_list = $widget;

?>

<a name="<?= $widget_slug ;?>"></a>
<section class="wrapper style1 align-center">

    <div class="gallery lightbox onscroll-fade-in style1 medium">
<?  
    
    // c representa a una cuadricula del lidatado
    foreach ($cuadricula_list as $c)  : 

        if (!is_object($c))
            break;


        // Imagen generada para la cuadricula
        if (!not_value($c->cuadricula_image))
            $c_image = base_url($c->cuadricula_image);
        else 
            $c_image = 'static/images/default_cuadricula.png';


        echo "<article><a href=\"#\" class=\"image\">";
        echo "<img src=\"$c_image\" alt=\"\" >";
        echo "</a>";


        // Si no agregagamos titulo o descripcion, no produce un caption
        if (!not_value($c->cuadricula_title))
            "<div class=\"caption\"><h3>{$c->cuadricula_title}</h3></div>";
        
        echo "</article>";

    endforeach 


?>
    </div>

</section>

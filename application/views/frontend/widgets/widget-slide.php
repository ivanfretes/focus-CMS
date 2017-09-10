<?

    // Listado de item del widget, siempre y cuando sean objetos
    $slide_list = $widget;

?>

<a name="<?= $widget_slug ;?>"></a>
<div id="container" class="cf">

    <div id="main" role="main">
        <section class="slider">
            <div id="slider_<?= $widget_id ;?>" class="flexslider">
                <ul class="slides" >

<?  

    // Listado de elementos del slide
    foreach ($slide_list as $slide) : 

        if (!is_object($slide))
            break;

        if (NULL !== $slide->slide_image)
            $slide_img = base_url($slide->slide_image);
        else 
            $slide_img = base_url('static/images/default_slide.png');

?>
                    <li>
                        <img src="<?= $slide_img; ?>" class="slide-image" />
                        <p class="flex-caption">
                            <?= $slide->slide_title ;?>
                        </p>
                    </li>    
<?  endforeach  ?>

                </ul>
            </div>

            <!-- Listado de miniaturas -->
            <div id="carousel_<?= $widget_id ;?>" class="flexslider">
                <ul class="slides">
                <? foreach ($slide_list as $slide) : ?>
                    <li>
                        <img src="<? // str_replace('.png', '_thumbnail', $slide_img).'.png' ?>" />
                    </li>    
                <? endforeach ?>
                </ul>
            </div>
        </section>

    </div>

</div>

<!-- jQuery FlexSlider Feature -->
<script type="text/javascript">
    $(window).load(function(){

        // Id del slide
        var slide_id = <?= $widget_id; ?>;

        $('#carousel_'+slide_id).flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: parseInt( $(window).width() / 3),
            itemMargin: 0,
            asNavFor: '#slider_'+slide_id
        });

        $('#slider_'+slide_id).flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: '#carousel_'+slide_id,
            start : function(slider){
                $('body').removeClass('loading');
            }
        });
    });
</script>





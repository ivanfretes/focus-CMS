<?
    $slide_tag_id = $slide_list[0]->widget;  
?>
    <div id="container" class="cf">

        <div id="main" role="main">
            <section class="slider">
                <!-- List slide element -->
                <div id="slider_<?= $slide_tag_id ;?>" class="flexslider">
                    <ul class="slides">
                    <?  foreach ($slide_list as $slide) : 

                        if (NULL !== $slide->slide_image)
                            $slide_img = 
                            base_url().'uploads/images/'.$slide->slide_image;
                        else 
                            $slide_img = 
                            base_url().'static/images/default_slide.png';

                    ?>
                        <li>
                            <img src="<?= $slide_img; ?>" />
                            <p class="flex-caption">
                                <?= $slide->slide_title ;?>
                            </p>
                        </li>    
                    <?  endforeach ?>
                    </ul>
                </div>

                <!-- List carousel -->
                <div id="carousel_<?= $slide_tag_id ;?>" class="flexslider">
                    <ul class="slides">
                    <? foreach ($slide_list as $slide) : ?>
                        <li>
                            <img src="<?= str_replace('.png', '_thumbnail', $slide_img).'.png' ?>" />
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
            var slide_tag_id = <?= $slide_tag_id; ?>;

            $('#carousel_'+slide_tag_id).flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: parseInt($(window).width() / 3),
                itemMargin: 0,
                asNavFor: '#slider_'+slide_tag_id
            });

            $('#slider_'+slide_tag_id).flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: '#carousel_'+slide_tag_id,
                start: function(slider){
                    $('body').removeClass('loading');
                }
            });
        });
    </script>





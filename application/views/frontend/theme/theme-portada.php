    
<section class="banner onload-image-fade-in 
                onload-content-fade-right 
                style5 fullscreen 
                content-align-center image-position-center">
    
    <div class="content">
        
    <?

        // Si el titulo esta inicializado
        if (!not_value($page_title)){
           // echo "<h1 class=\"title-page \">$page_title</h1>";
        } 
            
        // Si el subtitulo esta inicializado
        if (!not_value($page_subtitle)) 
            echo "<h3 class=\"first-line\">$page_subtitle</h3>";

        if (!not_value($page_description)) 
            echo "<h3 class=\"second-line\">$page_description</h3>";

    ?>        

    </div>
    <div class="image">
    <?  

        // si la portada esta inicializa
        if (!not_value($page_portada_url))
            echo "<img src=\"" . base_url($page_portada_url) . "\""; 
        else 
            echo "<img src=\"".base_url('static/images/default_cover.png')."\" ";
        echo " alt=\"$page_title\" >";

    ?>
    </div>
    
</section>
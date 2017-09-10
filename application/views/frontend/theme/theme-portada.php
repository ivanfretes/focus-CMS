    
<section class="banner onload-image-fade-in 
                onload-content-fade-right 
                style5 fullscreen 
                content-align-center image-position-center">
    
    <div class="content">
        
    <?

        // Si el titulo esta inicializado
        if (!not_value($page_title)){
            echo "<h1 class=\"title-page \">$page_title</h1>";
        } 
            
        // Si el subtitulo esta inicializado
        if (!not_value($page_subtitle)) 
            echo "<p class=\"major\">$page_subtitle</p>";

    ?>        

    </div>
    <div class="image">
    <?  

        // si la portada esta inicializa
        if (!not_value($page_portada_url))
            echo "<img src=\"".$page_portada_url."\""; 
        else 
            echo "<img src=\"".base_url('static/images/default_cover.png')."\" ";
        echo " alt=\"$page_title\" >";

    ?>
    </div>
    
</section>
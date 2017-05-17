    
    <section class="banner onload-image-fade-in 
                    onload-content-fade-right 
                    invert style5 fullscreen 
                    content-align-center image-position-center">
        
        <div class="content">
            <h1 class="title-page"><?= $page->page_title; ?></h1>
            
             <?  if (NULL !== $page->page_subtitle) : ?>        
                <p class="major">
                    <?= $page->page_subtitle; ?>
                </p>
             <?  endif ?>

        </div>
        <?  
        /**
         *  Ubicar la imagen si esta disponible 
         */
        if (NULL !== $page->page_portada_url) : ?>

            <div class="image">
                <img src="<?= 
                    base_url().'uploads/images/'.$page->page_portada_url; ?>" 
                     alt="<?= $page->page_title; ?>">
            </div>
        
        <?  endif ?>       
        
    </section>
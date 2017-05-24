
<section class="wrapper style1 align-center">
<!-- <div class="inner">
    <h2>Gallery</h2>
    <p>This is a <strong>Gallery</strong> element. It can behave as a lightbox (when given the <code>lightbox</code> class), and you can customize its <span class="demo-controls">appearance with a number of modifiers</span>, as well as assign it an optional <code>onload</code> or <code>onscroll</code> transition modifier (<a href="#reference-gallery">details</a>).</p>
</div> -->



<!-- Gallery -->
    <div class="gallery lightbox onscroll-fade-in style1 medium">
    <?  foreach ($portfolio_list as $index => $portfolio)  : 
            ?>

        <article>
            <a href="<?= base_url().'uploads/'.$portfolio->portfolio_image;?>" class="image">
            
            <?  if ('' !== $portfolio->portfolio_image)
                    $portfolio_image = 'uploads/'.$portfolio->portfolio_image;
                else 
                    $portfolio_image = 'static/images/default_portfolio.png';
            ?>
                <img src="<?= base_url().$portfolio_image; ?>" alt="" />
            </a>

            <?
                if (NULL !== $portfolio->portfolio_title &&
                    '' !== $portfolio->portfolio_title) : ?>
                     <div class="caption">
                        <h3><?= $portfolio->portfolio_title ;?></h3>
                    </div>
            <?    endif

            ?>
           
        </article>
    <?  endforeach ?>
    </div>

</section>
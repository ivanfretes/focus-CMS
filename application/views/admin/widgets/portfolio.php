<li class="ui-sortable-component" 
    data-type-widget="portfolio" 
    data-order="<?= $widget_order ;?>" 
    data-widget="<?= $widget_id ;?>" 
    data-structure="grid" >    
    
    <h3>Portfolio</h3>
    
    <!-- Remove the component -->
    <div style="float:right;">        
        <a  class="btn btn-danger" 
            data-type="remove"
            href='<?= base_url().'gestion/widgets/remove/' ;?>' 
            data-widget="<?= $widget_id ;?>">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </a>
    </div>

    <!-- Portfolio content -->

    <form action="<?= base_url().'gestion/widgets/edit/portfolio'?>"
          enctype="multipart/form-data"
          data-component="<?= $widget_id; ?>"
          id="portfolio_form_<?= $widget_id; ?>">

    	<ul class="grid_sortable">
        
        <!-- Listed item the portfolio -->
    		<?  foreach ($portfolio_list as $index => $portfolio) : 
                    $bg_url = '';

                    // Verified if background initialized
                    if ('' !== $portfolio->portfolio_image)
                        $bg_url = base_url().'uploads/images/'.$portfolio->portfolio_image;
            ?>
            <li style="background-image: url(<?= $bg_url ;?>); " 
                data-grid-order="<?= $portfolio->portfolio_order; ?>" 
                data-grid="<?= $portfolio->portfolio_id; ?>">
              
                <!-- Portfolio Structure -->
                <div style="margin-top: 60px;">

                    <input type="file" name="<?= 
                    'portfolio_img_'.$portfolio->portfolio_id ?>" />

                    <input type="text" name="portfolio_title_<?=
                            $portfolio->portfolio_id ?>"
                            value="<?= $portfolio->portfolio_title ;?>"
                            class="form-control">

                </div>        
    		
            </li>
    		<?    endforeach   ?>
            
    	</ul>
    </form>

    

    <script type="text/javascript">
      
      // Ready jQuery with portfolio
      // $(function() {
              
      //   $( ".grid_sortable" ).sortable({
      //     start: function( event, ui ) {
      //         console.log($(ui.placeholder));
      //     }
      //   });
      //   $( ".grid_sortable" ).disableSelection();
         
      // });


    </script>

    <? // Custom input file ?>
    <script type="text/javascript" src="<?= base_url().'static/js/jquery.custom-file-input.js'; ?>"></script>

</li>
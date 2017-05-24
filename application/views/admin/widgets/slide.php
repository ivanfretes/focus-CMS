<?
  /**
   * View the slide component
   */


?>
<li class="ui-sortable-component" 
    data-type-widget="slide" 
    data-order="<?= $widget_order ;?>" 
    data-widget="<?= $widget_id ;?>" 
    data-structure="grid" >       
    
    <h3>Slide </h3>
    
    <!-- Remove the component -->
    <div style="float:right;">        
        <a  class="btn btn-danger" 
            data-type="remove"
            href='<?= base_url().'gestion/widgets/remove/' ;?>' 
            data-widget="<?= $widget_id ;?>">
            <span class="glyphicon glyphicon-trash" 
                  aria-hidden="true"></span>
        </a>
    </div>

    <!-- slide content -->
    <div>
        <form action="<?= base_url().'gestion/widgets/edit/slide';?>"
              enctype="multipart/form-data"
              data-component="<?= $widget_id; ?>"
              id="slide_form_<?= $widget_id; ?>">
        	
            <ul class="grid_sortable">
            
            <!-- Listing the slide -->
        		<? foreach ($slide_list as $index => $slide) : 
                    $bg_url = '';
                    // Verified if background initialized
                    if ('' !== $slide->slide_image)
                        $bg_url = base_url().'uploads/images/'.$slide->slide_image;
                ?>
                <li style="background-image: url(<?= $bg_url ;?>); " 
                    data-grid-order="<?= $slide->slide_order; ?>" 
                    data-grid="<?= $slide->slide_id; ?>">
                  
                  <!-- slide Structure -->
                  <div style="margin-top: 60px;">
                      <input type="file" name="<?= 
                          'slide_img_'.$slide->slide_id ?>" />
                      <input type="text" name="slide_title_<?=
                                       $slide->slide_id ?>"
                              value="<?= $slide->slide_title ;?>"
                              class="form-control">
                  </div>        
        			</li>
        		<? endforeach ?>
                
        	</ul>
        </form>

    </div>

    <script type="text/javascript">
      
      // Ready jQuery with slide
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
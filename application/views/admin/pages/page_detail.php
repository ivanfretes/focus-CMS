


<div class="x_content">

    <!-- <div class="summernote"><b>Hello Summernote</b></div> -->
  
    <!-- Page Edit and detail -->
    <form action="<?= $page_url ;?>update/<?= $page_detail->id_page; ?>" 
          id="p_form" 
          class="form-horizontal form-label-left"
          enctype="multipart/form-data">
            
        <!-- Error al insertar la página -->
        <div id="p_errors"></div>
        
     
        <button type="submit" 
                class="btn btn-lg btn-primary btn-top-right" >
            Módificar Página</button>
        <div class="clearfix"></div>
        
        
        <div class="form-group">
            <!-- Page Title -->    
            <label  class="control-label col-md-1" 
                  for="p_title">
                  Título: 
            </label>
            <div class="col-md-11">
              <input type="text" placeholder="Título" 
                     class="form-control col-md-7 col-xs-12
                     input-lg" 
                     name="p_title" id="p_title" 
                     value="<?= $page_detail->page_title;?>">
            </div>
        </div>

        <div class="form-group">
          <!-- Page Url  -->
          <div class="p_url">
            <label  class="control-label col-md-1"  
                    for="p_url">
                    URL:
            </label>
            <div class="col-md-5">
              <input type="text" 
                     class="form-control col-md-7 col-xs-12" 
                     disabled="disabled"
                     value="<?= $page_detail->page_url; ?>">
            </div>
          </div>

          <!-- Page Subtitle -->
          <label  class="control-label col-md-1" 
                for="p_subtitle">
                Subtítulo: 
          </label>
          <div class="col-md-5">
            <input type="text" placeholder="Título" 
                 class="form-control col-md-7 col-xs-12" 
                 name="p_subtitle" id="p_subtitle" 
                 value="<?= $page_detail->page_subtitle; ?>">
          </div>
        </div>

        <!-- Portada -->
        <div class="form-group">
            <label for="page_portada"
                   class="control-label col-md-1">
                   Portada: </label>
            <div class="col-md-5">
              <input type="file" name="page_portada" 
                   id="page_portada" class="form-control">
            </div>
        </div>    

        <!-- Page descrption -->
        <div class="form-group">

            <label for="p_description"
                   class="control-label col-md-1">
                   Detalle: </label>
        
            <div class="col-md-11">

              <div name="p_description"
                 data-action="edit">
                <?= $page_detail->page_description; ?>aaaa
              </div>
            </div>
        </div>         
    </form>            
    
    <hr>
  

    <!-- Form for create a component -->
    <form class="form_component">
        <div class="form-group">
            <label for="select_component"
                   class="control-label col-md-1">
                   Componente: </label>
    
            <div class="col-md-3">
              <select name="select_component" id="select_component"
                      class="form-control">

                <?  foreach ($components_name as $c_name => $c_value): 
                        echo "<option value='$c_name'>$c_value</option>";
                    endforeach ?>
              </select>
            </div>
        </div>
    </form>
    
    <!-- List of the component/widget -->
    <ul id="component_created">
    <?  
        foreach ($array_component as $widget) : 
          echo $widget;
        endforeach 
    ?>
    </ul>

    <script type="text/javascript">
        var page_id = <?= $page_detail->id_page ;?>;
        var order_component;
        <? if (isset($order_component))
            echo "order_component = $order_component" ;    
        else
            echo "order_component = 0" ;?>                  
    </script>

   

<?

/**
 * Detalla de la página y 
 * listado de widgets creados por página
 */
?> 


<div class="x_content">

    <!-- <div class="summernote"><b>Hello Summernote</b></div> -->
  
    <!-- Page Edit and detail -->
    <form action="<?= $page_url ;?>update/" 
          id="p_form" 
          class="form-horizontal form-label-left"
          enctype="multipart/form-data"
          data-component='<?= $page_detail->id_page ; ?>'
          method="post">
            
        <!-- Error al insertar la página -->
        <div id="p_errors"></div>
        
     
        <input type="submit" 
                class="btn btn-lg btn-primary btn-top-right" value="Módificar Página" name="btn_send">
        <div class="clearfix"></div>
        

        <!-- Formulario de edicion de la pagina -->

        <div class="row">
            
            <!-- Page title -->
            <div class="col-md-12">  

                <label for="p_title">
                      Título: 
                </label>
                <input type="text" placeholder="Título" 
                         class="form-control input-lg" 
                         name="p_title" id="p_title" 
                         value="<?= $page_detail->page_title;?>">
                

                <!-- Page Url  -->
                <div class="box-url">
                    <a href="<?= base_url().$page_detail->page_url ;?>"
                        target="parent">
                    <span style="text-transform: uppercase;"> 
                        URL: </span>

                    <?= base_url().$page_detail->page_url ; ?> 
                    
                    <span style="float: right;padding-right: 10px;">
                        [ Ver Página ]
                    </span>
                    </a>
                </div>
            </div>

            <!-- Page Subtitle -->
            <div class="col-md-12">  

                <label for="p_subtitle">
                    Subtítulo: 
                </label>
                <input type="text" placeholder="Subtitulo" 
                    class="form-control input-lg" 
                    name="p_subtitle" id="p_subtitle" 
                    value="<?= $page_detail->page_subtitle; ?>">

            </div>

            
            <!-- Descripcion/Contenido de la pagina -->
            <div class="col-md-12 ">

                <label for="p_description"
                        class="control-label" >
                    Detalle: </label>
                <div id="p_description" data-action='editable' 
                     class="box-editable">
                    <?
                        if (NULL === $page_detail->page_description || 
                            '' === $page_detail->page_description)
                            echo 'Escriba para editar el contenido' ; 
                        else 
                            echo $page_detail->page_description; 
                    ?> 
                </div>

            </div>

            
            <!-- Imagen de portada -->
            <div class="col-md-8">
                
                <div class="col-md-8">
                    <label for="page_portada"
                       class="control-label">
                       Imagén de Portada : </label>

                    <input type="file" name="page_portada" 
                       id="page_portada" class="form-control input-lg">
                </div>

                <div class="col-md-4">
                    <?
                        //
                        if (NULL === $page_detail->page_portada_url)
                            $img_portada = base_url().'static/images/default_cover.png';
                        else {
                            $img_portada = base_url().'uploads/images/'.$page_detail->page_portada_url; 
                        }

                    ?>

                    <img src="<?= $img_portada; ?>" 
                        class="img-responsive img-portada">
                </div>
            </div>
            
            <!-- Checkbox de Pagina Principal -->
            <div class="col-md-4 text-center">
                <?  // Verifica si esta tildado o no
                    $checked = '';
                    if ($page_detail->page_main) 
                        $checked = 'checked disabled'; 
                ?>

                <label for="page_portada"
                       class="control-label">
                        Página Principal : </label>

                <input type="checkbox" name="p_main" 
                        class="form-control"
                        value="1" <?= $checked ?>>

            </div>
          
        </div>

    </form>            
    
    <hr>
  
    
    <div class="row">
        <div class="col-md-3">
            <!-- Form for create a component -->
            <form class="form_component">
                
                <label for="select_component"
                   class="control-label">
                   Componente: </label>

                <select name="select_component" id="select_component"
                      class="form-control input-lg">

                    <?  foreach ($components_name as $c_name => $c_value): 
                            echo "<option value='$c_name'>$c_value</option>";
                        endforeach ?>
                </select>
               
            </form>
        </div>
    </div>
    
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
        <? 
            if (isset($order_component))
                echo "order_component = $order_component" ;    
            else
                echo "order_component = 0" 
        ;?>                  
    </script>

   

<!-- Modal -->
<div class="modal fade" id="page_add_modal" 
     tabindex="-1" role="dialog" >
    
  <div class="modal-dialog modal-lg" role="document">
    <form action="<?= $page_url;?>add" 
           id="p_form" class="form-horizontal form-label-left">

        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Nueva Página</h4>
        </div>


        <!-- Modal Content -->
        <div class="modal-body">
    
            <!-- Error al insertar la página -->
            <div id="p_errors"></div>


            <!-- Form content -->
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
                         name="p_title" id="p_title" >
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
                         name="p_url" id="p_url" >
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
                     name="p_subtitle" id="p_subtitle" >
              </div>
            </div>

            <div class="form-group">
                <!-- Image Portada -->
                <label for="page_portada"
                       class="control-label col-md-1">
                       Portada: </label>
                <div class="col-md-5">
                  <input type="file" name="page_portada" 
                       id="page_portada" class="form-control">
                </div>
            </div>    

            
            <div class="form-group">
                <!-- Description -->    
                <label for="p_description"
                       class="control-label col-md-1">
                       Detalle: </label>
            
                <div class="col-md-11">
                  <textarea name="p_description" 
                        id="p_description"  class="form-control"></textarea>
                </div>
            </div>
            

            <div class="modal-footer">
                <button type="submit" 
                        class="btn btn-primary" >Crear Página</button>
            </div>
             
        </div>
        

     
    </div>
  </div>
</div>
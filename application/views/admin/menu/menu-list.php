
<!-- Barra fija -->
<div class="theme-container-head">
    <div class="row">
        <div class="col-md-3">
            <h3>Listado de Menú </h3> 
        </div>
        <div class="col-md-9">
            <form action="<?= base_url('focus/menu/new') ?>"
                  class="form-horizontal form-label-left"
                  method="post" id="menu-form">
                
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" id="g-name"
                               name="g-name" class="form-control input-lg"
                               placeholder="Título de Menú">
                    </div>
                    
                    <div class="col-md-5">
                        <input type="text" id="g-link"
                            name="g-link" class="form-control input-lg"
                            placeholder="Link">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-success btn-lg" type="submit">
                            Guardar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<ul id="menu-created">
<?  
        
    // Listado de Menus Generados
    foreach ($list_menu as $menu_data) {

        $this->load->view('admin/menu/menu-item', $menu_data);

    }

?>
</ul>

   
       
                
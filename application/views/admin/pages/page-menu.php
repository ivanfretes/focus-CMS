
<!-- Barra fija -->
<div class="theme-container-head">
    <div class="row">
        <div class="col-md-3">
            <h3>Listado de Menú </h3> 
        </div>
        <div class="col-md-9">
            <form action="<?= base_url('gestion/menu/new') ?>"
                  class="form-horizontal form-label-left"
                  method="post" id="menu_form">
                
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="g-name"
                               name="g-name" class="form-control input-lg"
                               placeholder="Título de Menú">
                    </div>
                    
                    <div class="col-md-4">
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




<ul id="menu_created">
<?  foreach ($list_menu as $menu) : 
        $menu_id = $menu->id_menu;
?>
    <li id="ui-sortable-component"
        data-menu="<?= $menu->id_menu?>"><div class="div-container-menu">
        <?= $menu->menu_name; ?>
        

        <!-- Panel de edicion -->
        <div style="float: right;">
            <input type="text" disabled 
                    value="<?= $menu->menu_link; ?>" 
                    class="form-control" >

                <a href="<?= base_url("gestion/menu/remove/$menu_id") ;?>"
                   data-action="remove" class='remove_menu'>
                    
                    <span class="glyphicon glyphicon-trash"></span>    
                </a>

        </div></div>
    </li>
<?  endforeach ?>
</ul>

       
                
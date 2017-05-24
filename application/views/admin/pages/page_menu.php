
    <div class="x_content">
        
        <div class="clearfix"></div>
        
        <div class="content_theme">
            <form action="<?= base_url().'gestion/menu/add'?>"
                  class="form-horizontal form-label-left"
                  method="post"
                  id="menu_form">
                <div class="form-group">
                    <label for="menu_name" class="col-md-1">
                        Nombre :
                    </label>
                    <div class="col-md-3">
                        <input type="text" id="menu_name"
                                name="menu_name" class="form-control">
                    </div>

                    <label for="menu_name" class="col-md-1">
                        Link : 
                    </label>
                    <div class="col-md-4">
                        <input type="text" id="menu_link"
                                name="menu_link" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-success" type="submit">
                            Crear Menu</button>
                    </div>
                </div>
            </form>

            <div class="list_menu_item">
                <ul id="menu_created">
                <?  foreach ($list_menu as $menu) : ?>
                    <li id="ui-sortable-component"
                        data-menu="<?= $menu->id_menu?>">
                        <?= $menu->menu_name; ?>
                        

                        <!-- Panel de edicion -->
                        <div style="float: right;">
                            <input type="text" disabled 
                                    value="<?= $menu->menu_link; ?>" 
                                    class="form-control" >
      
                                <a href="<?= base_url().'gestion/menu/remove/' ;?>"  data-value="<?= $menu->id_menu ;?>" 
                                          data-action="remove" 
                                          class='r_menu'> x </a>

                        </div>
                    </li>
                <?  endforeach ?>
                </ul>
            </div>
        </div>
        
    </div>

                
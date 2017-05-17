
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
                <ul>
                <?  foreach ($list_menu as $menu) : ?>
                    <li>
                        <?= $menu->menu_name; ?>
                    </li>
                <?  endforeach ?>
                </ul>
            </div>
        </div>
        
    </div>

                
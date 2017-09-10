 
 <li id="ui-sortable-component"
    data-order="<?= $menu_id; ?>">

    <div class="div-container-menu">
    <?= $menu_name; ?>
    

        <!-- Panel de edicion -->
        <div style="float: right;">
            <input type="text" disabled 
                   value="<?= $menu_link; ?>" 
                   class="form-control" >

            <a href="<?= base_url("focus/menu/remove/$menu_id") ;?>"
               data-action="remove" class='remove_menu'>
                
                <span class="glyphicon glyphicon-trash"></span>    
            </a>

        </div>

    </div>
    
</li>

<!-- Barra fija -->
<div class="theme-container-head">
    <div class="row">
        <div class="col-md-9">
            <h3>Listado de Páginas (<spam id="total_row" 
            data-value="<?= $total_row ;?>"><?= $total_row ;?></spam>)</h3>
        </div>

        <div class="col-md-2">
            <a href="<?= base_url('focus/pages/new'); ?>"
               class="btn btn-lg btn-success"
               data-action="create">
                Nueva Página
            </a>
        </div>
    </div>
</div>


<table class="table table-striped" id="page-table-list">
    <thead>
        <tr>
        <th class="col-md-1 text-center">Ver Pág.</th>
        <th class="col-md-4">Título</th>
        
        <th class="col-md-2 text-center">Widgets</th>
        <th class="col-md-2 text-center">
            Fecha de Modificación   
        </th>
        <th class="col-md-2 text-center" >Edición</th>
        </tr>
    </thead>

    <tbody>


<?  foreach ($page_list as $index => $page) : ?>
    <tr>
        <?  
            $main_print = '';

            //Agrega un icono de estrella a la página principal
            if (1 == $page->page_main){
                $main_print = '<span style="color:#cc2b5f;padding:5px;">
                <i class="fa fa-star" ></i></span>';
            }
    
        ?>
    
        <? // Vista Previa de Páginas  ?>
        <td class="text-center "><? //$row_init + $index + 1 ;?>
            
            <a href="<?= base_url($page->page_url);?>" 
               target="_blank">
                <span class="glyphicon glyphicon-eye-open"></span> 
            </a>
        </td>

        
        <? // Titulo de Página ?>
        <td class="page-tab-title">
            <h3><?= $page->page_title.'  '.$main_print ;?></h3>
        </td>
        

        <? // Link a creacion / Listado de widgets ?>
        <td class="text-center">
            <a href="<?= base_url("focus/pages/$page->page_id/widgets");?>"
               id="p_remove">                
                <span class="glyphicon glyphicon-plus-sign"></span> 
                Agregar
            </a>
        </td>
        
        <? //Fecha de Modificacion ?>
        <td class="text-center">
            <?= $page->page_date_modified ;?>
        </td>
        

        <? // Edicion de la pagina ?>
        <td class="text-center">

            <a href='<?= base_url('focus/pages/edit/'.$page->page_id);?>'> 
               <span class="glyphicon glyphicon-edit"></span> Editar 
            </a> |
            
            <a href="<?= base_url('focus/pages/remove/'.$page->page_id);?>"
               data-action="remove">
                <span class="glyphicon glyphicon-trash" ></span> Eliminar
            </a>

        </td>
    </tr>
<? endforeach ?>
    </tbody>
</table>

<!-- pagination -->
<div class="pagination">
    <?= $pagination; ?>
</div>

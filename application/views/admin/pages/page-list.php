<?
/**
 * Listado de Páginas
 */

//var_dump($page_list);
//exit();
?>
  
<table class="table table-striped" id="page_list">
    <thead>
        <tr>
        <th class="col-md-1">#</th>
        <th class="col-md-4">Título</th>
        <th class="col-md-2">Vista Previa</th>
        <th class="col-md-2 text-center">
            Fecha de Módificación
        </th>
        <th class="col-md-2 text-center" >Edición</th>
        </tr>
    </thead>

    <tbody>


<? foreach ($page_list as $index => $page) : ?>
    <tr>
        <?  
            $main_print = '';

            //Agrega un icono de estrella a la página principal
            if (1 == $page->page_main){
                $main_print = '<span style="color:#cc2b5f;padding:5px;"><i class="fa fa-star" aria-hidden="true"></i></span>';
            }
    
        ?>

        <td><?= $row_init + $index + 1 ;?></td>
        
        <td>
            <?= $page->page_title.'  '.$main_print ;?>
        </td>
        
        <td>
            <a href="<?= base_url($page->page_url);?>" 
               target="_blank">
                Ver página      
            </a>
        </td>
        
        <td class="text-center">
            <?= $page->page_date_modified ;?>
        </td>

        <td class="text-center">
            <a class="btn btn-success" 
               href='<?= base_url('gestion/pages/edit/'.$page->id_page);?>'> 
              <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            </a>
            <a class="btn btn-danger" id="p_remove"
               data-page="<?= $page->id_page ;?>"
               href="<?= base_url('gestion/pages/remove/'.$page->id_page); ?>"> 
                <span class="glyphicon glyphicon-trash" 
                      aria-hidden="true"></span>
            </a>
        </td>
    </tr>
<? endforeach ?>
    </tbody>
</table>

<!-- pagination -->
<div class="pagination">
    Test
    <? $this->pagination->create_links(); ?>
</div>

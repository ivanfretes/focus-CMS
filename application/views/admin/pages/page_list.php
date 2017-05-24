
    <div class="x_content">
        <button type="button" class="btn btn-primary btn-lg btn-top-right" 
        data-toggle="modal" data-target="#page_add_modal" 
        id='p_btn_modal'> 
            Nueva Página
        </button>

        <div class="clearfix"></div>
        
        
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
        <? foreach ($list_pages as $index => $page) : ?>
            <tr>
                <td><?= $page_init + $index ;?></td>
                
                <td>
                    <?= $page->page_title ;?>
                </td>
                
                <td>
                    <a  href="<?= base_url().$page->page_url ;?>" 
                        target="_blank">
                        Ver página      
                    </a>
                </td>
                
                <td class="text-center">
                    <?= $page->page_date_modified ;?>
                </td>

                <td class="text-center">
                    <a  class="btn btn-success" 
                      href='<?= $page_url.'edit/'.$page->id_page ;?>'> 
                      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
                    <a  class="btn btn-danger" id="p_remove"
                      data-page="<?= $page->id_page ;?>"
                      href="<?= $page_url.'remove'; ?>"> 
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
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>

    

    <? $this->load->view('admin/pages/page_modal'); ?>  
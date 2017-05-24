
    <div class="x_content">

        <div class="clearfix"></div>
        
        <div class="content_theme">
            <table class="table table-striped" id="page_list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-md-4">Nombre y Apellido</th>
                        <th class="col-md-2">Datos de Contacto</th>
                        <th class="col-md-4">Datos del Evento</th>
                        <th class="col-md-2 text-right">
                            Fecha de recepción
                        </th>
                </thead>
                <tbody>
            <? foreach ($list_contact as $index => $item) : ?>
                <tr>
                    <td><h4><?= $item_init + $index ;?></h4></td>
                    
                    <!-- Datos personales -->
                    <td>
                        <h4><?= $item->contact_firstname ;?>
                        <?= $item->contact_lastname ;?> </h4>
                    </td>

                    <!-- Datos de ubicacion -->
                    <td>   
                        <div>
                            <b>Télefono:</b> <?= $item->contact_phone ;?><br>
                            <b>Mail:</b> <?= $item->contact_mail ;?>
                        </div>
                    </td>
                    

                    <!-- Datos referente al motivo de contacto -->
                    <td>
                        <div>
                            <b>Tipo de Evento:</b> 
                                <?= $item->contact_reference ;?><br>
                            <b>Fecha del evento:</b> 
                                <?= $item->contact_date_reference ;?><br>
                            <b>Lugar del Evento:</b> 
                                <?= $item->contact_direction;?>
                        </div>
                    </td>

                     <!-- Datos de ubicacion -->
                    <td class="text-right">   
                    <? 
                        $current_time = $item->contact_date_created;

                        if (FALSE !== strpos($current_time,date('Y-m-d'))) 
                            echo substr($current_time, 10);
                        else 
                            echo $current_time;
                        
                    ;?>
                    </td>

                </tr>
            <? endforeach ?>
                </tbody>
            </table>
        </div>
        
        <!-- pagination -->
        <div class="pagination">
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>

    

    <? $this->load->view('admin/pages/page_modal'); ?>  
<?
/**
 * Verificar el sistema horario y/o actualizar
 */

?>

<!-- Barra fija -->
<div class="theme-container-head">
    <div class="row">
        <div class="col-md-9">
            <h3>Listado de Contactos (<spam id="total_row" 
            data-value="<?= $total_row ;?>"><?= $total_row ;?></spam>)</h3>
        </div>

    </div>
</div>


<table class="table table-striped" id="contact-table-list">
    <thead>
        <tr>
            <th>#</th>
            <th class="col-md-4">Nombre y Apellido</th>
            <th class="col-md-2">Datos de Contacto</th>
            <th class="col-md-3">Referencia</th>
            <th class="col-md-2 text-center">
                Recibido
            </th>
            <th class="col-md-1 text-center">
                Edición
            </th>
    </thead>
    <tbody>
<? 
    foreach ($contact_list as $index => $contact_data) : 
?>
    <tr>
        <td><h4><?= $row_init + $index + 1 ;?></h4></td>
        
        <!-- Datos personales -->
        <td>
            <h4><?= $contact_data->contact_firstname ;?>
            <?= $contact_data->contact_lastname ;?> </h4>
        </td>

        <!-- Datos de ubicacion -->
        <td>   
            <div>
                <b>Télefono:</b> <?= $contact_data->contact_phone ;?><br>
                <b>Mail:</b> <?= $contact_data->contact_mail ;?>
            </div>
        </td>
        

        <!-- Datos referente al motivo de contacto -->
        <td>
            <div>
                <b>Tipo de Evento:</b> 
                <?= $contact_data->contact_reference ;?><br>
                <b>Fecha del evento:</b> 
                <?  
                    $freferencia = $contact_data->contact_date_reference;
                    $freferencia = substr($freferencia, 0, 10);

                    echo $freferencia;
                ;?><br>
                <b>Lugar del Evento:</b> 
                <?= $contact_data->contact_direction;?>
            </div>
        </td>

         <!-- Datos de ubicacion -->
        <td class="text-center">   
        <? 
            $current_time = $contact_data->contact_date_created;
            $isDay = strpos($current_time, current_date());
            if (FALSE !== $isDay)  
                echo substr($current_time, 10);
            else 
                echo $current_time;
        ?>
        </td>

        <td>
            <a href="<?= 
                base_url(
                    'focus/contacts/remove/' . 
                    $contact_data->contact_id
                ); 
            ?>" data-action="remove"> 
                <span class="glyphicon glyphicon-trash"></span>
                Eliminar 
            </a>
        </td>

    </tr>
<?  endforeach ?>
    </tbody>
</table>

<div class="pagination">
    <?= $pagination ;?>
</div>

<?
   $this->load->view('admin/theme/theme-modal');
?>
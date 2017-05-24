<section class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <form action="<?= base_url() ;?>/contacto/send" method="post" 
            enctype="multipart/form-data" id="contact_form">

            <label>Nombre: </label>
            <input type="text" name="contact_firstname" />

            <label>Apellido: </label>
            <input type="text" name="contact_lastname" />

            <label>Télefono / Celular: </label>
            <input type="text" name="contact_phone" />

            <label>Correo Electrónico: </label>
            <input type="text" name="contact_mail" />

            <label>Tipo de Evento: </label>
            <input type="text" name="contact_reference" />

            <label>Fecha del Evento: </label>
            <input type="text" name="contact_date_reference" 
                    id="contact_date" />

            <label>Lugar del Evento: </label>
            <input type="text" name="contact_dir" />

            <input type="submit" class="button" 
                    name="contact_submit" value="Pongasé en contacto"> 
        </form>
    </div>
</section>
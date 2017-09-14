<section class="row" style="margin-top: 20px">
    <div class="col-lg-8 col-lg-offset-2">
        <form method="post" enctype="multipart/form-data" id="contact-form">

            <label>Nombre: </label>
            <input type="text" name="f-firstname" required="yes">

            <label>Apellido: </label>
            <input type="text" name="f-lastname" required="yes">

            <label>Télefono / Celular: </label>
            <input type="text" name="f-phone" required="yes">

            <label>Correo Electrónico: </label>
            <input type="email" name="f-mail" required="yes">

            <label>Tipo de Evento: </label>
            <input type="text" name="f-reference">

            <label>Fecha del Evento: </label>
            <input type="text" name="f-date_reference" id="f-date_reference">

            <label>Lugar del Evento: </label>
            <input type="text" name="f-direction">

            <input type="submit" class="button" name="f-submit" 
                   value="Pongasé en contacto"> 
        </form>
    </div>
</section>


<link rel="stylesheet" type="text/css" href="<?= base_url("static/vendors/jquery-ui/jquery-ui.min.css"); ?>">
<script type="text/javascript" src="<?= base_url("static/vendors/jquery-ui/jquery-ui.min.js"); ?>"></script>
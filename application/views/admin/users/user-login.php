<!DOCTYPE html>
<html lang="en">
<head>

<?
    $title = 'Inicio de Sesion - FOCUS CMS v1.0.2';
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $title; ?></title>

<!--CSS -->
<link href="<?= base_url(); ?>static/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?= base_url();?>static/css/b_login.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?= base_url();?>static/css/animate.css" media="all"/>

<!-- Fonts -->
<link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


 <!--Js -->
 <script src="<?= base_url('static/js/jquery.min.js'); ?>"></script>
 <script src="<?= base_url('static/js/b_login.js');?>"></script>
 <script src="<?= base_url('/static/vendors/bootstrap/js/bootstrap.min.js');?>"></script>

</head>
<body>

  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 login-card">

   <form id="login-form" class="col-lg-12" method="post" 
         action="<?= base_url('focus/login/auth');?>">

    <!-- Logo -->
    <div class="col-lg-12 logo-kapsul">
      <img width="150" style="background: #fff; border-radius: 5px; padding: 20px; margin-bottom: 40px;" class="logo" src="<?= 
            base_url('uploads/images/static/logo.png'); ?>" alt="Epuka" />
    </div>

    <div style="clear:both;"></div>

    <div class="msgAlert"></div>

    <!-- Username -->
    <div class="group">      
      <input type="text" required name="username">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label><i class="material-icons input-ikon">person_outline</i><span class="span-input">Usuario </span></label>
    </div>


    <!-- password -->
    <div class="group">      
      <input type="password" required name="password">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label><i class="material-icons input-sifre-ikon">lock</i><span class="span-input">Contraseña</span></label>
    </div>


    <!-- Enviar -->
    <input type="submit" value="Acceder" name="submitLogIn" class="giris-yap-buton">


    <!-- Pantalla Recuperar contraseña -->
    <div class="forgot-and-create tab-menu">
    <!--  <a class="sifre-hatirlat-link" href="javascript:void('sifre-hatirlat-link');">Olvido su contraseña</a> -->
     <!--a class="hesap-olustur-link" href="javascript:void('hesap-olustur-link');">Registrarse.</a-->
   </div>
   
   
 </form>
 
 <!-- Pantalla para recuperar email -->
 <form id="sifre-hatirlat-form" class="col-lg-12">

  <div class="col-lg-12 logo-kapsul">
    <img width="150" style="background: #fff; border-radius: 5px; padding: 20px; margin-bottom: 40px;" class="logo" src="<?= base_url('uploads/images/static/logo.png'); ?>" alt="Epuka" />
  </div>

  <div style="clear:both;"></div>

  <!-- Campo de correo y/o usuario -->
  <div class="group">      
    <input type="text" required>
    <span class="highlight"></span>
    <span class="bar"></span>
    <label><i class="material-icons input-ikon">mail_outline</i><span class="span-input">Usuario</span></label>
  </div>

  <a href="javascript:void(0);" class="sifre-hatirlat-buton">Solicitar Información</a>
  <a class="zaten-hesap-var-link" href="javascript:void('zaten-hesap-var-link');">Volver a la pantalla de Acceso</a>
</form>


</div>

<div class="col-lg-8" style="padding:100px;">
    <h1>Focus CMS</h1>

    <p>
        <b><span style="color:#c15887;">Focus CMS v1.0.2 
        es un generador ágil de páginas webs</span></b>
    </p>
    <a href="#" >Potenciado por CUANTICA Soft</a>
</div>

</body>
</html>

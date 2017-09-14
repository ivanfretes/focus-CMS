<?
    $app_name = 'focus';
    $app_version = '1.0.3';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $app_name . ' '. $app_version;  ?></title>

    <!-- Bootstrap & Font -->
    <link href="<?= base_url('static/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet');?>">
    <link href="<?= base_url('static/css/font-awesome.min.css" rel="stylesheet');?>">
    
    <!-- Styles -->
    <link href="<?= base_url('static/css/b_theme.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('static/css/b_style.css');?>" rel="stylesheet" >


    <!-- Summernote -->
    <link href="<?= base_url('static/vendors/summernote/summernote.css');?>" rel="stylesheet">
    
    
    <script src="<?= base_url('static/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('static/js/jquery-ui.min.js'); ?>"></script>
    <script src="<?= base_url('static/vendors/bootstrap/js/bootstrap.min.js');?>"></script>

 <? /*   
    <!-- nprogress -->
    

<!--     <link href="<?= base_url('static/vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">
    <script src="<?= base_url('static/vendors/nprogress/nprogress.js'); ?>"></script>   --> */ ?>

    <!-- pnotify -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('static/vendors/pnotify/dist/pnotify.css'); ?>">
    <script src="<?= base_url('static/vendors/pnotify/dist/pnotify.js'); ?>"></script>  


    <script type="text/javascript">
        const BASE_URL =  '<?= base_url(); ?>';
        const FOCUS_URL = BASE_URL+'focus/';
        const MAX_FILE_SIZE = 6815744; <? // 6.5 MB ?>
    </script>
  </head>
    
<body class="nav-md">
    <div class="container body">
      <div class="main_container">

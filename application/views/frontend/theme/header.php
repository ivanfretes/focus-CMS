<?
    // cargamos datos por defecto

    load_infosite();
?>
<!DOCTYPE html>
<html>
<head>


	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Tag epuka">
    <meta name="description" content="Web de Epuka">
    <meta name="author" content="<?=
            $this->session->userdata('data_infosite')['page_info_name']; ?>">

	<!-- css -->
	<link rel="stylesheet" href="<?= base_url(); ?>static/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>static/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>static/css/animate.css">
    <link rel="stylesheet" href="<?= base_url(); ?>static/vendors/FlexSlider/flexslider.css">
    
    <link rel="stylesheet" href="<?= base_url(); ?>static/css/f_theme.css">
    <link rel="stylesheet" href="<?= base_url(); ?>static/css/f_style.css">
    
    <!-- js -->
    <script type="text/javascript" src="<?= base_url(); ?>static/js/_jquery.min.js"></script>
    <script defer src="<?= base_url(); ?>/static/vendors/FlexSlider/jquery.flexslider.js"></script>


    <title><?=  $page_title.' - '. 
                $this->session->userdata('data_infosite')['page_info_name']; ?></title>
         
</head>
<body>


<? $this->load->view('frontend/theme/theme-header'); ?>
<div id="wrapper">

<? $this->load->view('frontend/theme/theme-topnav'); ?>

<? $this->load->view('frontend/theme/theme-portada'); ?>


<? 
	
	if (!not_value($main_content))
		$this->load->view($main_content);
		
?>


<? $this->load->view('frontend/theme/theme-footer'); ?>
</div>


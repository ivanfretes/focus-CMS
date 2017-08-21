
<? $this->load->view('frontend/theme/theme-header'); ?>
<div id="wrapper">

<? $this->load->view('frontend/theme/theme-topnav'); ?>

<? $this->load->view('frontend/theme/theme-portada'); ?>


<? 

	/**
	 * 
	 */

	if (isset($list_components)){
		foreach ($list_components as $component) 
			echo $component;
			
	}
	else if (isset($main_content)) 
		$this->load->view($main_content);
		
?>


<? $this->load->view('frontend/theme/theme-footer'); ?>
</div>


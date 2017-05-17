<? $this->load->view('frontend/theme/header'); ?>
<? $this->load->view('frontend/theme/nav'); ?>
<? $this->load->view('frontend/theme/page_cover'); ?>

<? 
	foreach ($list_components as $component) {
		echo $component;
	}
?>
<? $this->load->view('frontend/theme/footer'); ?>



<!-- row -->
<? $row_orient = ($row->row_orientation === 'left') 
	 				? 'orient-left' : 'orient-right';  ?>


<section class="spotlight style1 <?= $row_orient; ?> content-align-left image-position-center onscroll-image-fade-in" >
	<div class="content">
		<h2><?= $row->row_title; ?></h2>
		
		<? if ('' !== $row->row_subtitle): ?>
			<h5><?= $row->row_subtitle; ?></h5>
		<? endif ?>

		<? echo $row->row_content; 

			if ('' !== $row->row_btn_title): ?>

			<ul class="actions vertical">
				<li><a href="<?= $row->row_btn_link; ?>" class="button">
					<?= $row->row_btn_title; ?>
				</a></li>
			</ul>	
		<? 	endif ?>
	</div>
	<div class="image">
		<img src="<?= base_url(); ?>static/images/default_column.png" alt="" />
	</div>
</section>

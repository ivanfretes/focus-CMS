
<? 

	if (NULL !== $row) :

		/**
		 * Determinamos la orientacion(Alineacion) del contenido
		 */

		$view_img = TRUE;


		if ('left' === $row->row_orientation){
			$style_row = 'spotlight onscroll-image-fade-in style1 orient-left ';
		}
		else if('right' === $row->row_orientation) {
			$style_row = 'spotlight onscroll-image-fade-in style1 orient-right ';	
		}
		else { // center
			$style_row = 'spotlight onscroll-image-fade-in style5 ';
			$view_img = FALSE;
		}

		
		/**
		 * Verificamo que el video este inicializado, 
		 * no este vacio y que el contenido no se encuentra 
		 * distribuido en el centro
		 */

		if ('' === $row->row_video && $view_img){
			$style_row .= ' purple-epuka'; 
		}


?>


<section class="<?= $style_row ; ?>">
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
		<?
			/**
			 * Verificamo el estado de la imagen
			 */
			if(NULL !== $row->row_image){
				$image = base_url().'uploads/images/'.$row->row_image;
				$image = "<img src='$image'>";
			}
			else{
				if($view_img){
					$image = base_url().'static/images/default_column.png'; 
					$image = "<img src='$image'>";
				}
				else {
					$image = '';
				}

			}

			// print the image is not null
			echo $image ;
		?>
	</div>
</section>

<?	endif ?>
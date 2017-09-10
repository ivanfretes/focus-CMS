<? 
	/**
	 * El array de datos consta de un $widget['type'] = row
	 */

	// Cast del elemento	
	$row = $widget;
	
	/**
	 * Por defecto, es TRUE en caso que la fila solo
	 * tenga una columna su valor es FALSE
	 */
	$variuos_column = TRUE;
	$video_init = FALSE;


	// Verificamos la alinacion y asignamos el CSS correspondiente
	if ('left' === $row->row_orientation){
		$style_row = 'spotlight onscroll-image-fade-in style1 orient-left ';
	}
	else if('right' === $row->row_orientation) {
		$style_row = 'spotlight onscroll-image-fade-in style1 orient-right ';
	}
	else {
		// En caso que sea CENTER
		$style_row = 'spotlight onscroll-image-fade-in style5 ';
		$variuos_column = FALSE;
	}

	
	// Si no existe video y varias columnas esta activado
	if ((not_value($row->row_video_url)) && $variuos_column){
		$style_row .= ' purple-epuka'; 
	}
	else {
		$video_init = TRUE;
	}

?>

<? // -- Slug del widget --  ?>
<a name="<?= $widget_slug ;?>"></a>

<section class="<?= $style_row ; ?>">
	<div class="content">
		<h2><?= $row->row_title; ?></h2>
		
	<? 	if ('' !== $row->row_subtitle) { ?>
		
		<h5><?= $row->row_subtitle; ?></h5>
			
	<? 	
		} 		
		echo $row->row_content; 

		// Verificamos si el boton esta inicializado
		if (!not_value($row->row_btn_title)):  ?>

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
			 * Si esta inicializada la imagen, la mostramos,
			 * caso contrario
			 * 
			 * Si un componente de una columna no asignamos la imagen
			 */
			if(NULL !== $row->row_image){
				$image = base_url($row->row_image);
				$image = "<img src='$image'>";
			}
			else{
				if($variuos_column){
					$image = base_url('static/images/default_column.png'); 
					$image = "<img src='$image'>";
				}
				else {
					$image = '';
				}
			}


			/**
			 * 
			 * -- Modificar/Mejorar --
			 * Si el video esta inicializado, damos prioridad
			 */
			if ($video_init){
				$image = '<iframe  src="'.$row->row_video_url.'" frameborder="0" allowfullscreen></iframe>';
			}

			// print the image is not null
			echo $image ;
		?>
	</div>
</section>


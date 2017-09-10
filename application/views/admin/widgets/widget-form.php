
<?
	/**
	 * Contenedor de widget
	 * 
	 * @var {number} $id Hace referencia a $widget['id']
	 * @var {string} $type hace rerferencia a $widget['type']
	 * @var {string} $slug hace referencia a $widget['slug']
	 * @var {array} Datos generado del subwidget
	 */
?>

<li>
	
	<div class="widget-item">
		<a href="<?= base_url('focus/widgets/remove/'.$widget_id);?>"
		   data-action="remove">
			Eliminar 
		</a>
		
		<h5>

			<?	
				// URL Completa del slug
				$url_slug = base_url("$page_url#$widget_slug"); 
			?>	
			
			<a href="<?= $url_slug; ?>" class="link-slug" target="parent">
				<?= $url_slug ;?>
			</a>
			
		</h5>

		<? 
			$data['widget_type'] = $widget_type;
			$data['widget_id'] = $widget_id;
			$data['widget_slug'] = $widget_slug;			
			$data['widget'] = $widget;
			$this->load->view("admin/widgets/widget-$widget_type", $data);
		?>

		</form>

	</div>
</li>
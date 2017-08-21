<?
	/**
	 * Contenedor de cualquier widget/componente
	 */



?>

<li class="ui-sortable-component" 
		data-type-widget="single_row"_<?= $row_id; ?> 
		data-order="<?= $order_component ;?>" 
		data-widget-id="<?= $widget_id ;?>">   


		<h3>Servicio / Elemento Horizontal</h3>

		<!-- Elimina un widget -->
		<div style="float:right;">        
				<a  class="btn btn-danger" 
						data-type="remove"
						href='<?= base_url().'gestion/widgets/remove/' ;?>' 
						data-widget="<?= $widget_id ;?>">
						<span class="glyphicon glyphicon-trash" 
									aria-hidden="true"></span>
				</a>
		</div>

	


<?
	if (isset($file_view)){
		$this->load->view('admin/widget/'.$file_view);	
	}
	else 
		echo "El nombre de la vista del widget no esta inicializado";
?>
		
</li>
<!-- page content -->
<div class="right_col" role="main">
  <div >
    <div class="page-title">
      <div class="title_left">
        <h3>Fracciones</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>


    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Default Example <small>Users</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p class="text-muted font-13 m-b-30">
              DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
            </p>
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Ciudad</th>
                  <th>Provincia</th>
                  <th>Fecha Modificación</th>
                  <th>Superficié</th>
                  <th>Edición</th>
                </tr>
            </thead>
            <tbody>
<? foreach ($list_fracciones as $fraccion) : ?>
		<tr>
		
			<td><?=	$fraccion->nombre ; ?></td>
			<td><?=	$fraccion->ciudadnombre ; ?></td>
			<td><?=	$fraccion->provincianombre ; ?></td>
			<td><?=	$fraccion->fechamodificacion ; ?></td>
			<td><?=	$fraccion->superficie_m2 ; ?></td>
			<td>Btn</td>
		</tr>
                	
<?	endforeach ?> 


              </tbody>
            </table>
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>

<!-- Datatables -->
<script src="<?echo base_url();?>/static/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?echo base_url();?>/static/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?echo base_url();?>/static/vendors/pdfmake/build/vfs_fonts.js"></script>

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#datatable').DataTable();
	})
</script>
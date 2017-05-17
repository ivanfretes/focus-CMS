<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>



    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

      <li><a href="index.php"><img src="img/logo.png" class="logo"></a></li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Archivo<span class="caret"></span></a>

          <ul class="dropdown-menu">
            <li id="addManzana"><a href="#">Generar Estructura</a></li>
            <li id="saveFile"><a href="#">Guardar</a></li>
            <li><a href="#">Exportar</a></li>
          </ul>
      </li>

      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edición<span class="caret"></span></a>

          <ul class="dropdown-menu">
              <li><a href="#">Activar Edición</a></li>
              <li><a href="#">Desactivar Edición</a></li>
              <li id="deleteLine"><a href="#">Eliminar Limite</a></li>
              <li id="copyline"><a href="#">Copiar Limite</a></li>

          </ul>
      </li>

      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Multiformas<span class="caret"></span></a>

          <ul class="dropdown-menu">
              <li><a href="#" id="generar_lotes">Nueva Multiforma</a></li>
              <li><a href="#">Eliminar Multiforma</a></li>
          </ul>
      </li>

      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Lotes<span class="caret"></span></a>

          <ul class="dropdown-menu">
              <li><a href="#" id="generar_manzanas">Generar Lotes</a></li>
              <li><a href="#">Eliminar Todos Lotes</a></li>
          </ul>
      </li>

      <li id="save"><a href="#">Guardar</a></li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Superficie<span class="caret"></span></a>
          <ul class="dropdown-menu" id="filtrarPorTerreno">
              <li data-terreno="0"><a href="#">Mapa Normal de Calles</a></li>
              <li data-terreno="1"><a href="#">Mapa  Satelital</a></li>
              <li data-terreno="2"><a href="#">Mapa Satelital y Calles</a></li>
              <li data-terreno="3"><a href="#">Mapa Físico</a></li>
          </ul>

        </li>
      </ul>

      <!--form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form-->

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="login.php">{{Usuario}}</a></li>
            <li><a href="login.php">{{Rol}}</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="login.php">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

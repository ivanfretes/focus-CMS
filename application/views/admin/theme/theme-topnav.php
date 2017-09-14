<!-- Loading Icon -->
<div class="loading-data"></div>


<!-- TOP NAVBAR -->
    <div class="top_nav">
        <div class="nav_menu">
    <nav>
<!--         <div class="nav search-toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a> 

            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-left 
                    top_search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
                </span>
            </div>
            </div>

        </div>
 -->    
   
        <!-- Informacion del perfil -->
        <ul class="nav navbar-nav navbar-right">
            <li class="">
                <a  href="javascript:;" class="user-profile dropdown-toggle"
                    data-toggle="dropdown" aria-expanded="false">
                    <?= $this->session->userdata('username'); ?>
                    <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li>
                        <a href="<?= base_url('focus/logout'); ?>">
                            <i class="fa fa-sign-out pull-right"></i>Salir
                        </a>
                    </li>
                </ul>
            </li>

            <!-- 
                /** btn Notification  dropdown **/ 
                <li role="presentation" class="dropdown">
                <a  href="javascript:;" class="dropdown-toggle info-number" 
                    data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" 
                    role="menu">
                    <li>
                        <a>
                            <span class="image">
                                <img src="images/img.jpg" alt="Profile Image" />
                            </span>
                            <span>
                                <span>John Smith</span>
                                <span class="time">3 mins ago</span>
                            </span>
                            <span class="message">
                                Film festivals used to be do-or-die moments for movie makers. They were where...
                            </span>
                        </a>
                    </li>
                    <li>
                        <div class="text-center">
                            <a>
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li> -->
        </ul>
    </nav>
    </div>
    </div>
    <!-- End Top Navigation -->


    <!--  Cabecera de Pagina --> 
    <!-- Contenido de página -->
    <div class="right_col" role="main">
        
        <!-- Titulo del Page -->
        <div class="page-title">

            <div class="title_left">
                <h3>
                    <? 
                        if (isset($g_category)) echo $g_category;
                    ?>
                      
                    <?
                        if (isset($g_subcategory)) echo $g_subcategory;

                    ;?>
                </h3>
            </div>

            <div class="title_right">
                
            </div>
        </div>

        <div class="clearfix"></div>

        <!--Row content -->
        <div class="row">
            <!-- Listado de Paginas -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">



<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url(); ?>" class="site_title  ">
                FOCUS CMS <span class="title_betha">ßetha</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- Logo de la empresa  -->
        <div class="profile">
            <div class="profile_info_business">
                <img src="<?= base_url('uploads/images/static/logo.png');?>"
                    width="100px" class="image-logo">
            </div>
        </div>


        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section"> 
            <!-- Side title section-->
            
            <ul class="nav side-menu">
                
                <li>
                    <a href="<?= base_url('focus/pages'); ?>">
                        <i class="fa fa-file"></i> 
                        Páginas <span class="fa fa-chevron-right"></span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('focus/contacts'); ?>">
                        <i class="fa fa-envelope-o"></i> 
                        Contactos <span class="fa fa-chevron-right"></span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('focus/menu'); ?>">
                        <i class="fa fa-list"></i> 
                        Menú<span class="fa fa-chevron-right"></span>
                    </a>
                </li>


                
            </ul>
        </div>

    </div>
    <!-- /sidebar menu -->

    <!-- menu footer buttons -->
    <div class="sidebar-footer hidden-small">
    <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a> -->
    <a href="<?= base_url(); ?>" target="parent" class="view-home-page" title="Ir a Página">
    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
    </a>
    </div>
    <!-- menu footer buttons -->
</div>
</div>


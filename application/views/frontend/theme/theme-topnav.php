<nav class="navbar navbar-default navbar-custom navbar-absolute-top"> 
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="<?= base_url(); ?>">
                <img src="<?= base_url(); ?>/uploads/images/logo.png" alt="Epuka!" class="logo">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?  foreach ($menu_list as $menu) : ?>
                    <li>
                        <a href="<?= $menu->menu_link; ?>">
                            <?= $menu->menu_name; ?>
                        </a>
                    </li>
                <? endforeach ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
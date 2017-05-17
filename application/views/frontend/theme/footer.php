<!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 
                            col-md-10 col-md-offset-1
                            text-center">    
                    <h1 class="footer-title">EPUKA!</h1>
                    <ul class="list-inline text-center">
                        
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        

                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>


                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        
                    </ul>
                    <p class="copyright text-muted">
                            <small style="font-size: 15px">
                                EPUKA! &copy <?=  date('Y'); ?> «» 
                                Desarrollado por CUANTICA* Soft</small>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <style type="text/css">
        /* -- Custom  Miscelaneas--*/

        .title-page:before {
            content: '<?= $page->page_title; ?>';
        }
    </style>

    <!-- Js -->
    <script src="<?= base_url(); ?>static/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script defer src="<?= base_url(); ?>static/js/f_app.js"></script>
    
    <script src="<?= base_url(); ?>static/js/jquery.scrollex.min.js"></script>
    <script src="<?= base_url(); ?>static/js/jquery.scrolly.min.js"></script>
    <script src="<?= base_url(); ?>static/js/skel.min.js"></script>
    <!-- <script src="<?= base_url(); ?>static/js/util.js"></script>
    <script src="<?= base_url(); ?>static/js/main.js"></script> -->
</body>
</html>
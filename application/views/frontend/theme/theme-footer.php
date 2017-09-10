<!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row text-center cta_contact_footer">

                <!-- Contact Footer -->
                <div class="col-lg-3 col-lg-offset-1">
                    <a href="tel:+595981456396">
                        <img src="<?= base_url().'static/images/icons/phone.svg'?>" style="width: 100px">
                        <h3>LLAMÁNOS</h3>
                        <h4>0981 456 396</h4>
                    </a>
                </div>

                <div class="col-lg-3 col-lg-offset-4">
                    <a href="tel:+595981456396">
                        <a href="mailto:info@epuka.com?Subject=Desde%20la%20web">

                            <img src="<?= base_url().'static/images/icons/mensaje.svg'?>" style="width: 90px; margin-bottom: 10px;">
                            <h3>ENVIÁNOS UN MENSAJE</h3>
                            <h4>info@epuka.com</h4>
                        </a>
                    </a>
                </div>
                
            </div>
            

            <!-- Social Network footer -->
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 
                            col-md-10 col-md-offset-1
                            text-center">    
                        
                    <img src="<?= base_url('uploads/images/static/logo-footer.png') ;?>" alt="EPUKA!" width="70%" >
                    <br><br>
    
                    <ul class="list-inline text-center">
                        
                        <li>
                            <a href="https://www.facebook.com/epuka/" 
                                target="parent">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        

                        <li>
                            <a href="https://www.instagram.com/cabinaepuka/"
                                target="parent">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>


                        <li>
                            <a href="https://twitter.com/cabinaepuka"
                                target="parent">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        
                    </ul>
                    <p class="copyright text-muted">
                            <small style="font-size: 15px">
                                EPUKA! &copy <?=  date('Y'); ?> <!-- «» 
                                Desarrollado por CUANTICA* Soft --></small>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <style type="text/css">
        /* -- Custom  Miscelaneas --*/
        
        <?  if (!not_value($page->page_title)){?>

            .title-page:before {
                content: '<?= $page->page_title; ?>';
            }

        <?  }   ?>
    </style>

    <!-- Js -->
    <script src="<?= base_url(); ?>static/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script defer src="<?= base_url(); ?>static/js/f_app.js"></script>
    
    <script src="<?= base_url(); ?>static/js/jquery.scrollex.min.js"></script>
    <script src="<?= base_url(); ?>static/js/jquery.scrolly.min.js"></script>
    <script src="<?= base_url(); ?>static/js/skel.min.js"></script>

</body>
</html>
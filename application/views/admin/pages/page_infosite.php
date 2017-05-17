
    

    <form action="<?= base_url().'gestion/infosite/edit' ;?>"
                  method="post" >
    <div class="x_content">
        

        <!-- Guardar Infosite -->
        <button type="submit" class="btn btn-success btn-lg btn-top-right"> 
            <i class="fa fa-edit m-right-xs"></i> Guardar Información
        </button>
        
        <div class="clearfix"></div>

        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
                <div id="crop-avatar">
                <!-- Current avatar -->
                <?
                    if (NULL !== $infosite->page_info_logo)
                        $logo = $infosite->page_info_logo;
                    else $logo = 'static/images/logo-default.png';

                ?>

                    <img class="img-responsive avatar-view" 
                          src="<?= base_url().$logo; ?>" 
                          alt="Logo de <?= $infosite->page_info_name; ?>" title="Change the avatar">
                </div>
            </div>
            <h3><?= $infosite->page_info_name; ?></h3>
            <?

                var_dump($infosite);

            ?>

            <!-- Informacion de ubicación -->
            <ul class="list-unstyled user_data">
                <li>
                    <? if (NULL !== $infosite->page_info_dir){ ?>
                        <i class="fa fa-map-marker user-profile-icon"></i>
                        <?= $infosite->page_info_dir; ?>    
                    <? } ?>
                </li>
                <li>
                    <? if (NULL !== $infosite->page_info_dir){ ?>
                        <i class="fa fa-briefcase user-profile-icon"></i>
                        <?= $infosite->page_info_segment; ?>
                    <? } ?>
                </li>

               <!--  <li class="m-top-xs">
                    <i class="fa fa-external-link user-profile-icon"></i>
                    <a href="http://www.kimlabs.com/profile/" target="_blank">
                        www.kimlabs.com</a>
                </li> -->
            </ul>

        </div>


        <div class="col-md-9 col-sm-9 col-xs-12">

        <!-- Datos de formulario segun el tipo -->
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active">
                    <a  href="#tab_content1" id="home-tab" role="tab"   
                        data-toggle="tab" aria-expanded="true">Corporativo</a>
                </li>
                <li role="presentation" class="">
                    <a  href="#tab_content2" role="tab" id="profile-tab" 
                        data-toggle="tab" aria-expanded="false">Ubicación</a>
                </li>
                <li role="presentation" class="">
                    <a  href="#tab_content3" role="tab" id="profile-tab2"
                        data-toggle="tab" aria-expanded="false">Contacto</a>
                </li>
                <li role="presentation" class="">
                    <a  href="#tab_content4" role="tab" id="profile-tab2"
                        data-toggle="tab" aria-expanded="false">Redes Sociales</a>
                </li>
            </ul>


            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" 
                     id="tab_content1" aria-labelledby="home-tab">
                    
                    <h3>Descripción de mi Negocio (Ej. Historia)</h3>
                    <div data-action='edit'>
                        <?= $infosite->page_info_description; ?>
                    </div>

                    <h3>Misión</h3>
                    <div data-action='edit'>
                        <?= $infosite->page_info_mision; ?>
                    </div>
                    <hr>

                    <h3>Visión</h3>
                    <div data-action='edit'>
                        <?= $infosite->page_info_vision; ?>
                    </div>
                    <hr>

                    <h3>Objetivos</h3>
                    <div data-action='edit'>
                        <?= $infosite->page_info_objectives; ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" 
                     id="tab_content2" aria-labelledby="profile-tab">
                    <h3>Objetivos</h3>
                    <div data-action='edit'>
                        <?= $infosite->page_info_dir; ?>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" 
                     id="tab_content3" aria-labelledby="profile-tab">

                </div>

                <div role="tabpanel" class="tab-pane fade" 
                     id="tab_content4" aria-labelledby="profile-tab">

                </div>
            </div>
          </div>
        </div>
    </div>


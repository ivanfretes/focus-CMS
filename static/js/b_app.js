/**
* @author : Ivan Fretes
* @link : www.cuanti.ca
*/


const MSG_EMPTY_FIELD = 'Por favor complete los campos requeridos'; 
const MSG_INCORRECT_FIELD = 'Por favor conplete los campos correctamente';


$(function(){

    /** 
    * -- Data Default --
    */
    
    
    // Remove page
    removeItem( 'click', 'data-page', 'a.btn-danger', '#page_list tr');
    
    // Remove a page component
    removeItem( 'click', 'data-widget', 'a[data-type=remove]' , 
                'ul#component_created', 'ul#component_created li');
    
    // Set the grid data
    // Actualizamos el componente del tipo imagen
    // elemento paterno li[data-structure=grid]
    send_form_grid('change', 'li[data-structure=grid] input[type=file]');
    send_form_grid('keyup', 'li[data-structure=grid] input[type=text]');
    
    
    // Set the row
    // Actualizamos el componente del tipo fila
    // li[data-type-widget=single_row] podria se elemento paterno si no ajusta a 
    // las actuales necesidades
    send_row('keyup', 'li[data-type-widget=single_row] input[type=text]'); //
    send_row('change', 'li[data-type-widget=single_row] select'); 
    send_row('change', 'li[data-type-widget=single_row] input[type=file]');
    
    
    
    // Set the menu data, Actualizamos los datos del menu
    send_row('change', ' input[type=file]');
    
    /**
    * -- Pages -- 
    */
    
    // Seleccionamos el componente a ser creado para generar sus caracteristicas
    
    $('input[name=p_title]').keyup(function(){
         $('input[name=p_url]').val(createUrl($(this).val()));
        
    });
    
    $('input[name=p_url]').keyup(function(){
        $(this).val(createUrl($(this).val()));
    });
    
    // Crea una nueva página 
    $('#p_form, #menu_form').submit(function(e){
        
        var f = $(this);
        e.preventDefault();
        
        var formData = new FormData(document.getElementById(f[0].id));
        
        //formData.append('p_send', 1);
        formData.append('p_url', $('#p_url').val());
        
        // Send the data
        $.ajax({
            url: f[0].action,
            type: "post",   
            dataType: "text",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            var data = JSON.parse(data);
            
            if (0 !== data.error){
                $('#p_errors').html(`
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        `+data.msg+`
                    </div>`);
            }
            else {
                location.reload();
            }
            
        });
    });
    
    // Set not value the errors html
    $('#p_btn_modal').click(function(){
        $('#p_errors').html('');
    });
    
    
    
    // Actualzizamos las propiedades de cualquier textarea
    // Habilitamos el Summernote.js
    $('body').delegate('div', 'click', function(){
        var self = $(this);
        if ('edit' === $(this).attr('data-action')){
            $(this).summernote({
                height: 300, 
                minHeight: null,
                maxHeight: null, 
                focus: true,
                lang: 'es-ES',
                placeholder: 'Modifique el contenido',
                callbacks: {
                    onInit: function() {
                        console.log('Summernote is launched');
                    },
                    onChange: function(content){
                        
                        var form =  self.parents('form'); //form padre
                        
                        var formData = new FormData(document.getElementById(form.attr('id')));  //datos del formulatio, 
        
                        // Add the blob over the form data object, 
                        // El componente representa el id del tipo actual de widget creado, por ejemplo 
                        // el id de un item de portfolio
                        formData.append('component_id', form.attr('data-row'));
                        
                        // Agregamos el valor del contenido generador por el summernote
                        var componente_label = self.attr('id');
                        formData.append(componente_label, content); 
         
                        $.ajax({
                            url: form.attr('action'),
                            type: 'post',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false
                        })
                        .done(function(data){
                            console.log(data);
                        });
                        
                    },
                    onBlur: function(c) {
                        console.log(c);
                        //self.summernote('destroy');
                    }
                }
            });
            


        }
    });
    
    
     // Modificamos la ubicacion del listado de componentes
//    jQuery("#component_created").sortable({ 
//        placeholder: "ui-state-highlight", 
//        stop: function( event, ui ) {
//            set_order_component();
//        }  
//    })
//        .disableSelection();
                
    
    
    // Actualizamos el orden de los componentes / widgets
    $('#component_order').click(function(e){
        e.preventDefault();
        set_order_component();
    });
   
    
    // Seleccionamos un nuevo componente para su creacion
    $('#select_component').change(function(){
        var type_component = $(this).val();
        
        if ('' !== type_component){
            if (confirm('Desea crear un nuevo componente')){
                order_component++;

                //return;
                $.post(GESTION_URL+'widgets/add/'+type_component, 
                {
                    page : page_id,
                    order : order_component 
                })
                .done(function(data,status) {
                    load_component(type_component,data,order_component);
                })
                .fail(function(data) {
                    //console.log(data);
                })
                .always(function() {
                   // alert(status);
                });    
            }
        }
    });
    
    /** 
    * -- File Upload Component--
    */
    
    

    // Edit/Update form data, 
    function send_form_grid(event, selector){
        $('#component_created').delegate(selector, event, function(e){ 
            var self = $(this);
            
            // El componente con el cual vamos a trabajar, uno de los
            // items del grid
            var component_li = $(this).parents('.grid_sortable li');
            
            if (-1 !== selector.indexOf('input[type=file]')){
                // Creating a blob image tmp
                var getImagePath = URL.createObjectURL(e.target.files[0]);
                component_li.css('background-image', 'url(' + getImagePath + ')');
            }
            
            // Seleccionamos los datos del formulario
            var parentForm = $(this).parents('form');
            var formData = new FormData(document.getElementById(parentForm.attr('id')));

            // Add the blob over the form data object, 
            // El componente representa el id del tipo actual de widget creado, por ejemplo 
            // el id de un item de portfolio
            formData.append('component_id', component_li.attr('data-grid'));
            
            
            $.ajax({
                  url: parentForm.attr('action'),
                  type: 'post',     
                  dataType: 'text',
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false
            });
//            .done(function(data){
//                console.log(data);
//            });
        });
    }
});



// Remueve, cualquier item que se pase como parameteo, 
// El dato a ser removido depende del link a
// attr data, es el dato que vamos a enviar
function removeItem(event, attr_data, selector, parent, element_remove){

    if (null === selector) 
        selector = 'a[data-type=remove]';
    
    if ('undefined' === typeof element_remove) 
        element_remove = parent;

    $(parent).delegate(selector, event, function(e){
        e.preventDefault();
        
        if (confirm('Desea eliminar el elemento')){
            var self = $(this);    
            
            $.post(self.attr('href'),
            {
                data_send : self.attr(attr_data)
            }, function(data){
                console.log(data);
                self.parents(element_remove).remove();
            });    
        }        
    });
}


// Crea la URL, establece a miniscular, remplaza espacios 
function createUrl(words){
    return words.replace(/\s/g,"-").toLowerCase(); 
}

    
// Cargamos un nuevo componente
function load_component(type_component,data_component, order){
    $('#component_created').append(data_component);
    location.assign('#button');
}


// Ordena todos los componentes
function set_order_component(){
    var order_component = [];
    
    $.each($("#component_created li.ui-sortable-component"), function(k, v) {
       order_component.push($(v).attr('data-widget'));
    });

    $.post(BASE_URL+'page_component/ordered', {
        page : page_id,
        order : order_component
    }, function(data){

        new PNotify({
            title: 'Ordenado!',
            text: 'Los componentes fueron ordenados correctamente',
            type: 'success'
        });
    })
}

// Ordena los componentes de un portfolio en partciular
// No activo
function set_order_portfolio(){
    var order_component = [];
    
    $.each($("#component_created li.ui-sortable-component"), function(k, v) {
       order_component.push($(v).attr('data-widget'));
    });

    $.post(BASE_URL+'page_component/ordered', {
        page : page_id,
        order : order_component
    });
}



// Envia datos del component tipo fila
function send_row(event, selector){
    
    $('#component_created').delegate(selector, event, function(e){ 
        
        var self = $(this);
        var form = self.parents('form'); // formulario padre
        var formData = new FormData(document.getElementById(form.attr('id')));  //datos del formulatio, indicamos cual
        
        // Add the blob over the form data object, 
        // El componente representa el id del tipo actual de widget creado, por ejemplo 
        // el id de un item de portfolio
        formData.append('component_id', form.attr('data-row'));

        $.ajax({
            url: form.attr('action'),
            type: "post",   
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(data){
            console.log(data);
        });

    });
    
}



    
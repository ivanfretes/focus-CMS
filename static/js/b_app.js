/**
* @author : Ivan Fretes
* @link : www.cuanti.ca
*/

//
//const MSG_EMPTY_FIELD = 'Por favor complete los campos requeridos'; 
//const MSG_INCORRECT_FIELD = 'Por favor conplete los campos correctamente';
//

$(function(){

    /** 
    * -- Data Default --
    */
    
    
    // Remove page
    removeItem( 'click', 'data-page', 'a.btn-danger', '#page_list tr');
    
    // Remove a page component
    removeItem( 'click', 'data-widget', 'a[data-type=remove]' , 
                'ul#component_created', 'ul#component_created li');
    
    
    // Remove a menu    
    remove_item('click', '#menu_created li a', 'li');
    
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
  
    //ssend_row('change', ' input[type=file]');
    
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
    
    
    /*
        -- Edit/adding and send data --
    */
    
    // Enviamos datos a traves del formulario
    send_data_with_form('#menu_form, #p_form');
    
    
    // Volvemos editable 'summernote' el box descripcion
    send_content_editable('div[data-action=editable]');
    
    
    
    
    // Set not value the errors html
    $('#p_btn_modal').click(function(){
        $('#p_errors').html('');
    });
    
	
	/*
		Modificar el drop de los elementos 
	*/
	// Bandera que determina si el contenido puede ser encapsulado en
	// un li sortable
//    var content_editable = 0;
//	$('body').delegate('div' , 'click', function(){
//		
//		var self = $(this);
//
//		if ('editable' === self.attr('data-action') || 
//		    -1 !== self.attr('class').indexOf('note')) 
//			content_editable = 1;
//		
//		if (0 === content_editable){
//			$("#component_created").sortable({ 
//				placeholder: "ui-state-highlight", 
//				activate : function( event, ui ){
//					console.log('Inicializamos el sort');
//				},
//				stop: function( event, ui ) {
//					set_order({
//						url : GESTION_URL+'widgets/ordered',
//						selected : '#component_created li',
//						selected_data : 'data-widget'
//					}, event);
//				}  
//			})
//				.disableSelection();		
//		}
//		
//		content_editable = 0;
//		
//	});
	
     // Modificamos la ubicacion del listado de componentes
    
                
    
     // Modificamos le orden de menu
    $("#menu_created").sortable({ 
        placeholder: "ui-state-highlight", 
        stop: function( event, ui ) {
            set_order({
                url : GESTION_URL+'menu/ordered',
                selected : '#menu_created li',
                selected_data : 'data-menu'
            });
        }  
    });
    
   
    
    // Seleccionamos un nuevo componente para su creacion
    $('#select_component').on('change',function(){
        var type_component = $(this).val();
        var self = $(this);
        NProgress.start();
        
        if ('' !== type_component){
            if (confirm('Desea crear un nuevo componente')){
                order_component++;
                
                // type_component a string for example 'single_row' or 'portfolio'
                $.post(GESTION_URL+'widgets/add/'+type_component, 
                {
                    page : page_id,
                    order : order_component 
                })
                .done(function(data,status) {
                    load_component(type_component,data,order_component);
                    NProgress.done();
					self.val('');
                });
            }
        }
    });
    

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
function remove_item(event, selected_data, parent_element_remove = null) {

    $('body').delegate(selected_data, event, function(e){
        e.preventDefault();        
        a = $(this);

        try { 
            if (-1 === a.attr('data-action').indexOf('remove')) throw "Problema con la acción del link"
            e.preventDefault();
            
            
            if (confirm('Desea eliminar el elemento')){
                $.post(a.attr('href'), {
                    param : a.attr('data-value')
                }, function(data){
                    if (parent_element_remove === null) a.remove();    
                    else {
                        a.parents(parent_element_remove).remove();
                    }

                }); 
            }
        }
        catch(err) {
            console.log(err);
        }
        
    });
}

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


/**
Ordena cualquier componente

@example obj_param = {
		url : destiny
		selected : li or div to each ,
		selected_data : field/attr data_[any] of the selector       
    }
*/

function set_order(obj_param = {}, e = null){
    var order_component = [];
	
    // Recorre todos los elementos 
    $.each($(obj_param.selected), function(k, v) {
       order_component.push($(v).attr(obj_param.selected_data));
    });

	// Anexamos el array con los id dispuestos
	obj_param.order = order_component;

    $.post(obj_param.url, obj_param, function(data){
        var data = JSON.parse(data);
        new PNotify({
            title: 'Ordenado!',
            text: data.msg,
            type: 'success'
        });
        
    })
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
        formData.append('component_id', form.attr('data-component'));

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
			$('input[type=file]').val(null);
        });

    });
    
}

/*
    Envia los datos contenidos en un formulario
*/
function send_data_with_form(selector, event = 'submit'){

    try {
        
        if (null === selector) 
                var err = 'Formulario no inicializado';
        
        $(selector).on(event, function(e){
            var f = $(this); // form selected
            e.preventDefault();
            
            var formData = new FormData(document.getElementById(f[0].id));
            
            
            // Se inicializa para editar cualquier componente
            if ('undefined' !== typeof f.attr('data-component')){
                formData.append('component_id',f.attr('data-component'));
            }
            
            
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
                       
    }
    catch(err){
        console.log(err);
    }
}

/*
    Vuelve al contenido Editable 'summernote.js', no es necesario 
    que sea un campo de un form, y lo envia 
*/

function send_content_editable(selector, event = 'click'){
    $('body').delegate(selector, event, function(){
        
        var self = $(this); 
        if ('editable' === $(this).attr('data-action')){

            // Summernote setting
            $(this).summernote({
                //height: 300, 
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

                        // El componente representa el id del tipo actual de widget creado, por ejemplo 
                        // el id de un item de portfolio
						
                        formData.append('component_id', form.attr('data-component'));
                        
                        // Extrae del id, el 'keyname' que enviar mediante el ajax
                        // por ejemplo 'page_name', y le asigna su contenido 'content'
						
						
                        var component_name = self.attr('id');
                        formData.append(component_name, content); 

                        
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
                    }
                }
            });
            


        }
    });
}


    
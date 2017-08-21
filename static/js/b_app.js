
// Inicializamos b_app.js
$(function(){

	
	// Eliminamos cualquier elemento
	remove_html_element('click');
	
	
    // Remove page
//    removeItem( 'click', 'data-page', 'a.btn-danger', '#page_list tr');
//    
    // Remove a page component
//    removeItem( 'click', 'data-widget', 'a[data-type=remove]' , 
//                'ul#component_created', 'ul#component_created li');
//    
    
    // Remove a menu    
    //remove_item('click', '#menu_created li a', 'li');
    
    // Set the grid data
    // Actualizamos el componente del tipo imagen
    // elemento paterno li[data-structure=grid]
    //send_form_grid('change', 'li[data-structure=grid] input[type=file]');
    //send_form_grid('keyup', 'li[data-structure=grid] input[type=text]');
    
    
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
         $('input[name=p_url]').val(createSlug($(this).val()));
        
    });
    
    $('input[name=p_url]').keyup(function(){
        $(this).val(createSlug($(this).val()));
    });
    
    
    /*
        -- Edit/adding and send data --
    */
    
    // Enviamos datos a traves del formulario
    send_data_with_form('#menu_form, #p_form');
    
    
    // Volvemos editable 'summernote' al componente seleccionado
    summernote_content('div[data-action=editable]');
    
    // Modificar
    $('#p_btn_modal').click(function(){
        $('#p_errors').html('');
    });
   
    
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
		var self = $(this);
		// Componente seleccionado 'portfolio'
        var component = self.val();
        
        //NProgress.start();
        
        if ('' !== component){
            if (confirm('Desea crear un nuevo componente')){
                order_component++;
                
                // type_component a string for example 'single_row' or 'portfolio'
                $.post(GESTION_URL+'widgets/add/'+component, 
                {
                    page : page_id,
                    order : order_component 
                })
                .done(function(data,status) {
                    load_component(component,data,order_component);
                    //NProgress.done();
					self.val('');
                });
            }
        }
    });
    
	// enviamos un formulario
	
	
	//
	
    // Edit/Update form data, 
    /*function send_form_grid(event, selector){
        $('#component_created').delegate(selector, event, function(e){ 
            var self = $(this);
             
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
    }*/
});


/*
	Remueve, eliminamos un elemento HTML
	El elemento a ser removido depende del link <a href=".."></a>
	que contiene la ruta, para eliminar el archivo
	
	@param {string} :
*/
function remove_html_element(event, elementRemove = null) {

    $('body').delegate('a[data-action=remove]', event, function(e){
        e.preventDefault();      
		
		// Accedemos a las propiedades del enlace <a>
        var a = $(this);

        if (confirm('Está por eliminar este elemente, ¿Desea Continuar?')){
                $.post(a.attr('href'), {
                    	param : a.attr('data-value')
                	},function(data){
						
						// Si se inserto, eliminamos el elemento html
						if (data){
							// Si no se asigno elementRemove, elimina el propio enlace
							if (elementRemove === null) 
								a.remove();    
							else 
								$(elementRemove).remove();
								return;
						}
						else {
							console.log('Elemento no fue eliminado');
						}
						
                });
		
			console.log('Eliminamos el elemento');
			
		}
    });
}



/*
	Crea el slug de la url GESTION_URL/slug, remplaza los espacios
	
	@param {string} words : Frase para la url
	@return {string} : slug modificado
*/	
function createSlug(words){
    return words.replace(/\s/g,"-").toLowerCase(); 
}

    
/*
	Creamos un nuevo componente
	
	@param {number} widget_id : Id del widget
	@param {}
	@param {number} 
*/

function load_component(type_component,data_component, order){
    $('#component_created').append(data_component);
    location.assign('#button');
}




/*
	Ordenamos los widgets
*/
@example obj_param = {
		url : destiny
		selected : li or div to each ,
		selected_data : field/attr data_[any] of the selector       
    }
*/

function set_order(obj_param = {}, e = null){
	
	// Listado de widgets
    var item_list = [];
	
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




/*
	Envia datos del component tipo fila
	
	@param {string} event : 
*/
function send_row(event, element){
    
    $('#component_created').delegate(element, event, function(e){ 
        
        var self = $(this);
        var form = self.parents('form'); // formulario padre
		
		//datos del formulatio, indicamos cual
        var formData = new FormData(document.getElementById(form.attr('id')));  
        
		set_thumbnail(e, '.row-image-container img');
		
		
		console.log('Limpiamos el componente fila');
		return;
		
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
        
        //if (null === selector) 
        //    var err = 'Formulario no inicializado';
        
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
    Utilizamos 'summernote.js' para agregar un toolbar 
	de edicion al contenido.
	(*) utiliza un delegate por si el div, fuese generado desde el servidor
	
	@param {string} element : Representa al elemento que es seleccionado
	@param {string} event : Evento realizo sobre el elemento(element)
	
	@return void 
*/

function summernote_content(element, event = 'click'){
    $('body').delegate(element, event, function(){
        var self = $(this); 
		
		// Verficamos que el data action sea editable
        if ('editable' === self.attr('data-action')){
			
			console.log(self.attr('data-action'));
			
            // Summernote setting
            $(this).summernote({
                //height: 300, 
                minHeight: null,
                maxHeight: null, 
                focus: true,
                lang: 'es-ES',
                placeholder: 'Editar Contenido [ aquí ]',
                callbacks: {
                    onInit: function() {
                        console.log('Summernote is launched');
                    },
					// Envia los datos, del box si son modificados
                    onChange: function(content){
						
						var form =  self.parents('form'); //form padre
						// Llama a los datos del for  
						var formData = new FormData(
							 			document.getElementById(form.attr('id')));
						

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


/*
	Actualiza el thumbnail de cualquier imagen, en el componente que 
	se le indique
	
	@param {object} : event 
	@param {string} elementToSet : elemento a ser actualizado
	@param {boolean} elementImg : Si el thumbnail sera una imagen o un background
	
	@return {string} : Retorna la ruta del elemento blob
*/
function set_thumbnail(event, elementToSet, elementImg = true){
	
	try {
		// Generamos una excepcion si el elemento a selecciona no es inicializado
		if (undefined === elementToSet)
			throw (msgFnError('set_thumbnail', 'elementToSet', 
							  'elemento a actualizar no esta inicializado'));

		// 
		var elementHTML = event.target.outerHTML; 
		
		// Verificamos que el tipo de input sea file
		if (-1 !== elementHTML.indexOf('type="file"')){

			// Llamamos el path de la imagen blob
			var imageBlobPath = URL.createObjectURL(event.target.files[0]);
			
			// Verifica si actualizamos un <img src=""> u otro elemento background
			if (elementImg)
				$(elementToSet).attr('src', imageBlobPath);
			else 
				$(elementToSet).css('background-image', 'url(' + imageBlobPath + ')');
		}
	}
	catch(e){
		console.log(e);
	}
}




/*
	Envia los datos del formulario, 
	cuando se produce algun en un elemento del formulario
*/

function send_form_auto(element, ){
	
	// Busca el primer formulario superior
	var formParent = element.parents('form');
	
	// Creamos el formData
	var formData = new FormData(document.getElementById(formParent.attr('id')));
}


/*
	
	@param {string} fn : nombre de la funcion
	@param {string} param : nombre de el/los parametros
	@param

*/
function msgFnError(fn,param,msg = '--'){
	return 'Fn: '+fn+' \nParam: '+param+' \nMsg: '+msg;
}

// Seleccionamos la nueva portada
$('#page_portada_input').change(function(e){
	set_thumbnail(e, '#page-portada-image');
});
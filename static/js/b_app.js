$(function(){
	
	// Seleccionamos un widget a generar
	$("#select-widget div").on('click', function(e){
		console.log($(this).html());
	});
	
	// Actualiza la barra del titulo
	min_scroll_head_bar(null, 57);
	$(window).scroll(function(e){
		min_scroll_head_bar($(this),57);
	});
		
	
	// Seleccionamos un widget, Creamos un widget
	$('#widget-select li').click(function(e){
		var widget_name = $(this).attr('data-value');
		var page_id = $('.widget-container').attr('data-page');
		get_widget(page_id, widget_name);
	});
	
	// Ordenamos el menu 
	$("#menu_created").sortable({ 
        placeholder: "ui-sortable-menu", 
        stop: function( event, ui ) {
            /*set_order(GESTION_URL+'widgets/ordered',
                selected : '#menu_created li',
            );*/
			console.log('ordenado correctamente');
        }  
    });
	
	
	// Funciones embebidas
	_main();
	
	console.log('Loaded b_app.js');
});


// -- Funciones de la app --


function min_scroll_head_bar(element = null, min_val){

	if($(this).scrollTop() > min_val) { 
		$(".theme-container-head").addClass('theme-container-fixed');
	}
	else {
		$(".theme-container-head").removeClass('theme-container-fixed');
	}

}

/*
	@param {number} : Id de la pagina
	@param {string} : Nombre del widget
*/
function get_widget(page_id,widget_name){
	
	var url = GESTION_URL+widget_name+'/new/'+page_id;
	
	$.post(url, {
		'g-submit': true
	}, function(data){
		$('#widget-list').append(data);
	});
}


function set_order(url, element, event = 'click'){
	$('body').delegate(element, event, function(){
		var order_list = [];
		
		$.each($(element), function(k, v) {
		   order_list.push($(v).attr('data-value'));
		});
		
		
		console.log(order_list);
		/*$.post(url,
			   {'g-submit': true}, function(){
			new PNotify({
				title: 'Ordenado!',
				text: '',
				type: success
			});
		});*/
	});
}

// -- end fn de la app --

function _main(){
	
	// Creamos un slug para la pagina
	create_slug('.page-container #g-title', '.page-container #g-url');
	create_slug('.page-container #g-url');
	
	// Volvemos editable cualquier div['data-action=editable']
	set_summernote("div[data-action=editable]");
	
	// Envio automatico de cualquier elemento que pertenezca a widget-container
	send_single_form('.widget-container input', 'post');
	send_single_form('.widget-container input[type=file]', 'post', 'change');
	
	
	// Envio automatico de cualquier elemento select que pertenezca a widget-container
	send_single_form('.widget-container select', 'post', 'change');
	
	// Se actualiza thumbnail de pordada de la pagina
	set_image_background('.page-portada-container');
	
	// Se actualiza el thumbail de un widget del tipo grid
	set_image_background('.grid-sortable','li');
	set_image('.container-image','img.img-portada');
	
	
	// Eliminamos una fila de page
	remove_element('#page-table-list tr');
	
	// Eliminamos un widget
	remove_element('#widget-list li');
	
	// Eliminamos un elemento del menu
	remove_element('#menu_created li');

}


// -- Funciones genericas --


/*
    Utilizamos 'summernote.js' para agregar un toolbar 
	de edicion al contenido.
	(*) utiliza un delegate por si el div, fuese generado dinamicamente
	
	@param {string} element : Representa al elemento que es seleccionado
	@param {string} event : Evento realizado sobre el elemento(element)
	
	@return void 
*/

function set_summernote(element, event = 'click'){
    $('body').delegate(element, event, function(e){
		
		// Valor del elemento seleccionado
        var self = $(this); 
		
		// Verficamos que el data action sea editable
        if (e.target.outerHTML.indexOf('editable')){
			
			// configuracion de SUMMERNOTE.js 
            self.summernote({
                minHeight: null,
                maxHeight: null, 
                focus: true,
                lang: 'es-ES',
                placeholder: 'Editar Contenido [ aquí ]',
                callbacks: {
					onInit: function() {
						console.log('SUMMERNOTE.js is launched');
					},
					onChange: function(content){
						// Envia los datos a la db, si son modificados
						send_single_data(self, content, 'post');
					},
					onBlur: function(c) {
							
						console.log(c);
						//self.summernote('destroy');
					},
					onImageUpload: function(files) {
					  // upload image to server and create imgNode...
					  //$summernote.summernote('insertNode', imgNode);
					}
                }
            });

        }
    });
}


/*
	
	-- Modificar --
	// Verificar
	
	Envia todos los datos de un formulario en particular
	@param {mixed} formElement : Formulario/s que son seleccionado
	@param {string} mixed : 
	
	@return {void} 
*/
function send_form(formElement){
	
	$(formElement).submit(function(e){
		e.preventDefault();
		
		var form = $(this);
		
		// Definimos la forma/method de envio post/get
		var formMethod = form.attr('method');
		if (undefined === formMethod)
			formMethod = 'post';
		
		// Definimos el action del formulario
		var formAction = form.attr('action');
		if (undefined === formAction)
			formAction = e.target.baseURI;
		
		
		// Generamos el formulario a ser enviado
		var formData = new FormData(
			document.getElementById(formElement));
		formData.append('g-submit', true);

		$.ajax({
			url: formAction,
			type: formMethod,
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(data){
			console.log('Se envio el formulario');
		});
		
	});
	
}

/*
	Envia cualquier dato dentro en un html, relacionando su nombre 
	de la etiqueta id, esta hecho para el summernote
	
	@param {string} element : Elemento seleccionado
	@param {string} data : contentido a ser enviado
	@param {string} method : Por defecto el metodo es GET
	
	@return {void}
*/	
function send_single_data(element, data, method = 'get'){
	
	// Valor en la etiqueta id del elemento
	var elementId = element.attr('id');
	
	// Formulario padre encontrado
	var form = element.parents('form'); 
	var formAction = form.attr('action');
	
	// Generamos el formulario que sea enviado
	var formData = new FormData();
	
	formData.append(elementId, data);
	formData.append('g-submit', true);
	
	// Enviamos los datos
	$.ajax({
		url: formAction,
		type: method,
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	})
	.done(function(data){
		console.log('Datos Modificados correctamente');
	});
}

/*
	Envia UN campo de un formulario
	
	@param {string} element : Elemento seleccionado, sin apostrofes
	@param {string} method : Por defecto el metodo es GET
*/
function send_single_form(element, method = 'get', event = 'keyup'){

	$('body').delegate(element, event, function(){
		var self = $(this);
		
		// Valor en la etiqueta id del elemento
		var elementName = self.attr('name');
		var elementValue = self.val();
		
		// Formulario padre encontrado
		var form = self.parents('form'); 
		var formAction = form.attr('action');
		
		// Generamos el formulario que sea enviado
		var formData = new FormData();
		formData.append(elementName, elementValue);
		formData.append('g-submit', true);

		// Enviamos los datos
		$.ajax({
			url: formAction,
			type: method,
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

/*
	Remueve, eliminamos un elemento HTML
	El elemento a ser removido depende del link <a href=".."></a>
	que contiene la ruta, para eliminar el archivo
	
	@param {string} : element, Elemento a ser eliminado
	@param {string} : event
	@param {string} : msg : Mensaje al eliminar elemento
*/
function remove_element(element,  msg = null, event = 'click') {
	
	// Si el mensaje no esta inicializado
	if (null === msg)
		msg = 'Está por eliminar el elemento, ¿Desea Continuar?';
	
	
    $('body').delegate(element+' a[data-action=remove]', event, function(e){
        e.preventDefault();      
		var a = $(this);
		
		// Pariente a ser eliminado
		var elementRemove =  a.parents(element);
		
        if (confirm(msg)){
			$.post(a.attr('href'), { 'g-submit' : true },function(data){
				
				// Si data es true, eliminamos el html
				if (data){
					
					// Si no se asigno element, se elimina a si mismo
					if (null === element) 
						a.remove();    
					else 
						elementRemove.remove();
					
					// Actualizamos el numero de cantidad de filas
					$('#total_row').text(parseInt(
											$('#total_row').text() - 1));
					console.log('Elemento eliminado');

				}
				else {
					console.log('Elemento no eliminado');
				}

			});


		}
    });
}



/*
	Crea el slug de la url/slug, remplaza los espacios por guinos
	
	@param {string} element : Elemento desde donde modificar URL
	@param {string} elementToSet : Elemento a actualizar
	@param {string} event 

*/	
function create_slug(element, elementToSet = null, event = 'keyup'){
	
	// Si no se inicializa elementToSet, el element se modifica a si mismo
	if (null === elementToSet)
		elementToSet = element;
	
	$('body').delegate(element, event, function(){
		var a = $(this).val();
		var b= a.replace(/\s/g,"-").toLowerCase(); 	
		$(elementToSet).val(b);
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
			throw ('elementToSet no esta definido');
		

		// Elemento Seleccionado
		var elementHTML = event.target.outerHTML; 

		// Verificamos que el tipo de input sea file
		if (-1 !== elementHTML.indexOf('type="file"')){

			// Llamamos el path de la imagen blob
			var imageBlobPath = URL.createObjectURL(event.target.files[0]);
			
			// Verifica si actualizamos un <img src=""> u otro elemento background
			if (elementImg)				
				elementToSet.attr('src', imageBlobPath);
			else 
				elementToSet.css('background-image', 
									'url(' + imageBlobPath + ')');
		}
	}
	catch(e){
		console.log(e);
	}
}


/*
	Envia una imagen al servidor
	
	@param {string} element : input file seleccionado
	@param {string} elementToSet : Elemento a actualizar
	@param {string} event : Por defecto click
*/
function set_image(element, elementToSet = '', event = 'change'){

	$('body').delegate(element+' input[type=file]', event, function(e){
		
		var elementParent = $(this).parents(element);
		var elementSetter = $(elementParent).find(elementToSet);

		if (0 !== elementSetter)
			set_thumbnail(e, elementSetter);
	});
}


/*
	Actualiza el background de un elemento
	
	@param {string} element : input file seleccionado
	@param {string} elementToSet : Elemento a actualizar
	@param {string} event : Por defecto click
*/
function set_image_background(element, elementToSet = '', event = 'change'){
	
	$('body').delegate(element+' input[type=file]', event, function(e){
		
		var elementParent = $(this).parents(element+' '+elementToSet);
		
		if (0 !== elementParent)
			set_thumbnail(e, elementParent, false);
	});
}



// end fn genericas --


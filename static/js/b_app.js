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
		
	
	// Se crea el widget que es seleccionado (Oprimido)
	$('#widget-select li').click(function(e){
		var widget_name = $(this).attr('data-value');
		var page_id = $('.widget-container').attr('data-page');
		get_widget(page_id, widget_name);
	});
	
	// Ordenamos el menu 
	$("#menu-created").sortable({ 
        placeholder: "ui-sortable-menu", 
        stop: function( event, ui ) {
			var url = FOCUS_URL+'menu/ordered';
            send_order(url, '#menu-created li');
        }  
    });

	
	// Funciones embebidas
	_main();
	
	console.log('-- Focus CMS loaded --');
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
function get_widget(page_id, widget_name){
	
	var url = FOCUS_URL+widget_name+'/new/'+page_id;
	
	$.post(url, {
		'g-submit': true
	}, function(data){		
		
		console.log(data);
		
		if ('false' !== data){
			
			
			$('#widget-list').append(data);
			
			new PNotify({
				title: 'Widget creado!',
				text: 'El Widget '+widget_name+' se creo correctamente',
				type: 'success'
			});	
			
		}
	});
}


function send_order(url, element, event = 'click'){
	// Array de elementos ordenados
	var order_list = [];

	// Anexamos los datos al array de elementos
	$(element).each(function(){
		order_list.push($(this).attr('data-order'));	
	});
	
	$.post(url, {
		'g-submit': true , 
		order : order_list 
	}, function(data){

		var a = JSON.parse(data);
		if (true === a)
			new PNotify({
				title: 'Ordenado!',
				text: 'Elemento ordenado correctamente',
				type: ''
			});	
		else
			console.log('Problema al ordenar el menu');	
		
	});

}

// -- end fn de la app --

function _main(){
	
	// Enviamos archivos de forma automatica
	
	// Creamos un slug para la pagina
	create_slug('.page-container #g-title', '.page-container #g-url');
	create_slug('.page-container #g-url');
	
	// Volvemos editable cualquier div['data-action=editable']
	set_summernote("div[data-action=editable]");
	
	// Envio automatico de cualquier elemento que pertenezca a widget-container
	send_single_form('.widget-container input', 'post');
	
	
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
	remove_element('#menu-created li');
	
	// Eliminamos una fila de un contacto
	remove_element('#contact-table-list tr');
	
	// Enviamos el formulario del menu
	send_form('#menu-form');
	
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
	
	Envia todos  datos de un formulario, no complementos, estructuras adicionales
	@param {mixed} formElement : Formulario/s que son seleccionado
	@param {string} mixed : 
	
	@return {void} 
*/
function send_form(formElement, fn){
	
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
		
		
		// Generamos el formulario a enviar
		var formId = form.attr('id');
		var formElementById = document.getElementById(formId);
		
		// Generamos el formulario a ser enviado
		var formData = new FormData(formElementById);
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
			
			data = JSON.parse(data);
			
			// Si se recibio el request correctamente
			if (data)
				location.reload();
			else 
				alert('Error');
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
			
			if ('false' !== data){
				// Actualizamos el valor del input file
				
				new PNotify({
					title: 'Subido!',
					text: 'Archivo subido correctamente',
					type: ''
				});
				
			}
			else {
				new PNotify({
					title: 'Error al Subir!',
					text: 'El archivo no fué subido',
					type: ''
				});
			}
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
					$('#total_row').text(
						parseInt($('#total_row').text() - 1)
					);
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
	
	@return {boolean} : Si se actualiza la miniatura puede enviarse al servidor
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

			// Llamamos el path de la imagen blob, y verificamos el tamaño de archivo
			// Verificamos si el elemento a actualzar es una imagen o un background
			var fileData = event.target.files[0];
			if (MAX_FILE_SIZE >= fileData.size){
				var imageBlobPath = URL.createObjectURL(fileData);
				if (elementImg)				
					elementToSet.attr('src', imageBlobPath);
				else 
					elementToSet.css('background-image', 
										'url(' + imageBlobPath + ')');


				return true;	
			}
		}

	}
	catch(e){
		console.log(e);
	}
	
	return false;
	
}


/*
	Envia una imagen al servidor
	
	@param {string} element : input file seleccionado
	@param {string} elementToSet : Elemento a actualizar
	@param {string} event : Por defecto click
*/
function set_image(element, elementToSet = '', event = 'change'){

	$('body').delegate(element+' input[type=file]', event, function(e){
		
		var self = $(this);
		var elementParent = self.parents(element);
		var elementSetter = $(elementParent).find(elementToSet);

		if (0 !== elementSetter){
			var fileSend = set_thumbnail(e, elementSetter);
			if (fileSend){
				console.log('Archivo enviado correctamente');
				send_files(self);
			}
			else {
				console.log('-- Verificar el tamaño del archivo asignado --');
				
				new PNotify({
					title: 'Error!',
					text: 'Archivo excede el tamaño permitido',
					type: ''
				});
			}
		}
			
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
		
		var self = $(this);
		var elementParent = self.parents(element+' '+elementToSet);
		
		if (0 !== elementParent){
			var fileSend = set_thumbnail(e, elementParent, false);
			if (fileSend){
				console.log('Archivo enviado correctamente');
				send_files(self);
			}
			else {
				console.log('-- Verificar el tamaño del archivo asignado --');
				
				new PNotify({
					title: 'Error!',
					text: 'Archivo Excede el tamaño permitido',
					type: ''
				});
			}
		}
			
	});
}

function send_files(element){
	// Asignamos la imagen mientras se carga el archivo
	$('.loading-data').addClass('loading-image');
	
	var form = element.parents('form');
	var formAction = form.attr('action');
	var formIdStr = form.attr('id');
	var formDOM = document.getElementById(formIdStr);


	// Verificamos el metodo de envio
	var formMethod = form.attr('method')
	if (undefined === formMethod)
		formMethod = 'post';

	// Inicializamos el formulario a enviar
	var formData = new FormData(formDOM);
	formData.append('g-submit', true);

	// Enviamos los datos
	$.ajax({
		url: formAction,
		type: formMethod,
		data: formData,
		cache: false,
		contentType: false,
		processData: false
	})
	.done(function(data){

		if ('false' !== data){
			// Actualizamos el valor del input file
			element.val(null);

			new PNotify({
				title: 'Subido!',
				text: 'Archivo subido correctamente',
				type: ''
			});
			
			console.log('Eliminamos el loading image');
			$('.loading-data').removeClass('loading-image');
		}
		else {
			console.log('Algo no salio bien');
		}


	});
}

function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    if (i == 0) return bytes + ' ' + sizes[i];
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};


// end fn genericas --


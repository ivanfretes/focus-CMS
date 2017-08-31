## Framework codeigniter-super ##

BACKEND : 
 1. Codeignter
 2. Super-Helper : Conjunto de librerias, para el manejo string, db, numeros

### Widget ###
	* Para crear widget, se crean vacios por defecto, con el fin de llamar con JS, y que el usuario ya lo pueda editar.
	* Para editar los elementos, se editan uno a uno, para evitar procesar todo el formulario sin ninguna necesidad
	* Existe un controlador widget que genera las vista de todos
	* Para cada widget existe un controlador que crea y edita los campos, debido a que estos, tienen caracteristicas distintas.
	* No olvidar que para cada widget, pueden haber n items en otra subtabla, el ejemplo de ello es un widget slide, que tiene 5 registros, cada uno representa una imagen, pero forman a un solo widget
	* El nombre de las vistas, functiones, y modelos es similar, por no decir igual, recordar esto. Importante!



Widget Creados hasta el momento
	* Slide: Conjunto de 5 Imagenes, con o sin miniaturas
	* Cuadricula: Conjunto de n cantidad de imagenes
	* Row : Fila hasta con dos columnas, que puede variar su orientacion



## Documentacion ##

Widget

*Lista un widget*

	/**
	 * Retorna un array de objetos, en caso que se necesite un objeto, el 
	 * primer elemento $result[0] contiene los datos de retorno
	 *
	 *
	 * @param {number} $widget_id
	 * @param {string} $widget_type : Representa el nombre de la tabla
	 * @return {array} Retorna todos los elementos de los widgets
	 */
	get_widget($widget_id, $widget_type)


*Listar los 'n' widgets de una pagina*


	/**
	 * Retorna todos los widget de una pagina, retorna un matriz de objetos
	 * 
	 * @param {number} $page_id id de página
	 * @return {array} : Registros de varios tipos de widget
	 */
	 get_all_widget($page_id)



FRONTEND

Obs : Trabaja con Template.JS
	Es un framework propio, que contiene funciones de envio de datos, imagenes,
	eliminacion de elementos, etc

 Dependencia
 1. jQuery 1.11 o superior
 2. jQuery UI
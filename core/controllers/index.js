//Inicializando la función para verificar que un usuario haya iniciado sesión
$(document).ready(function()
{
    checkUsuarios();
    graficar_existencia_categoria();
    graficar_ventas_platillos();
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiSesion = '../core/api/usuarios.php?action=';
const apiCategorias = '../core/api/categorias.php?site=private&action=';

//Función para verificar si existen usuarios en el sitio privado
function checkUsuarios()
{
    $.ajax({
        url: apiSesion + 'read',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const dataset = JSON.parse(response);
            //Se comprueba que no hay usuarios registrados para redireccionar al registro del primer usuario
            if (dataset.status == 2) {
                sweetAlert(3, dataset.exception, 'registrar.php');
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función para validar el usuario al momento de iniciar sesión
$('#form-sesion').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiSesion + 'login',
        type: 'post',
        data: $('#form-sesion').serialize(),
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const dataset = JSON.parse(response);
            //Se comprueba si la respuesta es satisfactoria, sino se muestra la excepción
            if (dataset.status) {
                sweetAlert(1, 'Autenticación correcta', 'inicio.php');
            } else {
                sweetAlert(2, dataset.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})



//funcion para graficar la cantidad de libros vendidos 
function graficar_existencia_categoria() {
    //se manda a pedir los datos de la api
    $.ajax({
            url: apiCategorias + 'existencias_categoria',
            type: 'post',
            data: null,
            datatype: 'json'
        })
        .done(response => {
            //se hacen los arreglos para poder recorrer las filas de la consulta
            var nombre = [];
            var existencia = [];
            //se genera un ciclo para poder recorrer las filas de la tabla de la base de datos
            const result = JSON.parse(response);
            result.dataset.forEach(row => {
                //se recorren todos los datos que esten en las filas especificadas en el row
                nombre.push(row.nombre_categoria);
                existencia.push(parseInt(row.cantidad));
            });
            //se mandar los parametros de la funcion que se crea en el controlador de function.js los cuales son el id, xAxis, yAxis y legend
            grafico_existencia_categoria("existencia_categoria", nombre, existencia, "Existencias.", "Existencia de materia prima por categoria")
        })

        //en caso de error se ejecuta esta funcion
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });

}

//funcion para graficar la cantidad de libros vendidos 
function graficar_ventas_platillos() {
    //se manda a pedir los datos de la api
    $.ajax({
            url: apiCategorias + 'ventas_platillos',
            type: 'post',
            data: null,
            datatype: 'json'
        })
        .done(response => {
            //se hacen los arreglos para poder recorrer las filas de la consulta
            var nombre = [];
            var venta = [];
            //se genera un ciclo para poder recorrer las filas de la tabla de la base de datos
            const result = JSON.parse(response);
            result.dataset.forEach(row => {
                //se recorren todos los datos que esten en las filas especificadas en el row
                nombre.push(row.nombre_platillo);
                venta.push(parseInt(row.subtotal));
            });
            //se mandar los parametros de la funcion que se crea en el controlador de function.js los cuales son el id, xAxis, yAxis y legend
            grafica_venta_platillos("venta_platillo", nombre, venta, "dolares", "Ventas de platillos")
        })

        //en caso de error se ejecuta esta funcion
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });

}


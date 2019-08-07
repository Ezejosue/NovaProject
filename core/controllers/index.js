//Inicializando la función para verificar que un usuario haya iniciado sesión
$(document).ready(function () {
    checkUsuarios();
    graficar_existencia_categoria();
    graficar_ventas_platillos();
    graficar_ventas_platillos_menor();
    graficar_platillos_mayores();
    graficar_platillos_menores();
    showSelectCategoria('id_categoria', 0);
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiSesion = '../core/api/usuarios.php?action=';
const apiCategorias = '../core/api/categorias.php?site=private&action=';
const apiPlatillos = '../core/api/platillos.php?site=private&action=';

//Función para verificar si existen usuarios en el sitio privado
function checkUsuarios() {
    $.ajax({
            url: apiSesion + 'read',
            type: 'post',
            data: null,
            datatype: 'json'
        })
        .done(function (response) {
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
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
}

//Función para validar el usuario al momento de iniciar sesión
$('#form-sesion').submit(function () {
    event.preventDefault();
    $.ajax({
            url: apiSesion + 'login',
            type: 'post',
            data: $('#form-sesion').serialize(),
            datatype: 'json'
        })
        .done(function (response) {
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
        .fail(function (jqXHR) {
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
            url: apiPlatillos + 'ventas_platillos_mayor',
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
                venta.push(row.subtotal);
            });
            //se mandar los parametros de la funcion que se crea en el controlador de function.js los cuales son el id, xAxis, yAxis y legend
            grafica_venta_platillos_mayor("venta_platillo", nombre, venta, "dolares", "Top 5 platillos más vendidos")
        })

        //en caso de error se ejecuta esta funcion
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });

}


//funcion para graficar la cantidad de libros vendidos 
function graficar_ventas_platillos_menor() {
    //se manda a pedir los datos de la api
    $.ajax({
            url: apiPlatillos + 'ventas_platillos_menor',
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
                venta.push(row.subtotal);
            });
            //se mandar los parametros de la funcion que se crea en el controlador de function.js los cuales son el id, xAxis, yAxis y legend
            grafica_venta_platillos_menores("venta_platillo_menor", nombre, venta, "dolares", "Top 5 platillos menos vendidos")
        })

        //en caso de error se ejecuta esta funcion
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });

}



//funcion para graficar la cantidad de libros vendidos 
function graficar_platillos_mayores() {
    //se manda a pedir los datos de la api
    $.ajax({
            url: apiPlatillos + 'grafica_platillos_mayores',
            type: 'post',
            data: null,
            datatype: 'json'
        })
        .done(response => {
            //se hacen los arreglos para poder recorrer las filas de la consulta
            var nombre = [];
            var dinero = [];
            //se genera un ciclo para poder recorrer las filas de la tabla de la base de datos
            const result = JSON.parse(response);
            result.dataset.forEach(row => {
                //se recorren todos los datos que esten en las filas especificadas en el row
                nombre.push(row.nombre_platillo);
                dinero.push(row.precio);
            });
            //se mandar los parametros de la funcion que se crea en el controlador de function.js los cuales son el id, xAxis, yAxis y legend
            grafica_platillos_caros("mayor_platillo", nombre, dinero, "platillos más caros", "Top 5 de platillos más caros.")
        })

        //en caso de error se ejecuta esta funcion
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });

}



//funcion para graficar la cantidad de libros vendidos 
function graficar_platillos_menores() {
    //se manda a pedir los datos de la api
    $.ajax({
            url: apiPlatillos + 'grafica_platillos_menores',
            type: 'post',
            data: null,
            datatype: 'json'
        })
        .done(response => {
            //se hacen los arreglos para poder recorrer las filas de la consulta
            var nombre = [];
            var dinero = [];
            //se genera un ciclo para poder recorrer las filas de la tabla de la base de datos
            const result = JSON.parse(response);
            result.dataset.forEach(row => {
                //se recorren todos los datos que esten en las filas especificadas en el row
                nombre.push(row.nombre_platillo);
                dinero.push(row.precio);
            });
            //se mandar los parametros de la funcion que se crea en el controlador de function.js los cuales son el id, xAxis, yAxis y legend
            grafica_platillos_baratos("menor_platillo", nombre, dinero, "platillos más baratos", "Top 5 de platillos más baratos.")
        })

        //en caso de error se ejecuta esta funcion
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });

}


//Función para cargar los tipos de categorias en el select del formulario
function showSelectCategoria(idSelect, value)
{
    $.ajax({
        url: apiCategorias + 'readCategoria',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                let content = '';
                if (!value) {
                    content += '<option value="" disabled selected>Seleccione una opción</option>';
                }
                result.dataset.forEach(function(row){
                    if (row.id_categoria != value) {
                        content += `<option value="${row.id_categoria}">${row.nombre_categoria}</option>`;
                    } else {
                        content += `<option value="${row.id_categoria}" selected>${row.nombre_categoria}</option>`;
                    }
                });
                $('#' + idSelect).html(content);
            } else {
                $('#' + idSelect).html('<option value="">No hay opciones</option>');
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

function CategoriaClick()
{
    let id_categoria = parseInt($('#id_categoria').val())
    $.ajax({
        url: apiCategorias + 'ventas_categoria',
        type: 'post',
        data: { id_categoria },
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba si el resultado es satisfactorio, sino se remueve la etiqueta canvas
            if (result.status) {
                let nombres = [];
                let dinero = [];
                result.dataset.forEach(function(row){
                    nombres.push(row.nombre_platillo);
                    dinero.push(row.subtotal);
                });
                grafica_ventas_categoria('grafica_ventas', nombres, dinero, 'Platillos más vendidos por categoria', 'Cantidad de platillos más vendidos por categoria')
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    }); 
}

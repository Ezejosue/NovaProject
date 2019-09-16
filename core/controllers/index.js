//Inicializando la función para verificar que un usuario haya iniciado sesión
$(document).ready(function () {
    showMenu();
    graficar_existencia_categoria_agotar();
    graficar_existencia_categoria_sobre_existencias();
    graficar_ventas_platillos();
    graficar_ventas_platillos_menor();
    graficar_platillos_mayores();
    graficar_platillos_menores();
    showSelectCategoria('id_categoria', 0);
    showSelectCategoria('id_categoria_materia_agotar', 0);
    showSelectCategoria('id_categoria_materia_sobre_existente', 0);
})


//Constante para establecer la ruta y parámetros de comunicación con la API
const apiCategorias = '../core/api/categorias.php?site=private&action=';
const apiPlatillos = '../core/api/platillos.php?site=private&action=';

//funcion para graficar la cantidad de libros vendidos 
    function graficar_existencia_categoria_agotar() {
        //se manda a pedir los datos de la api
        $.ajax({
                url: apiCategorias + 'existencias_categoria_agotar',
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
                grafico_existencia_categoria_agotar("existencia_categoria_agotar", nombre, existencia, "Existencias.", "Existencia de materia prima por categoria (productos a punto de acabarse)")
            })

            //en caso de error se ejecuta esta funcion
            .fail(function (jqXHR) {
                //Se muestran en consola los posibles errores de la solicitud AJAX
                console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
            });

    }


//funcion para graficar la cantidad de libros vendidos 
function graficar_existencia_categoria_sobre_existencias() {
    //se manda a pedir los datos de la api
    $.ajax({
            url: apiCategorias + 'existencias_categoria_sobre_existen',
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
            grafico_existencia_categoria_sobre_existen("existencia_categoria_sobre_existen", nombre, existencia, "Existencias.", "Existencia de materia prima por categoria (productos a punto de acabarse)")
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
        cache: false,
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
               //se deshabilitan tanto el boton como el comobobox para que no genere más de una grafica 
                document.getElementById('bloqueo').disabled=true;
                document.getElementById('id_categoria').disabled=true;
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



function MesClick()
{
    let idMes = parseInt($('#idMes').val())
    $.ajax({
        url: apiCategorias + 'ventas_mes',
        type: 'post',
        data: { idMes },
        cache: false,
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
                    dinero.push(row.ventas);
                });
                grafica_ventas_mes('grafica_mes', nombres, dinero, 'Platillos más vendidos por mes', 'Cantidad de platillos más vendidos por mes seleccionado')
                //se deshabilitan tanto el boton como el comobobox para que no genere más de una grafica 
                document.getElementById('botonMes').disabled=true;
                document.getElementById('idMes').disabled=true;
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


function MesDesperdiciosClick()
{
    let idMesDesperdicios = parseInt($('#idMesDesperdicios').val())
    $.ajax({
        url: apiCategorias + 'desperdicios_mes',
        type: 'post',
        data: { idMesDesperdicios },
        cache: false,
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
                    nombres.push(row.nombre_receta);
                    dinero.push(row.cantidad);
                });
                grafica_desperdicios_mes('grafica_desperdicios_mes', nombres, dinero, 'Desperdicios por mes', 'Cantidad de desperdicios por mes seleccionado')
                //se deshabilitan tanto el boton como el comobobox para que no genere más de una grafica 
                document.getElementById('botonMesDesperdicios').disabled=true;
                document.getElementById('idMesDesperdicios').disabled=true;
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


function MateriaClick()
{
    let id_categoria_materia_agotar = parseInt($('#id_categoria_materia_agotar').val())
    $.ajax({
        url: apiCategorias + 'existencia_materia_agotar',
        type: 'post',
        data: { id_categoria_materia_agotar },
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba si el resultado es satisfactorio, sino se remueve la etiqueta canvas
            if (result.status) {
                let nombres = [];
                let productos = [];
                result.dataset.forEach(function(row){
                    nombres.push(row.nombre_materia);
                    productos.push(row.cantidad);
                });
                grafica_existencia_materia_agotar('existencia_categoria_materia_agotar', nombres, productos, 'Materias primas en escacez', 'Productos por agotar')
               //se deshabilitan tanto el boton como el comobobox para que no genere más de una grafica 
                document.getElementById('id_categoria_materia_agotar').disabled=true;
                document.getElementById('botonmateria').disabled=true;
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


function Materia_sobre_Click()
{
    let id_categoria_materia_sobre_existente = parseInt($('#id_categoria_materia_sobre_existente').val())
    $.ajax({
        url: apiCategorias + 'existencia_materia_sobre_existente',
        type: 'post',
        data: { id_categoria_materia_sobre_existente },
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba si el resultado es satisfactorio, sino se remueve la etiqueta canvas
            if (result.status) {
                let nombres = [];
                let productos = [];
                result.dataset.forEach(function(row){
                    nombres.push(row.nombre_materia);
                    productos.push(row.cantidad);
                });
                grafica_existencia_materia_sobre_existente('existencia_categoria_materia_sobre_existente', nombres, productos, 'Materias primas en escacez', 'Productos por agotar')
               //se deshabilitan tanto el boton como el comobobox para que no genere más de una grafica 
                document.getElementById('id_categoria_materia_sobre_existente').disabled=true;
                document.getElementById('botonmateria_ex').disabled=true;
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


//Inicializando la función para mostrar la tabla de unidad de medida
$(document).ready(function()
{
    showMesas();
    showCategorias();
    
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const apiMesas = '../core/api/mesas.php?site=private&action=';


//Función para mostrar el número de productos en inicio
function showMesas(){
    $.ajax({
        url: apiMesas + 'readMesas',
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
                result.dataset.forEach(function(row){
                    content+= `<a href="#modal-orden" class="btn btn-primary modal-trigger" data-toggle="modal" style="border-radius: 10px; margin: 2px;">
                    <h4 style="color: white; font-size: 20px;">MESA ${row.numero_mesa}</h4>
                    <i class="fas fa-pizza-slice"></i>
                    </a>`;
                });
               // console.log(result.dataset);
                $('#data-mesas').html(content);
            } else {

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

function showCategorias(){
    $.ajax({
        url: apiMesas + 'readCategorias',
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
                let content2 = '';
                result.dataset.forEach(function(row){
                    content2+= `<a class="list-group-item list-group-item-action" onclick="showProductos(${row.id_categoria})" href="#list-item-1">${row.nombre_categoria}</a>`;
                });
                console.log(result.dataset);
                $('#lista').html(content2);
            } else {

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

function showProductos(id){
    console.log(id);
    $.ajax({
        url: apiMesas + 'readProductos',
        type: 'post',
        data: {
            idCategoria: id
        },
        datatype: 'json' 
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                let content2 = '';
                result.dataset.forEach(function(row){
                    content2+= `<div class="col-sm-12 col-md-4">
                    <div class="card">
                        <img src="../resources/img/platillos/${row.imagen}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">${row.nombre_platillo}</h5>
                            <br>
                            <h5 class="card-text">${row.precio}</h5>
                            <a class="btn btn-primary" style="border-radius: 20px"><i class="fas fa-plus"></i></a>
                        </div>
                        </div>
                    </div>`;
                });
                console.log(result.dataset);
                $('#productos').html(content2);
            } else {

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
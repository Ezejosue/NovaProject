//Inicializando la función para mostrar la tabla de unidad de medida
$(document).ready(function()
{
    showMesas();
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const apiMesas = '../core/api/mesas.php?site=private&action=';


//Función para mostrar el número de productos en inicio
function showMesas(){
    $.ajax({
        url: apiMesas + 'read',
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
                    content+= `<button class="btn btn-primary" style="border-radius: 10px; margin: 2px;">
                    <h4 style="color: white; font-size: 20px;">MESA ${row.numero_mesa}</h4>
                    <i class="fas fa-pizza-slice"></i>
                    </button>`;
                });
                console.log(result.dataset);
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
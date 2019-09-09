//Inicializando la función para verificar que un usuario haya iniciado sesión
$(document).ready(function () {
    validarTokenActivacion();
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiActivacion = '../core/api/usuarios.php?site=private&action=';

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function validarTokenActivacion()
{
    var token = getParameterByName('token');
    let alert = '';
    $.ajax({
        url: apiActivacion + 'activacion',
        type: 'post',
        data: {
            token: token
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status == 1) {
                alert += `<div class="alert alert-success" role="alert"> Su cuenta ha sido activada con éxito </div> `;
                $('#alert').html(alert);
            } else {
                alert += `<div class="alert alert-danger" role="alert"> Ocurrió un problema :( </div> `;
                $('#alert').html(alert);
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
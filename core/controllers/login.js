//Inicializando la función para verificar que un usuario haya iniciado sesión
$(document).ready(function () {
    checkUsuarios();
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiLogin = '../core/api/usuarios.php?site=private&action=';

//Función para validar el usuario al momento de iniciar sesión
$('#form-sesion').submit(function () {
    event.preventDefault();
    $.ajax({
            url: apiLogin + 'login',
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
                    if (dataset.status == 2) {
                        sweetAlert(2, dataset.exception, 'actualizarpwd.php');
                    } else {
                        sweetAlert(1, 'Autenticación correcta', 'autenticacion.php');
                    }                    
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

//Función para verificar si existen usuarios en el sitio privado
function checkUsuarios() {
    $.ajax({
            url: apiLogin + 'read',
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

$('#form-recuperar-contrasena').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiLogin + 'recuperarContrasena',
        type: 'post',
        data: $('#form-recuperar-contrasena').serialize(),
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const dataset = JSON.parse(response);
            //Se comprueba si la respuesta es satisfactoria, sino se muestra la excepción
            if (dataset.status == 1) {
                sweetAlert(1, 'Se ha enviado el correo exitosamente', null);
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
/* 
function sumarIntentos (alias)
{
    $.ajax({
        url: apiLogin + 'intentos',
        type: 'post',
        data: {
            usuario: alias
        },
        datatype: 'json',
    })
    .done(function(response){
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            sweetAlert(2, result.exception, null);
            if (result.status == 2) {
                sweetAlert(2, result.exception, null);
            }
        }else{
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}
 */
/* 
function bloquearIntentos (alias)
{
    $.ajax({
        url: apiLogin + 'BloquearIntentos',
        type: 'post',
        data: {
            usuario: alias
        },
        datatype: 'json',
    })
    .done(function(response){
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            sweetAlert(2, result.exception, null);
        }else{
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
} */
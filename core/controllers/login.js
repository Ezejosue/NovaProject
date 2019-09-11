//Inicializando la función para verificar que un usuario haya iniciado sesión
$(document).ready(function () {
    checkUsuarios();
    checkEntrada();
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
                    sweetAlert(1, 'Autenticación correcta', 'autenticacion.php');
                } else {
                    sweetAlert(2, dataset.exception, null);
                    let alias = $('#usuario').val();
                    sumarIntentos(alias);
                    bloquearIntentos(alias);
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


//Función para verificar si existen usuarios en el sitio privado
function checkEntrada() {
    $.ajax({
            url: apiLogin + 'ActualizarSesion',
            type: 'post',
            data: null,
            datatype: 'json'
        })
        .done(function (response) {
            //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                sweetAlert(1, result.exception, null);
            } else {
                console.log(response);
            }
        })
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
}

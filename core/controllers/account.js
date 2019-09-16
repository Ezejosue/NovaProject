//Inicialización de las funciones
$(document).ready(function()
{
    showMenu();
    showSelectTipoProfile('profile_tipo', null);
    showDataUser();
    showCountProducts();
    showCountCategories();
    showCountUsers();
    showCountEmployees();
    showDataUser_Responsive();
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiAccount = '../core/api/usuarios.php?site=private&action=';
const apiSesion = '../core/api/usuarios.php?action=';

//Función que llena el menú según el tipo de usuario
function fillMenu(rows)
{
    let content = '';
    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        content += `
        <li>
            <a href="${row.ruta}">
            <i class="fas fa-${row.icono}"></i>${row.nombre_vista}</a>
        </li>
        `;
    });
    $('#main-menu').html(content);
}

//Función que muestra el menú según el tipo de usuario
function showMenu()
{
    $.ajax({
        url: apiSesion + 'readMenu',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (!result.status) {
                sweetAlert(4, result.exception, null);
            }
            fillMenu(result.dataset);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}
//Función que muestra la foto de perfil y nombre del usuario que ha iniciado sesión
function showDataUser()
{
    $.ajax({
        url: apiAccount + 'readProfile',
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
                let content2 = '';
                    content += `
                    <img src="../resources/img/usuarios/${result.dataset.foto_usuario}" />
                    `;
                    content2 += `
                    <h4 class="name">${result.dataset.alias}</h4>
                    `;
                //Se especifica en que parte se desea colocar los elementos
                $('#foto-user').html(content);
                $('#nombre-user').html(content2)
            } else {

                console.log(result.exception);
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

//Función que muestra la foto de perfil y nombre del usuario que ha iniciado sesión en el menú responsive
function showDataUser_Responsive()
{
    $.ajax({
        url: apiAccount + 'readProfile',
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
                let content2 = '';
                    content += `
                    <img src="../resources/img/usuarios/${result.dataset.foto_usuario}" />
                    `;
                    content2 += `
                    <h4 class="name">${result.dataset.alias}</h4>
                    `;
                //Se especifica en que parte se desea colocar los elementos
                $('#foto-user-responsive').html(content);
                $('#nombre-user-responsive').html(content2)
            } else {

                $('#title').html('<i class="material-icons small">cloud_off</i><span class="red-text">' + result.exception + '</span>');
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

//Función para cerrar la sesión del usuario
function signOff()
{
    swal({
        title: 'Advertencia',
        text: '¿Quiere cerrar la sesión?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            location.href = apiAccount + 'logout';
        } else {
            swal({
                title: 'Enhorabuena',
                text: 'Continúe con la sesión...',
                icon: 'info',
                button: 'Aceptar',
                closeOnClickOutside: false,
                closeOnEsc: false
            });
        }
    });
}
//Función para cargar los tipos de usuario en el select del formulario
function showSelectTipoProfile(idSelect, value)
{
    $.ajax({
        url: apiAccount + 'readTipoUsuario2',
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
                    if (row.id_Tipousuario != value) {
                        content += `<option value="${row.id_Tipousuario}">${row.tipo}</option>`;
                    } else {
                        content += `<option value="${row.id_Tipousuario}" selected>${row.tipo}</option>`;
                    }
                });
                $('#' + idSelect).html(content);
            } else {
                $('#' + idSelect).html('<option value="">No hay opciones</option>');
            }
        } 
        else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función para mostrar formulario de perfil de usuario
function modalProfile()
{
    $.ajax({
        url: apiAccount + 'readProfile',
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
                $('#form-profile')[0].reset();
                $('#profile_alias').val(result.dataset.alias);
                showSelectTipoProfile('profile_tipo', result.dataset.id_Tipousuario);
                $('#profile_imagen').val(result.dataset.foto_usuario);
                (result.dataset.estado_usuario == 1) ? $('#profile_estado').prop('checked', true) : $('#profile_estado').prop('checked', false);
                $('#modal-profile').modal('show');
            } else {
                sweetAlert(2, result.exception, null);
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


//Función para editar el perfil del usuario que ha iniciado sesión
$('#form-profile').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiAccount + 'editProfile',
        type: 'post',
        data: new FormData($('#form-profile')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#modal-profile').modal('hide');
                sweetAlert(1, 'Perfil modificado correctamente', 'inicio.php');
            } else {
                sweetAlert(2, result.exception, null);
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

//Función para cambiar la contraseña del usuario que ha iniciado sesión
$('#form-password').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiAccount + 'password',
        type: 'post',
        data: $('#form-password').serialize(),
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#modal-password').modal('hide');
                sweetAlert(1, 'Contraseña cambiada correctamente', 'inicio.php');
            } else {
                sweetAlert(2, result.exception, null);
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


//Función para cambiar la contraseña del usuario que ha iniciado sesión en el menú responsive
$('#form-password1').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiAccount + 'password1',
        type: 'post',
        data: $('#form-password1').serialize(),
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#modal-password1').modal('hide');
                sweetAlert(1, 'Contraseña cambiada correctamente', 'inicio.php');
            } else {
                sweetAlert(2, result.exception, null);
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

//Función para mostrar el número de productos en inicio
function showCountProducts(){
    $.ajax({
        url: apiAccount + 'readDataProducts',
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
                let content_produtos = '';
                
                    content_produtos += `
                    <h2 class="number">${result.dataset.registros_produtos}</h2>
                    <span class="desc">Productos</span>
                    <div class="icon">
                        <i class="zmdi zmdi-shopping-basket"></i>
                    </div>
                    `;
                
                $('#data-productos').html(content_produtos);
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

//Función para mostrar el número de categorias en inicio
function showCountCategories(){
    $.ajax({
        url: apiAccount + 'readDataCategories',
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
                let content_categorias = '';
                
                content_categorias += `
                    <h2 class="number">${result.dataset.registros_categorias}</h2>
                    <span class="desc">Categorías</span>
                    <div class="icon">
                        <i class="zmdi zmdi-view-list"></i>
                    </div>
                    `;
                
                $('#data-categorias').html(content_categorias);
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

//Función para mostrar el número de usuarios en inicio
function showCountUsers(){
    $.ajax({
        url: apiAccount + 'readDataUsers',
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
                let content_usuarios = '';
                
                content_usuarios += `
                    <h2 class="number">${result.dataset.registros_usuarios}</h2>
                    <span class="desc">Usuarios</span>
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                    `;
                
                $('#data-usuarios').html(content_usuarios);
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

//Función para mostrar el número de empleados en inicio
function showCountEmployees(){
    $.ajax({
        url: apiAccount + 'readDataEmployees',
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
                let content_empleados = '';
                
                content_empleados += `
                    <h2 class="number">${result.dataset.registros_empleados}</h2>
                    <span class="desc">Empleados</span>
                    <div class="icon">
                        <i class="zmdi zmdi-accounts"></i>
                    </div>
                    `;
                $('#data-empleados').html(content_empleados);
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

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

$('#form-nueva-contrasena').submit(function()
{   event.preventDefault();
    var token = getParameterByName('token');
    var password1 = $('#nueva_contrasena').val(), password2 = $('#nueva_contrasena2').val();
    $.ajax({
        url: apiAccount + 'nuevaPassword',
        type: 'post',
        data: {
            token: token,
            nueva_contrasena: password1,
            nueva_contrasena2: password2
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const dataset = JSON.parse(response);
            //Se comprueba si la respuesta es satisfactoria, sino se muestra la excepción
            if (dataset.status == 1) {
                sweetAlert(1, 'Se ha restaurado la contraseña exitosamente', 'index.php');
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

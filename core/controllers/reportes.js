
//Inicializando la función para verificar que un usuario haya iniciado sesión
$(document).ready(function () {
    showSelectCategoria('id_categoria', 0);
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiSesion = '../core/api/usuarios.php?action=';
const apiCategorias = '../core/api/categorias.php?site=private&action=';
const apiPlatillos = '../core/api/platillos.php?site=private&action=';


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


function CategoriaClick1(id)
{
    let id_categoria = parseInt($('#id_categoria').val());

    $.ajax({
        url: apiCategorias + 'ventas_categoria1',
        type: 'post',
        data: {
            id_categoria:id
        },
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            console.log(id_categoria);
            
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    }); 
}
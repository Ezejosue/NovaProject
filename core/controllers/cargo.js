//Inicializando la función para mostrar la tabla de tipo de usuario
$(document).ready(function()
{
    showTable();
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const apiCargo = '../core/api/cargo.php?site=private&action=';

//Función para llenar tabla con los datos de los registros
function fillTable(rows) {
    let content = '';
    // Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        content += `
            <tr>
                <td>${row.id_cargo}</td>
                <td>${row.nombre_Cargo}</td>
                <td>
                    <a href="#" onclick="modalUpdate(${row.id_cargo})" class="btn btn-info   tooltipped" data-tooltip="Modificar"><i  class="fa fa-edit"></i></a>
                    <a href="#" onclick="confirmDelete(${row.id_cargo})"class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read').html(content);
    table('#tabla-cargo');
}

//Función para obtener y mostrar los registros disponibles
function showTable() {
    $.ajax({
            url: apiCargo + 'read',
            type: 'post',
            data: null,
            datatype: 'json'
        })
        .done(function (response) {
            //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                if (!result.status) {
                    sweetAlert(4, result.exception, null);
                }
                fillTable(result.dataset);
            } else {
                console.log(response);
            }
        })
        .fail(function (jqXHR) {
            //Se muestran en consola los posibles errores de la solicitud AJAX
            console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
        });
}


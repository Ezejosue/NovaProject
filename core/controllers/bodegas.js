//Inicializando la función para mostrar la tabla de unidad de mesas
$(document).ready(function()
{
    showTableBodega();
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const apiBodega = '../core/api/inventarios.php?site=private&action=';


function fillTableDetalleFactura(rows)
{
    let content = '';
    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comillas invertida para escapar los caracteres especiales
    rows.forEach(function(row){

        if (row.Cantidad == null) {
            content += `
            <tr>
                <td>${row.Materia}</td>
                <td>SIN EXISTENCIAS</td>
            </tr>
        `;
        } else {
            content += `
            <tr>
                <td>${row.Materia}</td>
                <td>${row.Cantidad}</td>
            </tr>
            `;
        }
        
    });

    $('#tbody-read').html(content);
    table('#tabla-bodega');
}

function showTableBodega()
{
    $.ajax({
        url: apiBodega + 'readBodega',
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
            fillTableDetalleFactura(result.dataset);
            console.log(result);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}


function error2(response)
{
    switch (response){
        case 'Dato duplicado, no se puede guardar':
            mensaje = 'Correlativo ya existe';
            break;
        case 'Registro ocupado, no se puede eliminar':
            mensaje = 'Tipo de usuario ocupado, no se puede eliminar'
            break;
        default:
            mensaje = 'Ocurrió un problema, consulte al administrador'
            break;
    }
    return mensaje;
}
$(document).ready(function()
{
    showTable();
    showMateriasPrimas('show_materias');
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiRecetas = '../core/api/recetas.php?site=private&action=';

//Función para llenar tabla con los datos de los registros
function fillTable(rows)
{
    let content = '';
    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        content += `
            <tr>
                <td>${row.nombre_receta}</td>
                <td>${row.tiempo}</td>
                <td>${row.elaboracion}</td>
                <td>
                    <a href="#" onclick="modalUpdate(${row.id_receta})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="confirmDelete(${row.id_receta})" class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read').html(content);
    table('#tabla-recetas');
}

//Función para obtener y mostrar los registros disponibles
function showTable()
{
    $.ajax({
        url: apiRecetas + 'read',
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
            fillTable(result.dataset);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función para cargar los tipos de categorias en el select del formulario
function showMateriasPrimas(idCheck)
{
    $.ajax({
        url: apiRecetas + 'readMateriaPrima',
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

                        content += 
                                `<label><input type="checkbox" name="materia" id="materia_prima" value="${row.idMateria}" required> ${row.nombre_materia} (${row.descripcion})</label>
                                <label><input id="cantidad" type="number" name="cantidad" class="validate form-control"
                                placeholder="Cantidad" max="100" min="1" disabled></label><br>`;

                });
                if ($("#materia_prima").on( 'change', function(){
                    if( $(this).is(':checked') ) {
                        // Hacer algo si el checkbox ha sido seleccionado
                        $("#cantidad").removeAttr("disabled");
                    } 

                }));
                $('#' + idCheck).html(content);
            } else {
                $('#' + idCheck).html('<label>NO EXISTEN MATERIAS PRIMAS</label>');
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



//Función para crear un nuevo registro
$('#form-create').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiRecetas + 'create',
        type: 'post',
        data: new FormData($('#form-create')[0]),
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
                $('#form-create')[0].reset();
                $('#modal-create').modal('hide');
                sweetAlert(1, 'Platillos creado correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-platillos');
                showTable();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            //Se comprueba que el alias no sea repetido
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

//Función para mostrar formulario con registro a modificar de platillos
function modalUpdate(id)
{
    $.ajax({
        url: apiRecetas + 'get',
        type: 'post',
        data:{
            id_platillo: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                $('#form-update')[0].reset();
                $('#id_platillo').val(result.dataset.id_platillo);
                $('#update_nombre_platillo').val(result.dataset.nombre_platillo);
                $('#update_precio').val(result.dataset.precio);
                showSelectCategoria('update_categoria', result.dataset.id_categoria);
                showSelectReceta('update_receta', result.dataset.id_receta);
                $('#update_estado').val(result.dataset.estado);
                $('#imagen').val(result.dataset.imagen);
                $('#modal-update').modal('show');
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

//Función para modificar un registro seleccionado previamente
$('#form-update').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiRecetas + 'update',
        type: 'post',
        data: new FormData($('#form-update')[0]),
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
                $('#modal-update').modal('hide');
                sweetAlert(1, 'Platillos modificada correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-platillos');
                showTable();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
            //Se comprueba que el alias no sea repetido
            sweetAlert(2, error2(response), null);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

//Función para eliminar un registro seleccionado
function confirmDelete(id)
{
    swal({
        title: 'Advertencia',
        text: '¿Quiere eliminar esta materia prima?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            $.ajax({
                url: apiRecetas + 'delete',
                type: 'post',
                data:{
                    id_platillo: id
                },
                datatype: 'json'
            })
            .done(function(response){
                //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        sweetAlert(1, 'Platillos eliminado correctamente', null);
                        destroy('#tabla-platillos');
                        showTable();
                    } else {
                        sweetAlert(2, result.exception, null);
                    }
                } else {
                    swal({
                        title: 'Advertencia',
                        text: 'Registro ocupado, no se puede borrar platillos.',
                        icon: 'error',
                        buttons: ['Aceptar'],
                        closeOnClickOutside: true,
                        closeOnEsc: true
                    })
                }
            })
            .fail(function(jqXHR){
                //Se muestran en consola los posibles errores de la solicitud AJAX
                console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
            });
        }
    });
}

//Función para verificar que nombre de la categoria no se repita ya que es un dato de tipo único
function error2(response){
    switch (response){
        case 'Dato duplicado, no se puede guardar':
            mensaje = 'Nombre de platillo ya existe';
            break;
        default:
            mensaje = 'Ocurrió un problema, consulte al administrador'
            break;
    }
    return mensaje;
}
//Inicializando la función para mostrar la tabla de recetas
$(document).ready(function()
{
    showTable();
    showSelectMaterias('id_materias', null);
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
                <td>
                    <a href="#" onclick="modalMateriasPrimas(${row.id_receta})" class="btn btn-dark tooltipped"><i class="fa fa-cart-plus"></i></a>
                    <a href="#" onclick="showTableRecetas(${row.id_receta})" class="btn btn-warning tooltipped"><i class="fa fa-concierge-bell"></i></a>
                    <a href="#" onclick="modalMateriasRecetas(${row.id_receta})" class="btn btn-primary tooltipped"><i class="fa fa-edit"></i></a>
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
                sweetAlert(1, 'Receta creada correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-recetas');
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

//Función para modificar un registro seleccionado previamente
$('#form-update-recetas').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiRecetas + 'update',
        type: 'post',
        data: new FormData($('#form-update-recetas')[0]),
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
                $('#modal-update-recetas').modal('hide');
                sweetAlert(1, 'Platillos modificada correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-recetas');
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

function showSelectMaterias(idSelect, value)
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
                if (!value) {
                    content += '<option value="" disabled selected>Seleccione una opción</option>';
                }
                result.dataset.forEach(function(row){
                    if (row.idMateria != value) {
                        content += `<option value="${row.idMateria}">${row.Materia}</option>`;
                    } else {
                        content += `<option value="${row.idMateria}" selected>${row.Materia}</option>`;
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

//Función para mostrar materias primas disponibles
function modalMateriasPrimas(id)
{
    $.ajax({
        url: apiRecetas + 'get',
        type: 'post',
        data:{
            id_receta: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                $('#form-materiasprimas')[0].reset();
                $('#id_receta_materia').val(result.dataset.id_receta);
                showSelectMaterias('id_materias', result.dataset.nombre_materia + result.dataset.descripcion);
                $('#modal-materiasprimas').modal('show');
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

//Función para agregar materias primas a una receta 
$('#form-materiasprimas').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiRecetas + 'createElaboracion',
        type: 'post',
        data: new FormData($('#form-materiasprimas')[0]),
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
                $('#modal-materiasprimas').modal('hide');
                sweetAlert(1, 'Materia prima agregada correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                destroy('#tabla-recetas');
                showTable();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            //Se comprueba que el alias no sea repetido
            sweetAlert(2, error2(response), null);
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

//Función para mostrar materias primas de las recetas disponibles
function modalMateriasRecetas(id)
{
    $.ajax({
        url: apiRecetas + 'get',
        type: 'post',
        data:{
            id_receta: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                $('#form-update-recetas')[0].reset();
                $('#modal-update-recetas').modal('show');
                $('#id_receta').val(result.dataset.id_receta);
                $('#update_nombre').val(result.dataset.nombre_receta);
                $('#update_tiempo').val(result.dataset.tiempo);
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


//Función para mostrar materias primas disponibles
function modalUpdateMaterias(id)
{
    $.ajax({
        url: apiRecetas + 'getElaboracion',
        type: 'post',
        data:{
            id_elaboracion: id
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                $('#form-update-materiasprimas')[0].reset();
                $('#id_receta_updatemate').val(result.dataset.id_receta);
                $('#id_elaboracion').val(result.dataset.id_elaboracion);
                showSelectMaterias('id_update_materia', result.dataset.idMateria);
                $('#cantidad_materia_update').val(result.dataset.cantidad);
                $('#modal-update-materiasprimas').modal('show');
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

$('#form-update-materiasprimas').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiRecetas + 'updateElaboracion',
        type: 'post',
        data: new FormData($('#form-update-materiasprimas')[0]),
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
                $('#modal-update-materiasprimas').modal('hide');
                sweetAlert(1, 'Materia prima modificada correctamente', null);
                //Se destruye la tabla de materias primas y se vuelve a crear para que muestre los cambios realizados
                $('#modal-update-recetas').modal('hide');
                showTableRecetas(idReceta);
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            //Se comprueba que el alias no sea repetido
            sweetAlert(2, error2(response), null);
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})

//Función para llenar tabla con los datos de los registros
function fillTableRecetas(rows)
{
    let content = '';
    //Se recorren las filas para armar el cuerpo de la tabla y se utiliza comilla invertida para escapar los caracteres especiales
    rows.forEach(function(row){
        content += `
            <tr>
                <td>${row.MateriaPrima}</td>
                <td>${row.cantidad}</td>
                <td>
                    <a href="#" onclick="modalUpdateMaterias(${row.id_elaboracion})" class="btn btn-info tooltipped" data-tooltip="Modificar"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="confirmDeleteMateria(${row.id_elaboracion})" class="btn btn-danger tooltipped" data-tooltip="Eliminar"><i class="fa fa-times"></i></a>
                </td>
            </tr>
        `;
    });
    $('#tbody-read-materias').html(content);
    table('#table-materias-recetas');
}
var idReceta;
//Función para obtener y mostrar los registros disponibles
function showTableRecetas(id)
{
    $('#tbody-read-materias').html('');
    idReceta = id;
    $.ajax({
        url: apiRecetas + 'readTableRecetas',
        type: 'post',
        data: {
            id_receta: id
        },
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
            $('#modal-show-receta').modal('show');
            fillTableRecetas(result.dataset);
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

//Función para eliminar un registro seleccionado
function confirmDeleteMateria(id)
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
                    idElaboracion: id
                },
                datatype: 'json'
            })
            .done(function(response){
                //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        sweetAlert(1, 'Materia prima eliminada correctamente', null);
                        showTableRecetas(idReceta);
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
    });
}

//Función para verificar que nombre de la categoría no se repita ya que es un dato de tipo único
function error2(response){
    switch (response){
        case 'Dato duplicado, no se puede guardar':
            mensaje = 'Nombre de receta ya existe';
            break;
        default:
            mensaje = 'Ocurrió un problema, consulte al administrador'
            break;
    }
    return mensaje;
}
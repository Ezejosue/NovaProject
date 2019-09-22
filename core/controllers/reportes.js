//Inicializando la función para verificar que un usuario haya iniciado sesión
$(document).ready(function () {
    showSelectCategoria('id_categoria', 0);
    showSelectCategoria('id_materia', 0);
})

//Constante para establecer la ruta y parámetros de comunicación con la API
const apiCategorias = '../core/api/categorias.php?site=private&action=';
const apiPlatillos = '../core/api/platillos.php?site=private&action=';
const apiDesperdicios = '../core/api/desperdicios.php?site=private&action=';


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

//Función para cargar las recetas en el select del formulario
function showSelectReceta(idSelect, value)
{
    $.ajax({
        url: apiDesperdicios + 'readReceta',
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
                    if (row.id_receta != value) {
                        content += `<option value="${row.id_receta}">${row.nombre_receta}</option>`;
                    } else {
                        content += `<option value="${row.id_receta}" selected>${row.nombre_receta}</option>`;
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

var winFeature = 'location=no,toolbar=no,menubar=no,scrollbars=yes,resizable=yes';

function CategoriasClick_1()
{
    window.open('../core/report/reporte6.php?id_categoria='+$('#id_categoria').val(),null,winFeature);
}

var fecha3;
var fecha4;
var fecha_string1;
var fecha_string5;
function pegarFecha1(){
    fecha3 = $('#fecha_pedido').val() + ' 00:00:00';
    fecha4 = $('#fecha_pedido').val() + ' 23:59:59';
    fecha_string1 = fecha3;
    fecha_string5 = fecha4;
    console.log(fecha_string1);
    console.log(fecha_string5);
    console.log(fecha3);
    console.log(fecha4);
    $('#fecha_escondida1').val(fecha_string1);
}

function CategoriasClick_2()
{
    window.open('../core/report/reporte7.php?fecha='+ fecha_string1,null,winFeature);
}

function CategoriasClick_3()
{
    window.open('../core/report/reporte8.php?categoria='+$('#id_materia').val(),null,winFeature);
}

var fecha;
var fecha2;
var fecha_string;
var fecha_string2;
function pegarFecha(){
    fecha = $('#fecha_desperdicio').val() + ' 00:00:00';
    fecha_string = fecha;
    fecha2 = $('#fecha_desperdicio_final').val() + ' 23:59:59';
    fecha_string2 = fecha2;
    console.log(fecha);
    console.log(fecha2);
    $('#fecha_escondida').val(fecha_string);
    $('#fecha_escondida2').val(fecha_string2);
}

function CategoriasClick_4()
{
    window.open('../core/report/reporte9.php?fecha='+fecha_string+'&fecha2='+fecha_string2 ,null,winFeature);
}

function CategoriasClick_5()
{
    window.open('../core/report/reporte10.php?idMes='+$('#idMes').val(),null,winFeature);
}
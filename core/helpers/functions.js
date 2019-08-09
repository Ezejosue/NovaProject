//Función para comprobar si una cadena tiene formato JSON
function isJSONString(string) {
    try {
        if (string != "[]") {
            JSON.parse(string);
            return true;
        } else {
            return false;
        }
    } catch (error) {
        return false;
    }
}

//Función para manejar los mensajes de notificación al usuario
function sweetAlert(type, text, url) {
    switch (type) {
        case 1:
            title = "Éxito";
            icon = "success";
            break;
        case 2:
            title = "Error";
            icon = "error";
            break;
        case 3:
            title = "Advertencia";
            icon = "warning";
            break;
        case 4:
            title = "Aviso";
            icon = "info";
    }
    if (url) {
        swal({
                title: title,
                text: text,
                icon: icon,
                button: 'Aceptar',
                closeOnClickOutside: false,
                closeOnEsc: false
            })
            .then(function (value) {
                location.href = url
            });
    } else {
        swal({
            title: title,
            text: text,
            icon: icon,
            button: 'Aceptar',
            closeOnClickOutside: false,
            closeOnEsc: false
        });
    }
}

//funcion que se llena con los parametros que se obtienen en index.js 
function grafico_existencia_categoria(canvas, xAxis, yAxis, legend, title) { //ramdon para la obtención de colores al azar
    let colors = [];
    for (i = 0; i < xAxis.length; i++) {
        colors.push('#' + (Math.random().toString(16).substring(2, 8)));
    }
    //se especifica el id de la vista
    const context = $("#" + canvas);
    const MyPieChart = new Chart(context, {
        //se especifica el tipo de grafica que se va a utilizar
        type: 'bar',
        data: {
            //se especifica los nombres con los que se trabajaran
            labels: xAxis,
            datasets: [{
                label: legend,
                //se especifica los valores de la grafica
                data: yAxis,
                backgroundColor: colors,
                borderColor: '#000000',
                borderWith: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 5
                    }
                }]
            }
        }
    });
}

//funcion que se llena con los parametros que se obtienen en index.js 
function grafica_venta_platillos_mayor(canvas, xAxis, yAxis, legend, title) {
    //ramdon para la obtención de colores al azar
    let colors = [];
    for (i = 0; i < xAxis.length; i++) {
        colors.push('#' + (Math.random().toString(16).substring(2, 8)));
    }
    //se especifica el id de la vista
    const context = $("#" + canvas);
    const MyPieChart = new Chart(context, {
        //se especifica el tipo de grafica que se va a utilizar
        type: 'pie',
        data: {
            //se especifica los nombres con los que se trabajaran
            labels: xAxis,
            datasets: [{
                label: legend,
                //se especifica los valores de la grafica
                data: yAxis,
                backgroundColor: colors,
                borderColor: '#000000',
                borderWith: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: "right"
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 5
                    }
                }]
            }
        }
    });
}


//funcion que se llena con los parametros que se obtienen en index.js 
function grafica_venta_platillos_menores(canvas, xAxis, yAxis, legend, title) {
    //ramdon para la obtención de colores al azar
    let colors = [];
    for (i = 0; i < xAxis.length; i++) {
        colors.push('#' + (Math.random().toString(16).substring(2, 8)));
    }
    //se especifica el id de la vista
    const context = $("#" + canvas);
    const MyPieChart = new Chart(context, {
        //se especifica el tipo de grafica que se va a utilizar
        type: 'doughnut',
        data: {
            //se especifica los nombres con los que se trabajaran
            labels: xAxis,
            datasets: [{
                label: legend,
                //se especifica los valores de la grafica
                data: yAxis,
                backgroundColor: colors,
                borderColor: '#000000',
                borderWith: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: "right"
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 5
                    }
                }]
            }
        }
    });
}


//funcion que se llena con los parametros que se obtienen en index.js 
function grafica_platillos_caros(canvas, xAxis, yAxis, legend, title) {
    //ramdon para la obtención de colores al azar
    let colors = [];
    for (i = 0; i < xAxis.length; i++) {
        colors.push('#' + (Math.random().toString(16).substring(2, 8)));
    }
    //se especifica el id de la vista
    const context = $("#" + canvas);
    const MyPieChart = new Chart(context, {
        type: 'line',
        data: {
            //se especifica los nombres con los que se trabajaran
            labels: xAxis,
            datasets: [{
                label: legend,
                //se especifica los valores de la grafica
                data: yAxis,
                borderColor: 'black',
                borderWith: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 5
                    }
                }]
            }
        }
    });
}

//funcion que se llena con los parametros que se obtienen en index.js 
function grafica_platillos_baratos(canvas, xAxis, yAxis, legend, title) {
    //ramdon para la obtención de colores al azar
    let colors = [];
    for (i = 0; i < xAxis.length; i++) {
        colors.push('#' + (Math.random().toString(16).substring(2, 8)));
    }
    //se especifica el id de la vista
    const context = $("#" + canvas);
    const MyPieChart = new Chart(context, {
        //se especifica los nombres con los que se trabajaran
        type: 'polarArea',
        data: {
            //se especifica los nombres con los que se trabajaran
            labels: xAxis,
            datasets: [{
                label: legend,
                //se especifica los valores de la grafica
                data: yAxis,
                backgroundColor: colors,
                borderColor: '#000000',
                borderWith: 1
            }]
        },
        options: {
            legend: {
                display: true,
                position: "right"
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 5
                    }
                }]
            }
        }
    });
}



//funcion que se llena con los parametros que se obtienen en index.js 
function grafica_ventas_categoria(canvas, xAxis, yAxis, legend, title) {
    let colors = [];
    for (i = 0; i < xAxis.length; i++) {
        colors.push('#' + (Math.random().toString(16).substring(2, 8)));
    }
    //se especifica el id de la vista
    const context = $("#" + canvas);
    const MyPieChart = new Chart(context, {
        //se especifica el tipo de grafica que se va a utilizar
        type: 'bar',
        data: {
            //se especifica los nombres con los que se trabajaran
            labels: xAxis,
            datasets: [{
                label: legend,
                //se especifica los valores de la grafica
                data: yAxis,
                backgroundColor: colors,
                borderColor: '#000000',
                borderWith: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        stepSize: 100
                    }
                }]
            }
        }
    });
}

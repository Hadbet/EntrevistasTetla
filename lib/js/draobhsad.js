

window.onload = function () {

    var boton = document.getElementById("verificar");

    boton.addEventListener('click', function () {

        var fechaInicio = document.getElementById("txtFechaInicio");
        var fechaFinal = document.getElementById("txtFechaFin");

        contadorApu(fechaInicio.value,fechaFinal.value);

        document.getElementById("apusSeccion").style.display='block';

        document.getElementById("seccionShift").style.display = 'none';
        document.getElementById("seccionEncargado").style.display = 'none';
        document.getElementById("seccionTipo").style.display = 'none';
        document.getElementById("seccionNomina").style.display = 'none';
        document.getElementById("seccionSupervisor").style.display = 'none';

    });

};

function toggleMenu() {
    var menu = document.getElementById("menuNavegacion");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

function contadorApu(fechaInicio,fechaFin) {
    return new Promise(function (resolve) {
        $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/contadores.php?ruta=' + 1+'&fechaInicio='+fechaInicio+'&fechaFinal='+fechaFin, function (data) {
            if (data && data.data && data.data.length > 0) {
                for (var i = 0; i < data.data.length; i++) {

                    if (data.data[i].Encargado === "APU 1"){
                        document.getElementById("txtApu1").innerHTML = data.data[i].contador;
                    }

                    if (data.data[i].Encargado === "APU 2"){
                        document.getElementById("txtApu2").innerHTML = data.data[i].contador;
                    }

                    if (data.data[i].Encargado === "APU 3"){
                        document.getElementById("txtApu3").innerHTML = data.data[i].contador;
                    }

                }
            } else {

            }
        });
    });
}
function contadorGrafica(apu,fechaInicio,fechaFinal) {
    return new Promise(function (resolve) {
        $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/contadores.php?ruta=' + 2 +'&APU='+apu+'&fechaInicio='+fechaInicio+'&fechaFinal='+fechaFinal, function (data) {
            if (data && data.data && data.data.length > 0) {
                var labels = [];
                var dataValues = [];

                for (var i = 0; i < data.data.length; i++) {
                    labels.push(data.data[i].ShiftLeader);
                    dataValues.push(data.data[i].contador);
                }

                // Llama a la función para inicializar o actualizar el gráfico
                actualizarGrafico(labels, dataValues, 'myChart3');

                resolve();  // Resuelve la promesa después de completar la operación
            } else {
                // Puedes manejar el caso en que no haya datos si es necesario
                resolve();
            }
        });
    });
}

function actualizarGrafico(labels, dataValues, chartId) {
    const ctx = document.getElementById(chartId);

    // Verifica si ya hay un gráfico existente y destrúyelo antes de crear uno nuevo
    var existingChart = window[chartId + '_chart'];
    if (existingChart instanceof Chart) {
        existingChart.destroy();
    }

    // Asigna una nueva variable de gráfico específica para este chartId
    window[chartId + '_chart'] = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ausentismos',
                data: dataValues,
                borderWidth: 1
            }]
        },
        options: {
            scales: {}
        }
    });
}


// Contador Grafica 2

function contadorGraficaDos(apu,fechaInicio,fechaFinal) {
    return new Promise(function (resolve) {
        $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/contadores.php?ruta=' + 3 +'&APU='+apu+'&fechaInicio='+fechaInicio+'&fechaFinal='+fechaFinal, function (data) {
            if (data && data.data && data.data.length > 0) {
                var labels = [];
                var dataValues = [];

                for (var i = 0; i < data.data.length; i++) {
                    labels.push(data.data[i].TipoAusencia);
                    dataValues.push(data.data[i].contador);
                }

                // Llama a la función para inicializar o actualizar el gráfico
                actualizarGraficoDos(labels, dataValues, 'myChart2');

                resolve();  // Resuelve la promesa después de completar la operación
            } else {
                // Puedes manejar el caso en que no haya datos si es necesario
                resolve();
            }
        });
    });
}

function actualizarGraficoDos(labels, dataValues, chartId) {
    const ctx2 = document.getElementById(chartId);

    // Verifica si ya hay un gráfico existente y destrúyelo antes de crear uno nuevo
    var existingChart = window[chartId + '_chart'];
    if (existingChart instanceof Chart) {
        existingChart.destroy();
    }

    var coloresPersonalizados = ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', /* ... otros colores */];

    // Asigna una nueva variable de gráfico específica para este chartId
    window[chartId + '_chart'] = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ausentismos',
                data: dataValues,
                backgroundColor: coloresPersonalizados,
                borderWidth: 1
            }]
        },
        options: {
            scales: {}
        }
    });
}

// Llama a la función contadorGraficaDos para obtener los datos y actualizar el gráfico


// Contador Grafica 3

function contadorGraficaTres(apu,fechaInicio,fechaFinal) {
    return new Promise(function (resolve) {
        $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/contadores.php?ruta=' + 4+'&APU='+apu+'&fechaInicio='+fechaInicio+'&fechaFinal='+fechaFinal, function (data) {
            if (data && data.data && data.data.length > 0) {
                var labels = [];
                var dataValues = [];

                for (var i = 0; i < data.data.length; i++) {
                    labels.push(data.data[i].Area);
                    dataValues.push(data.data[i].contador);
                }

                actualizarGraficoTres(labels, dataValues, 'myChart');

                resolve();  // Resuelve la promesa después de completar la operación
            } else {
                // Puedes manejar el caso en que no haya datos si es necesario
                resolve();
            }
        });
    });
}

function actualizarGraficoTres(labels, dataValues, chartId) {
    const ctx3 = document.getElementById(chartId);

    // Verifica si ya hay un gráfico existente y destrúyelo antes de crear uno nuevo
    var existingChart = window[chartId + '_chart'];
    if (existingChart instanceof Chart) {
        existingChart.destroy();
    }

    var coloresPersonalizados = ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', /* ... otros colores */];

    // Asigna una nueva variable de gráfico específica para este chartId
    window[chartId + '_chart'] = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ausentismos',
                data: dataValues,
                backgroundColor: coloresPersonalizados,
                borderWidth: 1
            }]
        },
        options: {
            scales: {}
        }
    });
}

// Contador Grafica 3

function contadorGraficaCuatro(apu,fechaInicio,fechaFinal) {
    return new Promise(function (resolve) {
        $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/contadores.php?ruta=' + 5+'&APU='+apu+'&fechaInicio='+fechaInicio+'&fechaFinal='+fechaFinal, function (data) {
            if (data && data.data && data.data.length > 0) {
                var labels = [];
                var dataValues = [];

                for (var i = 0; i < data.data.length; i++) {
                    labels.push(data.data[i].NominaEntrevistado);
                    dataValues.push(data.data[i].contador);
                }

                // Llama a la función para inicializar o actualizar el gráfico
                actualizarGraficoCuatro(labels, dataValues, 'myChart4');

                resolve();  // Resuelve la promesa después de completar la operación
            } else {
                // Puedes manejar el caso en que no haya datos si es necesario
                resolve();
            }
        });
    });
}

function actualizarGraficoCuatro(labels, dataValues, chartId) {
    const ctx3 = document.getElementById(chartId);

    // Verifica si ya hay un gráfico existente y destrúyelo antes de crear uno nuevo
    var existingChart = window[chartId + '_chart'];
    if (existingChart instanceof Chart) {
        existingChart.destroy();
    }

    var coloresPersonalizados = ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', /* ... otros colores */];

    // Asigna una nueva variable de gráfico específica para este chartId
    window[chartId + '_chart'] = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ausentismos',
                data: dataValues,
                backgroundColor: coloresPersonalizados,
                borderWidth: 1
            }]
        },
        options: {
            scales: {}
        }
    });
}

// Contador Grafica 4

function contadorGraficaCinco(apu,fechaInicio,fechaFinal) {
    return new Promise(function (resolve) {
        console.log('https://arketipo.mx/RH/Entrevistas/dao/contadores.php?ruta=' + 7+'&APU='+apu+'&fechaInicio='+fechaInicio+'&fechaFinal='+fechaFinal);
        $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/contadores.php?ruta=' + 7+'&APU='+apu+'&fechaInicio='+fechaInicio+'&fechaFinal='+fechaFinal, function (data) {
            if (data && data.data && data.data.length > 0) {
                var labels = [];
                var dataValues = [];

                for (var i = 0; i < data.data.length; i++) {
                    labels.push(data.data[i].Supervisor);
                    dataValues.push(data.data[i].contador);
                }

                // Llama a la función para inicializar o actualizar el gráfico
                actualizarGraficoCinco(labels, dataValues, 'myChart5');

                resolve();  // Resuelve la promesa después de completar la operación
            } else {
                // Puedes manejar el caso en que no haya datos si es necesario
                resolve();
            }
        });
    });
}

function actualizarGraficoCinco(labels, dataValues, chartId) {
    const ctx3 = document.getElementById(chartId);

    // Verifica si ya hay un gráfico existente y destrúyelo antes de crear uno nuevo
    var existingChart = window[chartId + '_chart'];
    if (existingChart instanceof Chart) {
        existingChart.destroy();
    }

    var coloresPersonalizados = ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', /* ... otros colores */];

    // Asigna una nueva variable de gráfico específica para este chartId
    window[chartId + '_chart'] = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ausentismos',
                data: dataValues,
                backgroundColor: coloresPersonalizados,
                borderWidth: 1
            }]
        },
        options: {
            scales: {}
        }
    });
}

function apuGraficas(apu) {

    document.getElementById("seccionShift").style.display = 'block';
    document.getElementById("seccionEncargado").style.display = 'block';
    document.getElementById("seccionTipo").style.display = 'block';
    document.getElementById("seccionNomina").style.display = 'block';
    document.getElementById("seccionSupervisor").style.display = 'block';

    var fechaInicio = document.getElementById("txtFechaInicio").value;
    var fechaFinal = document.getElementById("txtFechaFin").value;

    switch (apu) {
        case 1:
            contadorGraficaCinco(apu,fechaInicio,fechaFinal)
            contadorGraficaCuatro(apu,fechaInicio,fechaFinal);
            contadorGraficaTres(apu,fechaInicio,fechaFinal);
            contadorGraficaDos(apu,fechaInicio,fechaFinal);
            contadorGrafica(apu,fechaInicio,fechaFinal);
            break;
        case 2:
            contadorGraficaCinco(apu,fechaInicio,fechaFinal)
            contadorGraficaCuatro(apu,fechaInicio,fechaFinal);
            contadorGraficaTres(apu,fechaInicio,fechaFinal);
            contadorGraficaDos(apu,fechaInicio,fechaFinal);
            contadorGrafica(apu,fechaInicio,fechaFinal);
            break;
        case 3:
            contadorGraficaCinco(apu,fechaInicio,fechaFinal)
            contadorGraficaCuatro(apu,fechaInicio,fechaFinal);
            contadorGraficaTres(apu,fechaInicio,fechaFinal);
            contadorGraficaDos(apu,fechaInicio,fechaFinal);
            contadorGrafica(apu,fechaInicio,fechaFinal);
            break;
        default:
            console.log("Ejecutando código para otro valor de apu");
    }
}

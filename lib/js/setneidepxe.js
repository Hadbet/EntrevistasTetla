
function toggleMenu() {
    var menu = document.getElementById("menuNavegacion");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

function inicializarTabla(nomina) {
    document.getElementById("tablaSeccion").style.display='block';
    $('#miTabla').DataTable({
        ajax: {
            url: 'https://arketipo.mx/RH/Entrevistas/dao/daoExpedienteUsuario.php?nomina=' + nomina,
            dataSrc: 'data'
        },
        columns: [
            {data: 'NominaEntrevistador'},
            {data: 'FechaAusentismo'},
            {data: 'TipoAusencia'},
            {data: 'Motivo'},
            {data: 'Area'},
            {data: 'ShiftLeader'}
        ]
    });
}


window.onload = function () {
    var boton = document.getElementById("verificar");
    var seccionUno = document.getElementById("seccion1");
    var seccionDos = document.getElementById("seccion2");

    boton.addEventListener('click', function () {
        seccionUno.style.opacity = '0';
        seccionDos.style.opacity = '1';

        verificarNombre().then(function (esValido) {
            if (esValido) {
                setTimeout(function () {
                    seccionUno.style.display = 'none';
                    seccionDos.style.display = 'block';
                }, 500);
            }
        });
    });
};

function verificarNombre() {
    return new Promise(function (resolve) {
        var txtNomina = document.getElementById("txtNomina");
        var nominaAux;

        if (txtNomina.value.trim() === "") {
            alert("Por favor, ingresa una nómina válida.");
            resolve(false);
        } else {
            nominaAux = llenarNomina(txtNomina.value);
            $.getJSON('https://arketipo.mx/GrammerApp/inicio/DaoUsuario.php?usuario=' + nominaAux, function (data) {
                if (data && data.data && data.data.length > 0) {

                    document.getElementById('txtNombre').innerHTML = data.data[0].NomUser;
                    document.getElementById('txtNombreCentroCostos').innerHTML = data.data[0].NombreCC;
                    document.getElementById('txtCentroCostos').innerHTML = data.data[0].IdCentroCostos;
                    document.getElementById('txtNumeroTag').innerHTML = data.data[0].IdTag;
                    document.getElementById('txtWorkCenter').innerHTML = data.data[0].WC;
                    document.getElementById('txtNombreWorkCenter').innerHTML = data.data[0].NombreWC;
                    document.getElementById('txtNumeroNomina').innerHTML = data.data[0].IdUser;
                    tag = data.data[0].IdTag;
                    orden(nominaAux);
                    ordenTag(tag);
                    resolve(true);
                    contadorGrafica(nominaAux);
                    inicializarTabla(nominaAux);
                } else {

                }

            });
        }
    });
}


function orden(nominaAux) {
    $.getJSON('https://arketipo.mx/GrammerApp/inicio/DaoVacaciones.php?usuario=' + nominaAux, function (data) {
        document.getElementById('txtVacaciones').innerHTML = data.data[0].DiasVacaciones;

        var fechaAux = data.data[0].FechaIngreso;
        let divicionFecha = fechaAux.split('-');
        ano = divicionFecha[0];
        mes = divicionFecha[1];
        dia = divicionFecha[2];

        if (mes == '01') {
            mes = 'enero';
        }
        if (mes == '02') {
            mes = 'febrero';
        }
        if (mes == '03') {
            mes = 'marzo';
        }
        if (mes == '04') {
            mes = 'abril';
        }
        if (mes == '05') {
            mes = 'mayo';
        }
        if (mes == '06') {
            mes = 'junio';
        }
        if (mes == '07') {
            mes = 'julio';
        }
        if (mes == '08') {
            mes = 'agosto';
        }
        if (mes == '09') {
            mes = 'septiembre';
        }
        if (mes == '10') {
            mes = 'octubre';
        }
        if (mes == '11') {
            mes = 'noviembre';
        }
        if (mes == '12') {
            mes = 'diciembre';
        }

        document.getElementById('txtFechaAntiguedad').innerHTML = dia + " de " + mes + " del " + ano;
    });

    $.getJSON('https://arketipo.mx/GrammerApp/inicio/kaizen.php?usuario=' + nominaAux, function (data) {

        document.getElementById('txtPuntosKaizen').innerHTML = data.data[0].Puntos;
    });
}

function ordenTag(tag) {

    $.getJSON('https://arketipo.mx/GrammerApp/inicio/DaoCajaAhorro.php?usuario=' + tag, function (data) {
        document.getElementById('txtCajaAhorro').innerHTML = data.data[0].AhorroTotal;
        document.getElementById('txtPendientePrestamo').innerHTML = data.data[0].PendientePrestamo;
        document.getElementById('txtFondoAhorro').innerHTML = data.data[0].FondoAhorro;

    });


}

function contadorGrafica(nomina) {
    return new Promise(function (resolve) {
        console.log('https://arketipo.mx/RH/Entrevistas/dao/contadores.php?ruta=' + 6 + '&APU=' + nomina)
        $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/contadores.php?ruta=' + 6 + '&APU=' + nomina, function (data) {
            if (data && data.data && data.data.length > 0) {
                var labels = [];
                var dataValues = [];

                for (var i = 0; i < data.data.length; i++) {
                    labels.push(data.data[i].FechaAusentismo);
                    dataValues.push(data.data[i].contador);
                }

                // Llama a la función para inicializar o actualizar el gráfico
                actualizarGrafico(labels, dataValues, 'myChart');

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
                label: 'ShiftLeader',
                data: dataValues,
                borderWidth: 1
            }]
        },
        options: {
            scales: {}
        }
    });
}

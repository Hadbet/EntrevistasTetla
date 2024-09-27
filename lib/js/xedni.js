


function toggleMenu() {
    var menu = document.getElementById("menuNavegacion");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

llenarAPU();

function llenarAPU() {
    $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/daoApu.php', function (data) {
        var select = document.getElementById("cbEncargado");
        for (var i = 0; i < data.data.length; i++) {
            var createOption = document.createElement("option");
            createOption.text = data.data[i].Nombre;
            createOption.value = data.data[i].Puesto;
            select.appendChild(createOption);
        }
    });
}

function llenarSuper() {
    $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/daoSupervisor.php?APU=' + document.getElementById("cbEncargado").value, function (data) {
        var selectS = document.getElementById("cbSupervisor");
        selectS.innerHTML = "";

        var selectA = document.getElementById("cbShiftLeader");
        selectA.innerHTML = "";


        var createOptionDef = document.createElement("option");
        createOptionDef.text = "Seleccione";
        createOptionDef.value = "";
        selectS.appendChild(createOptionDef);

        for (var i = 0; i < data.data.length; i++) {
            var createOptionS = document.createElement("option");
            createOptionS.text = data.data[i].Supervisor;
            createOptionS.value = data.data[i].Supervisor;
            selectS.appendChild(createOptionS);
        }
    });
}

function llenarShift() {
    $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/daoShiftLeader.php?APU=' + document.getElementById("cbSupervisor").value, function (data) {
        var selectS = document.getElementById("cbShiftLeader");
        selectS.innerHTML = "";

        var createOptionDefS = document.createElement("option");
        createOptionDefS.text = "Seleccione";
        createOptionDefS.value = "";
        selectS.appendChild(createOptionDefS);

        for (var i = 0; i < data.data.length; i++) {
            var createOptionS = document.createElement("option");
            createOptionS.text = data.data[i].ShiftLeader;
            createOptionS.value = data.data[i].ShiftLeader;
            selectS.appendChild(createOptionS);
        }
    });
}

var numeroTag, area, nomina, banderaTipo;

function mostrarSeccionTipo() {
    var cbTipoAusentismo = document.getElementById("cbTipoAusentismo");
    var seccionTipo = document.getElementById("seccionTipo");

    if (cbTipoAusentismo.value === "Otro") {
        seccionTipo.style.display = 'block';
        banderaTipo = true;
    } else {
        seccionTipo.style.display = 'none';
        banderaTipo = false;
    }
}

window.onload = function () {
    var boton = document.getElementById("verificar");
    var seccionUno = document.getElementById("seccion1");
    var seccionDos = document.getElementById("seccion2");
    var botonGuardar = document.getElementById("btnEnviar");
    var botonResetear = document.getElementById("btnReset");

    boton.addEventListener('click', function () {
        seccionUno.style.opacity = '0';
        seccionDos.style.opacity = '1';

        verificarNombre().then(function (esValido) {
            if (esValido) {
                setTimeout(function () {
                    seccionUno.style.display = 'none';
                    seccionDos.style.display = 'block';
                }, 500);
                historicoUsuario();
            }
        });
    });

    botonGuardar.addEventListener('click', function () {
        enviar();
    });

    botonResetear.addEventListener('click', function () {
        window.onload();
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
            $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/daoVerificarUsuario.php?nomina=' + nominaAux, function (data) {
                if (data && data.data && data.data.length > 0) {
                    nomina = nominaAux;
                    document.getElementById("nombreEntrevistado").innerHTML = data.data[0].NomUser;
                    numeroTag = data.data[0].IdTag;
                    area = data.data[0].NombreWC + " ";
                    resolve(true);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...', showConfirmButton: false, input: 'none',
                        text: 'El correo ingresado del encargado es incorrecto no pertenece al dominio de grammer "@grammer.com"'
                    })
                    resolve(false);
                }
            });
        }
    });
}

function historicoUsuario() {
    var historicosReport = document.getElementById("historico");
    return new Promise(function (resolve) {
        $.getJSON('https://arketipo.mx/RH/Entrevistas/dao/daoExpedienteUsuario.php?nomina=' + nomina, function (data) {
            if (data && data.data && data.data.length > 0) {
                for (var i = 0; i < data.data.length; i++) {
                    historicosReport.innerHTML += "<p><strong>" + data.data[i].FechaAusentismo + "</strong> : " + data.data[i].TipoAusencia + ".</p>";
                }
            } else {
                document.getElementById("seccionHistorico").style.display = "none";
            }
        });
    });
}
function enviar() {

    var fechaAusencia = document.getElementById('txtFechaAusencia');
    var tipoAusentismo = document.getElementById('cbTipoAusentismo');
    var encargado = document.getElementById('cbEncargado');
    var motivo = document.getElementById('txtMotivo');

    var tag = document.getElementById("txtTag");
    var tipoOtro = document.getElementById("txtTipo");
    var shiftleader = document.getElementById("cbShiftLeader");
    var supervisor = document.getElementById("cbSupervisor");

    if (tag.value == numeroTag || tag.value == "9999") {
        if (nomina != "") {
            if (area != "") {
                if (fechaAusencia.value != "") {
                    if (tipoAusentismo.value != "") {
                        if (encargado.value != "") {
                            if (motivo.value != "") {
                                if (nominaEntrevistador.value != "") {
                                    if (supervisor.value != "") {

                                        /*
                                    document.getElementById('first').style.display = 'none';
                                    document.getElementById('carga').style.display = 'block';
                                    document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

                                     */
                                        const data = new FormData();

                                        data.append('nomina', nomina.trim());
                                        data.append('area', area.trim());
                                        data.append('fechaAusencia', fechaAusencia.value);

                                        if (banderaTipo) {
                                            data.append('tipoAusentismo', tipoOtro.value);
                                        } else {
                                            data.append('tipoAusentismo', tipoAusentismo.value);
                                        }

                                        data.append('encargado', encargado.value);
                                        data.append('motivo', motivo.value.replace(/["'\\\/]/g, ''));
                                        data.append('nominaEntrevistador', nominaEntrevistador);
                                        data.append('shiftLeader', shiftleader.value);
                                        data.append('supervisor', supervisor.value);
                                        data.append('tag', tag.value);

                                        fetch('dao/daoGuardarEntrevista.php', {
                                            method: 'POST',
                                            body: data
                                        })
                                            .then(function (response) {
                                                if (response.ok) {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Enviado.', showConfirmButton: false, input: 'none',
                                                        text: 'Registro enviardo.'
                                                    })
                                                    location.reload();
                                                } else {
                                                    throw "Error en la llamada Ajax";
                                                }

                                            })
                                            .then(function (texto) {
                                                console.log(texto);
                                            })
                                            .catch(function (err) {
                                                console.log(err);
                                            });
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...', showConfirmButton: false, input: 'none',
                                            text: 'Selecciones supervisor'
                                        })
                                    }
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...', showConfirmButton: false, input: 'none',
                                        text: 'Ingrese la nómina del entrevistador'
                                    })
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...', showConfirmButton: false, input: 'none',
                                    text: 'Ingrese el motivo'
                                })
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...', showConfirmButton: false, input: 'none',
                                text: 'Ingrese el encargado'
                            })
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...', showConfirmButton: false, input: 'none',
                            text: 'Ingrese el tipo de ausentismo'
                        })
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...', showConfirmButton: false, input: 'none',
                        text: 'Ingrese la fecha'
                    })
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...', showConfirmButton: false, input: 'none',
                    text: 'Ingrese la área'
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...', showConfirmButton: false, input: 'none',
                text: 'Ingrese la nómina'
            })
        }
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...', showConfirmButton: false, input: 'none',
            text: 'El número de tag no corresponde con la nomina ingresada.'
        })
    }
}


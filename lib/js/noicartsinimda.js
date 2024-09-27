

function toggleMenu() {
    var menu = document.getElementById("menuNavegacion");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}

function llenarParametros(id, apu, supervisor, shift) {
    document.getElementById("txtIdEncargados").value = id;
    document.getElementById("txtSupervisorEncargados").value = supervisor;
    document.getElementById("txtShiftLeaderEncargados").value = shift;
    document.getElementById("cbApuEncargados").value = apu;
    var elementoSuperior = document.getElementById("seccionEncargado");

    // Utiliza scrollIntoView para desplazar la vista hacia arriba
    elementoSuperior.scrollIntoView({behavior: "smooth"});
}

function llenarParametrosUsu(nomina, nombre, apu, puesto, rol, password) {
    document.getElementById("txtNomina").value = nomina;
    document.getElementById("txtNombre").value = nombre;
    document.getElementById("cbEncargado").value = apu;
    document.getElementById("cbPuesto").value = puesto;
    document.getElementById("txtPassword").value = password;
    document.getElementById("cbRol").value = rol;

    var elementoSuperior = document.getElementById("seccion1");

    // Utiliza scrollIntoView para desplazar la vista hacia arriba
    elementoSuperior.scrollIntoView({behavior: "smooth"});
}

function inicializarTabla() {
    $('#miTabla').DataTable({
        ajax: {
            url: 'https://arketipo.mx/RH/Entrevistas/dao/daoUsuarios.php',
            dataSrc: 'data'
        },
        columns: [
            {data: 'IdNomina'},
            {data: 'Nombre'},
            {data: 'APU'},
            {data: 'Puesto'},
            {data: 'Rol'},
            {data: 'Password'},
            {data: 'boton'}
        ]
    });
}

function inicializarTablaDos() {
    $('#miTablaDos').DataTable({
        ajax: {
            url: 'https://arketipo.mx/RH/Entrevistas/dao/daoEcargados.php',
            dataSrc: 'data'
        },
        columns: [
            {data: 'IdEncargado'},
            {data: 'APU'},
            {data: 'Supervisor'},
            {data: 'ShiftLeader'},
            {data: 'boton'}
        ]
    });
}

// Llama a la función al cargar la página
$(document).ready(function () {
    inicializarTabla();
    inicializarTablaDos();
});

// Ejemplo de cómo podrías llamar a la función para actualizar la tabla
function actualizarTabla() {
    // Destruye la tabla actual antes de volver a inicializarla
    $('#miTabla').DataTable().destroy();
    inicializarTabla();
}

function actualizarTablaDos() {
    // Destruye la tabla actual antes de volver a inicializarla
    $('#miTablaDos').DataTable().destroy();
    inicializarTablaDos();
}

$('#verificar').on('click', function () {
    enviar();
    actualizarTabla();
});

$('#verificarDos').on('click', function () {
    enviarEncargado()
    actualizarTablaDos();
});

$('#eliminarDos').on('click', function () {
    eliminarEncargado();
    actualizarTablaDos();
});


$('#eliminarUsu').on('click', function () {
    eliminarUsuario();
    actualizarTabla();
});

$('#reset').on('click', function () {
    limpiar();
});


function enviar() {

    var nomina = document.getElementById('txtNomina');
    var nombre = document.getElementById('txtNombre');
    var apu = document.getElementById('cbEncargado');
    var puesto = document.getElementById('cbPuesto');
    var password = document.getElementById('txtPassword');
    var rol = document.getElementById("cbRol");

    if (nomina.value.trim() !== '') {
        if (nombre.value.trim() !== '') {
            if (apu.value.trim() !== '') {
                if (puesto.value.trim() !== '') {
                    if (password.value.trim() !== '') {
                        if (rol.value.trim() !== '') {
                            /*
                            document.getElementById('first').style.display = 'none';
                            document.getElementById('carga').style.display = 'block';
                            document.getElementById('carga').innerHTML = '<div class="loading"><center><img src="images/carga.gif" height="350px"><br/>Un momento, por favor...</center></div>';

                             */
                            const data = new FormData();
                            console.log(nomina.value.trim().padStart(8, '0'));
                            data.append('nomina', nomina.value.trim().padStart(8, '0'));
                            data.append('nombre', nombre.value.trim());
                            data.append('apu', apu.value.trim());
                            data.append('Puesto', puesto.value.trim());
                            data.append('Password', password.value.trim());
                            data.append('Rol', rol.value.trim());

                            fetch('dao/daoUsuariosGuardar.php', {
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
                                        limpiar();
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

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...', showConfirmButton: false, input: 'none',
                                text: 'Ingrese el rol'
                            })
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...', showConfirmButton: false, input: 'none',
                            text: 'Ingrese el password'
                        })
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...', showConfirmButton: false, input: 'none',
                        text: 'Ingrese el puesto'
                    })
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...', showConfirmButton: false, input: 'none',
                    text: 'Ingrese APU'
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...', showConfirmButton: false, input: 'none',
                text: 'Ingrese la nombre'
            })
        }
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...', showConfirmButton: false, input: 'none',
            text: 'Ingrese el nómina'
        })
    }
}

function verificarConEnter(event) {
    // Verifica si la tecla presionada es "Enter"
    if (event.keyCode === 13) {
        buscarNombre(llenarNomina(document.getElementById("txtNomina").value));
    }
}

function buscarNombre(nomina) {
    $.getJSON('https://arketipo.mx/Controlling/BonoSalida/dao/DaoNombre.php?nomina=' + nomina, function (data) {
        document.getElementById("txtNombre").value = data.data[0].NomUser;
    });
}



function limpiar() {
    document.getElementById('txtIdEncargados').value = '';
    document.getElementById('txtSupervisorEncargados').value = '';
    document.getElementById('txtShiftLeaderEncargados').value = '';
    document.getElementById('txtNomina').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtPassword').value = '';

    document.getElementById('txtIdEncargados').value = '';
    document.getElementById('cbApuEncargados').value = '';
    document.getElementById('txtSupervisorEncargados').value = '';
    document.getElementById('txtShiftLeaderEncargados').value = '';
}

function enviarEncargado() {

    var id = document.getElementById('txtIdEncargados');
    var apu = document.getElementById('cbApuEncargados');
    var supervisor = document.getElementById('txtSupervisorEncargados');
    var shiftLeader = document.getElementById('txtShiftLeaderEncargados');

    if (apu.value.trim() !== '') {
        if (supervisor.value.trim() !== '') {
            if (shiftLeader.value.trim() !== '') {

                const data = new FormData();

                if (id.value.trim() !== '') {
                    data.append('id', id.value);
                } else {
                    data.append('id', "n");
                }

                data.append('apu', apu.value.trim());
                data.append('supervisor', supervisor.value.trim());
                data.append('shiftLeader', shiftLeader.value.trim());

                fetch('dao/daoEncargadosGuardar.php', {
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
                            limpiar();
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

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...', showConfirmButton: false, input: 'none',
                    text: 'Ingrese APU'
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...', showConfirmButton: false, input: 'none',
                text: 'Ingrese la nombre'
            })
        }
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...', showConfirmButton: false, input: 'none',
            text: 'Ingrese el nómina'
        })
    }
}

function eliminarEncargado() {

    var id = document.getElementById('txtIdEncargados');

    if (id.value.trim() !== '') {

        const data = new FormData();

        data.append('id', id.value.trim());

        fetch('dao/daoEncargadosEliminar.php', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado.', showConfirmButton: false, input: 'none',
                        text: 'Registro enviardo.'
                    })
                    limpiar();
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

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...', showConfirmButton: false, input: 'none',
            text: 'No se selecciono ningun usuario'
        })
    }
}


function eliminarUsuario() {

    var id = document.getElementById('txtNomina');

    if (id.value.trim() !== '') {

        const data = new FormData();

        data.append('id', id.value.trim());

        fetch('dao/daoUsuariosEliminar.php', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado.', showConfirmButton: false, input: 'none',
                        text: 'Registro enviardo.'
                    })
                    limpiar();
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

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...', showConfirmButton: false, input: 'none',
            text: 'No se selecciono ningun usuario'
        })
    }
}
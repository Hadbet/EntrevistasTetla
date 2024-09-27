<!DOCTYPE HTML>
<html>
<head>
    <?php
    session_start();

    if ($_SESSION["nomina"] == "" && $_SESSION["nomina"]== null && $_SESSION["rol"]== "" && $_SESSION["rol"]== null) {
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='1; URL=login.html'>";
        session_destroy();
    }else{
        session_start();
    }
    ?>
    <title>Entrevistas Ausentismo</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="assets/css/main.css"/>
    <link rel="stylesheet" href="lib/css/noicartsinimda.css"/>

    <!-- CSS -->
    <link rel="stylesheet" href="lib/sweetalert2.css">

    <!-- JavaScript -->
    <script src="lib/sweetalert2.all.min.js"></script>
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css"/>
    </noscript>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css"/>
</head>
<body class="is-preload">

<button class="botonFlotante" onclick="toggleMenu()">☰</button>

<div class="menuNavegacion" id="menuNavegacion">
    <a id="navEntrevista" href="index.php" class="active">Entrevista</a>
    <a id="navHistorico" href="Historico.php">Histórico</a>
    <a id="navExpedientes" href="Expedientes.php">Expedientes</a>
    <a id="navDashBoard" href="dashboar.php">DashBoard</a>
    <a id="navCapacitacion" href="#cta">Capacitación</a>
    <a id="navAdministracion" href="Administracion.php">Administración</a>
    <a href="login.html" style="color: darkred">Salir</a>
</div>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header" class="alt">
        <span class="logo"><img class="logoAux" src="images/logo_blanco.png" alt=""/></span>
        <h1>Entrevistas Ausentismo</h1>
        <p>Recuerda que es importante mantener informado al trabajador<br/>
            de todos los datos ingresados en este sistema.</p>
    </header>

    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a id="navEntrevistaC" href="index.php" class="active">Entrevista</a></li>
            <li><a id="navHistoricoC" href="Historico.php">Histórico</a></li>
            <li><a id="navExpedientesC" href="Expedientes.php">Expedientes</a></li>
            <li><a id="navDashBoardC" href="dashboar.php">DashBoard</a></li>
            <li><a id="navCapacitacionC" href="#cta">Capacitación</a></li>
            <li><a id="navAdministracionC" href="Administracion.php">Administración</a></li>
            <li><a href="login.html" style="color: darkred">Salir</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">
        <section class="main special seccion-transicion" id="seccion1">

            <div class="spotlight" style="margin-bottom: 0px;">
                <div class="content">
                    <header class="major">
                        <h2>Usuarios.</h2>
                    </header>
                </div>
            </div>

            <hr>

            <div class="row gtr-uniform">
                <div class="col-2 col-12-xsmall">
                    <label style="text-align: center;">Nómina:</label>
                    <input type="number" name="demo-name" id="txtNomina" value="" placeholder="00012345"
                           onkeyup="verificarConEnter(event)"/>
                </div>
                <div class="col-4 col-12-xsmall">
                    <label style="text-align: center;">Nombre:</label>
                    <input type="text" name="demo-name" id="txtNombre" value="" placeholder="Juan Perez Black"/>
                </div>
                <div class="col-2 col-12-xsmall">
                    <label style="text-align: center;">APU:</label>
                    <select name="demo-category" id="cbEncargado">
                        <option value="">- Seleccione -</option>
                        <option value="APU 1">APU 1.</option>
                        <option value="APU 2">APU 2.</option>
                        <option value="APU 3">APU 3.</option>
                        <option value="NA">NA</option>
                    </select>
                </div>
                <div class="col-4 col-12-xsmall">
                    <label style="text-align: center;">Puesto:</label>
                    <select name="demo-category" id="cbPuesto">
                        <option value="">- Seleccione -</option>
                        <option value="Supervisor">Supervisor.</option>
                        <option value="Coordinador">Coordinador.</option>
                        <option value="ShiftLeader">ShiftLeader.</option>
                        <option value="RH">Recursos Humanos.</option>
                        <option value="APU 1">APU 1.</option>
                        <option value="APU 2">APU 2.</option>
                        <option value="APU 3">APU 3.</option>
                    </select>
                </div>
                <div class="col-6 col-12-xsmall">
                    <label style="text-align: center;">Contraseña:</label>
                    <input type="password" name="demo-name" id="txtPassword" value="" placeholder="Grammer1"/>
                </div>
                <div class="col-6 col-12-xsmall">
                    <label style="text-align: center;">Rol:</label>
                    <select name="demo-category" id="cbRol">
                        <option value="">- Seleccione -</option>
                        <option value="1">Administrador.</option>
                        <option value="2">Entrevistador.</option>
                    </select>
                </div>

                <div class="col-12">
                    <ul class="actions" style="justify-content: center;">
                        <li><input type="submit" value="Enviar" id="verificar" class="primary"/></li>
                        <li><input style="background-color: #ea5455" type="submit" value="Eliminar" id="eliminarUsu" class="primary"/></li>
                        <li><input type="submit" value="Reset" id="reset" class="secondary"/></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <!-- Contenido de la tabla -->
                    <table id="miTabla">
                        <thead>
                        <tr>
                            <th>Nómina</th>
                            <th>Nombre</th>
                            <th>APU</th>
                            <th>Puesto</th>
                            <th>Rol</th>
                            <th>Password</th>
                            <th>Editar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Los datos se agregarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="main special seccion-transicion" id="seccionEncargado">

            <div class="spotlight" style="margin-bottom: 0px;">
                <div class="content">
                    <header class="major">
                        <h2>Encargados.</h2>
                    </header>
                </div>
            </div>

            <hr>

            <div class="row gtr-uniform">
                <div class="col-2 col-12-xsmall">
                    <label style="text-align: center;">ID:</label>
                    <input type="number" name="demo-name" id="txtIdEncargados" value="" placeholder="00012345"
                           onkeyup="verificarConEnter(event)" disabled/>
                </div>
                <div class="col-2 col-12-xsmall">
                    <label style="text-align: center;">APU:</label>
                    <select name="demo-category" id="cbApuEncargados">
                        <option value="">- Seleccione -</option>
                        <option value="APU 1">APU 1.</option>
                        <option value="APU 2">APU 2.</option>
                        <option value="APU 3">APU 3.</option>
                    </select>
                </div>
                <div class="col-4 col-12-xsmall">
                    <label style="text-align: center;">Supervisor:</label>
                    <input type="text" name="demo-name" id="txtSupervisorEncargados" value="" placeholder="Grammer1"/>
                </div>
                <div class="col-4 col-12-xsmall">
                    <label style="text-align: center;">ShiftLeader:</label>
                    <input type="text" name="demo-name" id="txtShiftLeaderEncargados" value="" placeholder="Grammer1"/>
                </div>

                <div class="col-12">
                    <ul class="actions" style="justify-content: center;">
                        <li><input type="submit" value="Agregar o Actualizar" id="verificarDos" class="primary"/></li>
                        <li><input type="submit" value="Eliminar" id="eliminarDos" class="primary"
                                   style="background-color: #ea5455"/></li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <!-- Contenido de la tabla -->
                    <table id="miTablaDos">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>APU</th>
                            <th>Supervisor</th>
                            <th>ShiftLeader</th>
                            <th>Editar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Los datos se agregarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <br>
        <!-- First Section -->


    </div>

    <!-- Footer -->
    <footer id="footer">
        <section>
            <h2>Información</h2>
            <dl class="alt">
                <dt>Address</dt>
                <dd>Av. De la Luz No. 24 Int: B 1 y 2 ACC III</dd>
                <dd>Queretaro, Queretaro 76120 Mexico</dd>
                <dt>Phone</dt>
                <dd>(000) 000-0000 x 0000</dd>
                <dt>Email</dt>
                <dd><a href="#">information@untitled.tld</a></dd>
            </dl>
            <ul class="icons">
                <li><a href="#" class="icon brands fa-linkedin alt"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon brands fa-facebook-f alt"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon brands fa-instagram alt"><span class="label">Instagram</span></a></li>
            </ul>
        </section>
        <p class="copyright">&copy; Grammer Automotive Puebla S.A de C.V. Design: Grammer.</p>
    </footer>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="lib/js/noicartsinimda.js"></script>
<script src="lib/js/niam.js"></script>

<script>
    var rol = '<?php echo $_SESSION["rol"];?>';

    if (rol==='2'){
        window.location.href = 'index.php';
    }

    if (rol==='3'){
        window.location.href = 'index.php';
    }
</script>
</body>

</html>
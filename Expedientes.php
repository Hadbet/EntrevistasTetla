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
    <link rel="stylesheet" href="lib/css/setneidepxe.css"/>
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

            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <h2 style="text-align: center;">Nómina:</h2>
                    <input type="number" name="demo-name" id="txtNomina" value="" placeholder="00012345"/>
                </div>

                <div class="col-12">
                    <ul class="actions" style="justify-content: center;">
                        <li><input type="submit" value="Verificar" id="verificar" class="primary"/></li>
                    </ul>
                </div>
            </div>
        </section>
        <div id="seccion2" style="display: none; margin: 40px">
            <!-- First Section -->
            <section class="main special">
                <header class="major">
                    <h2 id="txtNombre"></h2>
                </header>
                <h2>Información General</h2>
                <br>
                <div class="table-wrapper">
                    <table class="alt">
                        <tbody>
                        <tr>
                            <td>Número de nómina</td>
                            <td id="txtNumeroNomina"></td>
                        </tr>
                        <tr>
                            <td>Número de tag</td>
                            <td id="txtNumeroTag"></td>
                        </tr>
                        <tr>
                            <td>Centro de costos</td>
                            <td id="txtCentroCostos"></td>
                        </tr>
                        <tr>
                            <td>Nombre centro de costos</td>
                            <td id="txtNombreCentroCostos"></td>
                        </tr>
                        <tr>
                            <td>Work Center</td>
                            <td id="txtWorkCenter"></td>
                        </tr>
                        <tr>
                            <td>Nombre Work Center</td>
                            <td id="txtNombreWorkCenter"></td>
                        </tr>
                        <tr>
                            <td>Fecha Antiguedad</td>
                            <td id="txtFechaAntiguedad"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <h2>Información de nóminas</h2>

                <ul class="statistics">
                    <li class="style1">
                        <span class="icon solid fa-code-branch"></span>
                        <strong id="txtVacaciones"></strong> Vacaciones
                    </li>
                    <li class="style2">
                        <span class="icon fa-folder-open"></span>
                        <strong id="txtFondoAhorro"></strong> Fondo Ahorro
                    </li>
                    <li class="style3">
                        <span class="icon solid fa-signal"></span>
                        <strong id="txtCajaAhorro"></strong> Caja Ahorro
                    </li>
                    <li class="style4">
                        <span class="icon solid fa-laptop"></span>
                        <strong id="txtPendientePrestamo"></strong> Pendiente Prestamo
                    </li>
                    <li class="style5">
                        <span class="icon fa-gem"></span>
                        <strong id="txtPuntosKaizen"></strong> Puntos Kaizen
                    </li>
                </ul>
            </section>


            <section id="" class="main special">
                <hr>
                <header class="major">
                    <h2>Cursos concluidos</h2>
                </header>

                <ul class="features">
                    <li>
                        <span class="icon solid major style1 fa-code"></span>
                        <h3>HTML Basico</h3>
                        <p>Se concluyo el <strong>10 de marzon de 2023</strong> con una calificacion de 9.8.</p>
                    </li>
                    <li>
                        <span class="icon major style3 fa-copy"></span>
                        <h3>Documentación Tecnica</h3>
                        <p>Se concluyo el <strong>10 de marzon de 2023</strong> con una calificacion de 9.8.</p>
                    </li>
                    <li>
                        <span class="icon major style5 fa-gem"></span>
                        <h3>SAP Basico</h3>
                        <p>Se concluyo el <strong>10 de marzon de 2023</strong> con una calificacion de 9.8.</p>
                    </li>
                </ul>
            </section>

            <!-- Second Section -->
            <section class="main special">
                <hr>
                <header class="major">
                    <h2>Ausentismos</h2>
                </header>
                <canvas id="myChart"></canvas>
            </section>
        </div>

        <section class="main special seccion-transicion" style="display: none" id="tablaSeccion">
            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <table id="miTabla" style="margin: 40px">
                        <thead>
                        <tr>
                            <th>Nómina Entrevistador</th>
                            <th>Fecha Reporte</th>
                            <th>Tipo Ausencia</th>
                            <th>Comentarios</th>
                            <th>Área</th>
                            <th>ShiftLeader</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Los datos se agregarán aquí dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="lib/js/niam.js"></script>
<script src="lib/js/setneidepxe.js"></script>

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
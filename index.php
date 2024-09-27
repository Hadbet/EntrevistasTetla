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
    <link rel="stylesheet" href="lib/css/xedni.css"/>
    <!-- CSS -->
    <link rel="stylesheet" href="lib/sweetalert2.css">
    <!-- JavaScript -->
    <script src="lib/sweetalert2.all.min.js"></script>
    <noscript>
        <link rel="stylesheet" href="assets/css/noscript.css"/>
    </noscript>
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
        <section style="margin: 40px" class="main special seccion-transicion" id="seccion1">

            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <img src="images/entrevista-min.gif" class="imagenAux">
                </div>
            </div>

            <div class="spotlight" style="margin-bottom: 0px;">
                <div class="content">
                    <header class="major">
                        <h2>Conteste el formulario.</h2>
                    </header>
                </div>
            </div>

            <div class="row gtr-uniform">
                <div class="col-12 col-12-xsmall">
                    <label style="text-align: center;">Nómina del entrevistado:</label>
                    <input type="number" name="demo-name" id="txtNomina" value="" placeholder="00012345"/>
                </div>

                <div class="col-12">
                    <ul class="actions" style="justify-content: center;">
                        <li><input type="submit" value="Verificar" id="verificar" class="primary"/></li>
                    </ul>
                </div>
            </div>
        </section>

        <section style="margin: 40px; display: none" class="main special seccion-transicion" id="seccion2">
            <div class="spotlight" style="margin-bottom: 0px;">
                <div class="content">
                    <header class="major">
                        <h2 id="nombreEntrevistado"></h2>
                    </header>
                </div>
            </div>

            <div class="row gtr-uniform">

                <div class="col-12 col-12-medium" id="seccionHistorico">
                    <h3>Últimos registros del entrevistado</h3>
                    <div id="historico">
                    </div>
                    <code><a href="Expedientes.php">Ver expediente del usuario</a></code>
                </div>

                <div class="col-12 col-12-medium">
                    <hr>
                </div>
                <div class="col-4 col-12-xsmall">
                    <label style="text-align: center;">Fecha de ausencia:</label>
                    <input type="date" name="demo-email" id="txtFechaAusencia" value="" placeholder=""/>
                </div>
                <div class="col-4 col-12-xsmall">
                    <label style="text-align: center;">Tipo ausentismo:</label>
                    <select name="demo-category" id="cbTipoAusentismo" onchange="mostrarSeccionTipo()">
                        <option value="">- Seleccione -</option>
                        <option value="Por qué no me autorizaron vacaciones">Por qué no me autorizaron vacaciones.
                        </option>
                        <option value="Estaba enfermo y no acudí al IMSS">Estaba enfermo y no acudí al IMSS.</option>
                        <option value="Cuidado de hijos">Cuidado de hijos.</option>
                        <option value="Trámite Legal">Trámite Legal.</option>
                        <option value="Familiar Enfermo">Familiar Enfermo.</option>
                        <option value="Cambio de domicilio">Cambio de domicilio.</option>
                        <option value="Me quede dormido">Me quede dormido.</option>
                        <option value="Por transporte">Por transporte.</option>
                        <option value="Junta y/o evento escolar">Junta y/o evento escolar.</option>
                        <option value="Mucho trafico">Mucho trafico.</option>
                        <option value="Lluvia">Lluvia.</option>
                        <option value="Falla mecánica">Falla mecánica.</option>
                        <option value="Otro">Otro.</option>
                    </select>
                </div>
                <div class="col-4 col-12-xsmall" id="seccionTipo" style="display: none">
                    <label style="text-align: center;">Ingrese el tipo:</label>
                    <input type="text" name="demo-email" id="txtTipo" value="" placeholder=""/>
                </div>
                <div class="col-4 col-12-xsmall">
                    <label style="text-align: center;">APU :</label>
                    <select name="demo-category" id="cbEncargado" onchange="llenarSuper()">
                        <option value="">- Seleccione -</option>
                    </select>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label style="text-align: center;">Supervisor :</label>
                    <select name="demo-category" id="cbSupervisor" onchange="llenarShift()">
                        <option value="">- Seleccione -</option>
                    </select>
                </div>

                <div class="col-4 col-12-xsmall">
                    <label style="text-align: center;">ShiftLeader:</label>
                    <select name="demo-category" id="cbShiftLeader">
                        <option value="">- Seleccione -</option>
                    </select>
                </div>
                <div class="col-12">
                    <label style="text-align: center;">Comentarios:</label>
                    <textarea name="demo-message" id="txtMotivo" placeholder="Ingresa el motivo del ausentismo."
                              rows="6"></textarea>
                </div>

                <div class="col-12 col-12-xsmall">
                    <label style="text-align: center;">Número de tag del entrevistado:</label>
                    <input type="text" name="demo-name" id="txtTag" value="" placeholder="0005618130"/>
                </div>

                <div class="col-12 col-12-xsmall">
                    <ul class="actions" style="justify-content: center;">
                        <li><input type="submit" id="btnEnviar" value="Enviar" class="primary"/></li>
                        <li><input type="reset" id="btnReset" value="Resetear"/></li>
                    </ul>
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
<script src="lib/js/xedni.js"></script>
<script src="lib/js/niam.js"></script>

<script>
    var nominaEntrevistador = '<?php echo $_SESSION["nomina"];?>';

    var rol = '<?php echo $_SESSION["rol"];?>';

    if (rol==='2'){
        document.getElementById("navAdministracion").style.display='none';
        document.getElementById("navDashBoard").style.display='none';
        document.getElementById("navExpedientes").style.display='none';
        document.getElementById("navHistorico").style.display='none';

        document.getElementById("navAdministracionC").style.display='none';
        document.getElementById("navDashBoardC").style.display='none';
        document.getElementById("navExpedientesC").style.display='none';
        document.getElementById("navHistoricoC").style.display='none';
    }

    if (rol==='3'){
        document.getElementById("navAdministracion").style.display='none';
        document.getElementById("navExpedientes").style.display='none';

        document.getElementById("navAdministracionC").style.display='none';
        document.getElementById("navExpedientesC").style.display='none';
    }

</script>

</body>
</html>
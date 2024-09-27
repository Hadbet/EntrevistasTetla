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
    <link rel="stylesheet" href="lib/css/raobhsad.css"/>
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

            <div class="col-12 col-12-xsmall" id="seccionSupervisor" style="display: none">
                <div class="spotlight" style="margin-bottom: 0px;">
                    <div class="content">
                        <header class="major">
                            <h2>Ausencias Generales por APU.</h2>
                        </header>
                    </div>
                </div>
                <div class="map-box">
                    <div id="areaChartApu"></div>
                </div>
            </div>

            <div class="spotlight" style="margin-bottom: 0px;    margin-top: -5%;">
                <div class="content">
                    <header class="major">
                        <h2>Resumen General.</h2>
                    </header>
                </div>
            </div>

            <div class="row gtr-uniform">
                <div class="col-5 col-12-xsmall">
                    <label style="text-align: center;">Fecha inicio:</label>
                    <input type="date" name="demo-name" id="txtFechaInicio" value="" placeholder="00012345"
                           onkeyup="verificarConEnter(event)"/>
                </div>
                <div class="col-5 col-12-xsmall">
                    <label style="text-align: center;">Fecha final:</label>
                    <input type="date" name="demo-name" id="txtFechaFin" value="" placeholder="Juan Perez Black"/>
                </div>

                <div class="col-2">
                    <label style="text-align: center;color: white">boton</label>
                    <ul class="actions" style="justify-content: center;">
                        <li><input type="submit" value="Enviar" id="verificar" class="primary"/></li>
                    </ul>
                </div>
            </div>
            <br>

            <div class="row gtr-uniform">

                <div class="col-12 col-12-xsmall" id="apusSeccion" style="display: none">
                    <ul class="statistics">
                        <li class="style3">
                            <span class="icon solid fa-code-branch"></span>
                                <strong id="txtApu1"></strong> Apu 1 - Sergio<br>
                            <button onclick="apuGraficas(1)" style="background-color: #00398e; margin-top: 20px" class="primary">Entrar</button>
                        </li>
                        <li class="style4">
                            <span class="icon fa-folder-open"></span>
                            <strong id="txtApu2"></strong> Apu 2 - Rhoman<br>
                            <button onclick="apuGraficas(2)" style="background-color: #00398e; margin-top: 20px" class="primary">Entrar</button>
                        </li>
                        <li class="style5">
                            <span class="icon solid fa-signal"></span>
                            <strong id="txtApu3"></strong> Apu 3 - Fernando<br>
                            <button onclick="apuGraficas(3)" style="background-color: #00398e; margin-top: 20px" class="primary">Entrar</button>
                        </li>
                    </ul>
                </div>

                <div class="col-12 col-12-xsmall" id="seccionSupervisor" style="display: none">
                    <div class="spotlight" style="margin-bottom: 0px;">
                        <div class="content">
                            <header class="major">
                                <h2>Ausencias por Supervisor.</h2>
                            </header>
                        </div>
                    </div>
                    <canvas id="myChart5"></canvas>
                </div>

                <div class="col-12 col-12-xsmall" id="seccionShift" style="display: none">
                    <div class="spotlight" style="margin-bottom: 0px;">
                        <div class="content">
                            <header class="major">
                                <h2>Ausencias por Shift Leader.</h2>
                            </header>
                        </div>
                    </div>
                    <canvas id="myChart3"></canvas>
                </div>

                <div class="col-12 col-12-xsmall" id="seccionEncargado" style="display: none">
                    <div class="spotlight" style="margin-bottom: 0px;">
                        <div class="content">
                            <header class="major">
                                <h2>Ausencias por Área.</h2>
                            </header>
                        </div>
                    </div>
                    <canvas id="myChart"></canvas>
                </div>

                <div class="col-12 col-12-xsmall" id="seccionTipo" style="display: none">
                    <div class="spotlight" style="margin-bottom: 0px;">
                        <div class="content">
                            <header class="major">
                                <h2>Ausencias por tipo.</h2>
                            </header>
                        </div>
                    </div>
                    <canvas id="myChart2"></canvas>
                </div>
                <div class="col-12 col-12-xsmall" id="seccionNomina" style="display: none">
                    <div class="spotlight" style="margin-bottom: 0px;">
                        <div class="content">
                            <header class="major">
                                <h2>Ausencias por Usuarios.</h2>
                            </header>
                        </div>
                    </div>
                    <canvas id="myChart4"></canvas>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="lib/js/draobhsad.js"></script>
<script src="lib/js/niam.js"></script>

<script>
    var rol = '<?php echo $_SESSION["rol"];?>';

    if (rol==='2'){
        window.location.href = 'index.php';
    }

    if (rol==='3'){
        document.getElementById("navAdministracion").style.display='none';
        document.getElementById("navExpedientes").style.display='none';

        document.getElementById("navAdministracionC").style.display='none';
        document.getElementById("navExpedientesC").style.display='none';
    }

    Apu();
    function Apu() {
        $.getJSON('https://arketipo.mx/RH/CursosRH/dao/ausentismo/consultaApu.php', function (data) {

            var Ene1 = 0, Feb1 = 0, Mar1 = 0, Abril1 = 0, May1 = 0, Jun1 = 0, Jul1 = 0, Ago1 = 0,
                Sep1 = 0, Oct1 = 0, Nov1 = 0, Dic1 = 0;

            var Ene2 = 0, Feb2 = 0, Mar2 = 0, Abril2 = 0, May2 = 0, Jun2 = 0, Jul2 = 0, Ago2 = 0,
                Sep2 = 0, Oct2 = 0, Nov2 = 0, Dic2 = 0;

            var Ene3 = 0, Feb3 = 0, Mar3 = 0, Abril3 = 0, May3 = 0, Jun3 = 0, Jul3 = 0, Ago3 = 0,
                Sep3 = 0, Oct3 = 0, Nov3 = 0, Dic3 = 0;

            for (var i = 0; i < data.data.length; i++) {
                if (data.data[i].Encargado === "APU 1"){
                    if (data.data[i].Mes === '1') {
                        Ene1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '2') {
                        Feb1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '3') {
                        Mar1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '4') {
                        Abril1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '5') {
                        May1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '6') {
                        Jun1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '7') {
                        Jul1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '8') {
                        Ago1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '9') {
                        Sep1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '10') {
                        Oct1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '11') {
                        Nov1 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '12') {
                        Dic1 = data.data[i].Asistencias;
                    }
                }

                if (data.data[i].Encargado === "APU 2"){
                    if (data.data[i].Mes === '1') {
                        Ene2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '2') {
                        Feb2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '3') {
                        Mar2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '4') {
                        Abril2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '5') {
                        May2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '6') {
                        Jun2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '7') {
                        Jul2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '8') {
                        Ago2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '9') {
                        Sep2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '10') {
                        Oct2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '11') {
                        Nov2 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '12') {
                        Dic2 = data.data[i].Asistencias;
                    }
                }

                if (data.data[i].Encargado === "APU 3"){
                    if (data.data[i].Mes === '1') {
                        Ene3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '2') {
                        Feb3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '3') {
                        Mar3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '4') {
                        Abril3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '5') {
                        May3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '6') {
                        Jun3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '7') {
                        Jul3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '8') {
                        Ago3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '9') {
                        Sep3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '10') {
                        Oct3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '11') {
                        Nov3 = data.data[i].Asistencias;
                    }
                    if (data.data[i].Mes === '12') {
                        Dic3 = data.data[i].Asistencias;
                    }
                }

            }
            graficaAusentismosApu(Ene1, Feb1, Mar1, Abril1, May1, Jun1, Jul1, Ago1, Sep1, Oct1, Nov1, Dic1,Ene2, Feb2, Mar2, Abril2, May2, Jun2, Jul2, Ago2, Sep2, Oct2, Nov2, Dic2,Ene3, Feb3, Mar3, Abril3, May3, Jun3, Jul3, Ago3, Sep3, Oct3, Nov3, Dic3);
        });
    }

    function graficaAusentismosApu(Ene1, Feb1, Mar1, Abril1, May1, Jun1, Jul1, Ago1, Sep1, Oct1, Nov1, Dic1,Ene2, Feb2, Mar2, Abril2, May2, Jun2, Jul2, Ago2, Sep2, Oct2, Nov2, Dic2,Ene3, Feb3, Mar3, Abril3, May3, Jun3, Jul3, Ago3, Sep3, Oct3, Nov3, Dic3) {
        var options = {
            series: [{
                name: 'Apu 1',
                data: [Ene1, Feb1, Mar1, Abril1, May1, Jun1, Jul1, Ago1, Sep1, Oct1, Nov1, Dic1]
            },
                {
                    name: 'Apu 2',
                    data: [Ene2, Feb2, Mar2, Abril2, May2, Jun2, Jul2, Ago2, Sep2, Oct2, Nov2, Dic2]
                },
                {
                    name: 'Apu 3',
                    data: [Ene3, Feb3, Mar3, Abril3, May3, Jun3, Jul3, Ago3, Sep3, Oct3, Nov3, Dic3]
                }

            ],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '65%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 5,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dic'],
            },
            yaxis: {
                title: {
                    text: 'Personas'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return " " + val + " personas"
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#areaChartApu"), options);
        chart.render();
    }
</script>

</body>
</html>
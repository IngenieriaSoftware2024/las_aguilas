<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="build/js/app.js"></script>
    <link rel="shortcut icon" href="<?= asset('images/AguilaLogo.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('build/styles.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <title>- Las Aguilas S.A. -</title>
</head>

<body style="background: linear-gradient(135deg, #f5d5ae, #d8a7a7, #b88484);" >
    <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">

        <div class="container-fluid me-5 ms-5">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/las_aguilas/">
                <img src="<?= asset('./images/AguilaLogo.png') ?>" width="40px'" alt="cit">
                Las Aguilas S.A.
            </a>
            <div class="collapse navbar-collapse" id="navbarToggler">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin: 0;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/las_aguilas/"><i class="bi bi-house-fill me-2"></i>Inicio</a>
                    </li>
                    <!-- EMPLEADOS -->
                    <div class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-people-fill me-2"></i>Empleados
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                            <!-- ADMINISTRA -->
                            <?php if ($_SESSION['user']['rol_nombre'] == "ADMINISTRA") : ?>
                                <li>
                                    <a class="dropdown-item nav-link text-white " href="/las_aguilas/empleado"><i class="bi bi-menu-button-wide-fill me-2"></i>Gestión de empleados</a>
                                </li>
                                <li>
                                    <a class="dropdown-item nav-link text-white " href="/las_aguilas/empleado/perfil"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Generación de perfiles</a>
                                </li>
                                <li>
                                    <a class="dropdown-item nav-link text-white " href="/las_aguilas/usuario"><i class="bi bi-menu-button-wide-fill me-2"></i>Gestión de usuarios</a>
                                </li>
                                <li>
                                    <a class="dropdown-item nav-link text-white " href="/las_aguilas/permiso"><i class="bi bi-menu-button-wide-fill me-2"></i>Gestión de permisos</a>
                                </li>
                            <?php endif; ?>
                            <!-- AGENTE -->
                            <?php if ($_SESSION['user']['rol_nombre'] == "AGENTE") : ?>
                                <li>
                                    <a class="dropdown-item nav-link text-white " href="/las_aguilas/empleado/registro"><i class="bi bi-r-circle-fill me-2"></i>Registro de empleados</a>
                                </li>
                            <?php endif; ?>
                            <!-- SUPERVISOR -->
                            <?php if ($_SESSION['user']['rol_nombre'] == "SUPERVISOR") : ?>
                                <li>
                                    <a class="dropdown-item nav-link text-white " href="/las_aguilas/empleado/lista"><i class="bi bi-r-circle-fill me-2"></i>Lista de empleados</a>
                                </li>

                            <?php endif; ?>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/turnos/estadisticas"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Estadistica Turnos</a>
                            </li>



                        </ul>
                    </div>
                    <!-- ASIGNACIÓN DE TAREAS -->
                    <div class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-card-checklist me-2"></i>Tareas
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                            <!-- Administrador -->
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/puestos"><i class="bi bi-person-lines-fill me-2"></i>Añadir Puesto</a>
                            </li>
                            <!-- Administrador -->
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/turnos"><i class="bi bi-person-lines-fill me-2"></i>Asignar Turnos</a>
                            </li>
                            <!-- Administrador y Supervisor -->
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/pdf"><i class="bi bi-person-lines-fill me-2"></i>Imprimir Turnos</a>
                            </li>
                            <!-- Administrador y Supervisor -->
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/turnos/estadisticas"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Estadistica Turnos</a>
                            </li>
                        </ul>
                    </div>
                    <!-- CLIENTES -->
                    <?php if ($_SESSION['user']['rol_nombre'] == "ADMINISTRA") : ?>
                        <div class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-badge m-2"></i>Clientes
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                                <li>
                                    <a class="dropdown-item nav-link text-white " href="/las_aguilas/clientes"><i class="bi bi-person-plus-fill me-2"></i>Ingresar Cliente</a>
                                </li>
                                <li>
                                    <a class="dropdown-item nav-link text-white " href="/las_aguilas/clientes"><i class="bi bi-eye-fill me-2"></i>Ver Contrato</a>
                                </li>
                            </ul>
                        </div>
                        <?php endif ?>;
                        <?php if ($_SESSION['user']['rol_nombre'] == "ADMINISTRA") : ?>

                            <div class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-file-richtext-fill me-2"></i>Facturas
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                                    <a class="dropdown-item nav-link text-white " href="/las_aguilas/factura"><i class="bi bi-file-text me-2"></i>Generar Facturas</a>
                                    </li>
                                </ul>
                            </div>
                            <?php endif ?>;
                </ul>
                <div class="col-lg-1 d-grid mb-lg-0 mb-2">
                    <!-- Ruta relativa desde el archivo donde se incluye menu.php -->
                    <a href="/las_aguilas/logout" class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>SALIR</a>
                </div>
            </div>
        </div>

    </nav>
    <div class="progress fixed-bottom" style="height: 6px;">
        <div class="progress-bar progress-bar-animated bg-danger" id="bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="container-fluid pt-2 mb-4" style="min-height: 85vh">

        <?php echo $contenido; ?>
    </div>
    <footer class="text-center py-2" style="background-color: #343a40; color: white;">
        <p>&copy; Las Águilas. Todos los derechos reservados. <?= date('Y') ?> </p>
    </footer>
</body>

</html>
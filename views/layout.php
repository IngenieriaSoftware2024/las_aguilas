<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="build/js/app.js"></script>
    <link rel="shortcut icon" href="<?= asset('images/cit.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('build/styles.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <title>DemoApp</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark  bg-dark">

        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/ejemplo/">
                <img src="<?= asset('./images/cit.png') ?>" width="35px'" alt="cit">
                Aplicaciones
            </a>
            <div class="collapse navbar-collapse" id="navbarToggler">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin: 0;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/las_aguilas/"><i class="bi bi-house-fill me-2"></i>Inicio</a>
                    </li>

                    <div class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-2"></i>Dropdown
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-dark " id="dropwdownRevision" style="margin: 0;">
                            <!-- <h6 class="dropdown-header">Información</h6> -->
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/empleado"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Gestión de empleados</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/empleado/registro"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Registro de empleados</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/empleado/lista"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Lista de empleados</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/usuario"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Gestión de usuarios</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/permiso"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Gestión de permisos</a>
                            </li>
                            
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/puestos"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Añadir Puesto</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/turnos"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Asignar Turnos</a>
                            </li>
                            <li>
                                <a class="dropdown-item nav-link text-white " href="/las_aguilas/pdf"><i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Imprimir Turnos</a>
                            </li>

                        </ul>
                    </div>

                </ul>
                <div class="col-lg-1 d-grid mb-lg-0 mb-2">
                    <!-- Ruta relativa desde el archivo donde se incluye menu.php -->
                    <a href="/menu/" class="btn btn-danger"><i class="bi bi-arrow-bar-left"></i>MENÚ</a>
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
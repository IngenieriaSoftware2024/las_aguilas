<div class="container mt-5 w-75 p-4 border rounded shadow bg-light">
    <div id="head">
        <h1 class="mb-4 text-center text-primary">Generación de perfil</h1>
        <form class="mb-4" id="formBuscar">
            <div class="form-group">
                <label for="emp_nombre">Nombre</label>
                <input type="search" id="emp_nombre" class="form-control mt-2" placeholder="Ingrese el nombre del empleado">
                <div class="row">
                <button type="submit" id="send" class="btn btn-primary mt-3"><i class="bi bi-search me-2"></i>Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <div id="info" class="p-4 border rounded shadow-lg bg-light" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; width: 80%; max-width: 600px;">
    <div class="d-flex align-items-center mb-4">

        <h2 class="text-uppercase text-primary mx-auto"><i class="bi bi-person me-5"></i>Perfil</h2>
    </div>
    <div class="list-group mb-4">
        <h5 id="nombreEmpleado" class="list-group-item list-group-item-action mt-2 bg-light"></h5>
        <h5 id="dpiEmpleado" class="list-group-item list-group-item-action mt-2 bg-white"></h5>
        <h5 id="direccionEmpleado" class="list-group-item list-group-item-action mt-2 bg-light"></h5>
        <h5 id="situacionEmpleado" class="list-group-item list-group-item-action mt-2 bg-white"></h5>
        <h5 id="telEmpleado" class="list-group-item list-group-item-action mt-2 bg-light"></h5>
    </div>
    <div class="text-center">
        <button type="button" id="closePerfil" class="btn btn-danger mt-3"><i class="bi bi-x-octagon me-3"></i>Cerrar</button>
        <div class="mt-4"> <!-- Separador -->
            <h6 class="text-center text-uppercase text-dark"><i class="bi bi-award-fill me-2"></i>Las Águilas</h6>
        </div>
    </div>
</div>




    <div id="overlay" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9998;"></div>
    
    <table id="tablaEmpleados" class="table table-hover mt-4 table-bordered">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DPI</th>
                <th>Teléfono</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script src="<?= asset('./build/js/empleado/perfil.js') ?>"></script>


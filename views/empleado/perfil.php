<div class="container mt-5 w-75 p-4 border rounded shadow bg-light">
    <div id="head">
        <h1 class="mb-4 text-center text-primary">Ingrese el nombre del empleado para generar el perfil</h1>
        <form class="mb-4" id="formBuscar">
            <div class="form-group">
                <label for="emp_nombre">Nombre</label>
                <input type="search" id="emp_nombre" class="form-control mt-2" placeholder="Ingrese el nombre del empleado">
            </div>
            <div class="row">
                <button type="submit" id="send" class="btn btn-primary mt-3">Buscar</button>
            </div>
        </form>
    </div>
    <div id="info" class="p-4 border rounded shadow-sm bg-white" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; width: 50%;">
        <h2 class="text-center text-uppercase text-primary mb-4">Perfil</h2>
        <h5 id="nombreEmpleado" class="mb-3"></h5>
        <h5 id="dpiEmpleado" class="mb-3"></h5>
        <h5 id="direccionEmpleado" class="mb-3"></h5>
        <h5 id="situacionEmpleado" class="mb-3"></h5>
        <h5 id="telEmpleado" class="mb-3"></h5>
        <div class="text-center">
            <button type="button" id="closePerfil" class="btn btn-secondary mt-3">Cerrar</button>
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


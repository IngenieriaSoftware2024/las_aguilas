<div class="container my-5">
    <h1 class="text-center mb-4">Gestión de usuarios</h1>

    <div class="accordion mb-4" id="empleadosAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Listado de empleados activos
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#empleadosAccordion">
                <div class="accordion-body">
                    <ul id="listaEmpleados" class="list-group">
                        <!-- Aquí se llenarán los empleados activos -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <form id="formUsuario" class="shadow p-4 rounded bg-light">
        <input type="hidden" name="usu_id" id="usu_id">

        <div class="form-floating mb-3">
            <input type="text" name="usu_nombre" id="usu_nombre" class="form-control" placeholder="Nombre completo" required>
            <label for="usu_nombre">Nombre del usuario</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control" placeholder="Catalogo" maxlength="15" required>
            <label for="usu_catalogo">Catalogo del usuario</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="usu_password" id="usu_password" class="form-control" placeholder="Password" required>
            <label for="usu_password">Password del usuario</label>
        </div>

        <div class="form-floating mb-4">
            <select name="usu_situacion" id="usu_situacion" class="form-select" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <label for="usu_situacion">Situación del Usuario</label>
        </div>

        <div class="row mb-4">
            <div class="col">
                <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
            </div>
            <div class="col">
                <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
            </div>
            <div class="col">
                <button type="button" id="btnCancelar" class="btn btn-danger w-100">Cancelar</button>
            </div>
        </div>
    </form>

    <div class="mt-5">
        <div class="table-responsive">
            <table id="tablaUsuario" class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>NOMBRE</th>
                        <th>CATALOGO</th>
                        <th>PASSWORD</th>
                        <th>SITUACION</th>
                        <th>MODIFICAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?= asset('./build/js/usuario/datatable.js') ?>"></script>

<div class="container my-5">
    <h1 class="text-center mb-4">Gestión de Empleados como administrador</h1>
    
    <form id="formEmpleado" class="shadow p-4 rounded bg-light">
        <input type="hidden" name="emp_id" id="emp_id">

        <!-- Campo: Nombre del Empleado -->
        <div class="form-floating mb-3">
            <input type="text" name="emp_nombre" id="emp_nombre" class="form-control" placeholder="Nombre completo">
            <label for="emp_nombre">Nombre del Empleado</label>
        </div>

        <!-- Campo: DPI del Empleado -->
        <div class="form-floating mb-3">
            <input type="text" name="emp_dpi" id="emp_dpi" class="form-control" placeholder="Número de DPI" maxlength="15">
            <label for="emp_dpi">DPI del Empleado</label>
        </div>

        <!-- Campo: Dirección del Empleado -->
        <div class="form-floating mb-3">
            <input type="text" name="emp_direccion" id="emp_direccion" class="form-control" placeholder="Dirección">
            <label for="emp_direccion">Dirección del Empleado</label>
        </div>

        <!-- Campo: Teléfono del Empleado -->
        <div class="form-floating mb-3">
            <input type="text" name="emp_tel" id="emp_tel" class="form-control" placeholder="Teléfono" maxlength="10">
            <label for="emp_tel">Teléfono del Empleado</label>
        </div>

        <!-- Campo: Situación del Empleado -->
        <div class="form-floating mb-4">
            <select name="emp_situacion" id="emp_situacion" class="form-select">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <label for="emp_situacion">Situación del Empleado</label>
        </div>

        <!-- Botones de Acción -->
        <div class="row">
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
            <table id="tablaEmpleado" class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>NOMBRE</th>
                        <th>DPI</th>
                        <th>DIRECCIÓN</th>
                        <th>TELÉFONO</th>
                        <th>SITUACIÓN</th>
                        <th>MODIFICAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se agregarán los datos -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?= asset('./build/js/empleado/datatable.js') ?>"></script>

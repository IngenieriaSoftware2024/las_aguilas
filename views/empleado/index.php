<h1 class="text-center mb-4">INFORMACIÓN PERSONAL PARA EL INGRESO DE EMPLEADOS</h1>
<div class="row justify-content-center">
    <div class="border shadow-lg p-4 col-lg-6 bg-light rounded-3">
        <form id="formEmpleado">
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
            <div class="form-floating mb-3">
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
    </div>
</div>

<!-- Tabla de empleados -->
<div class="row justify-content-center mt-4">
    <div class="col-lg-10 table-responsive">
        <h2 class="text-center mb-3">Listado de empleados</h2>
        <table class="table table-bordered table-hover shadow-sm" id="tablaEmpleado">
            <thead class="table-dark text-center">
                <tr>
                    <th>No.</th>
                    <th>Nombre</th>
                    <th>DPI</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Situación</th>
                    <th>Acción</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <!-- Aquí se cargan los empleados -->
            </tbody>
        </table>
    </div>
</div>

<script src="<?= asset('./build/js/empleado/index.js') ?>"></script>

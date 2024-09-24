<div class="container my-5">
    <h1 class="text-center mb-4">INGRESE SUS DATOS PARA SER REGISTRADO</h1>
    
    <form id="formEmpleado" class="shadow p-4 rounded bg-light" enctype="multipart/form-data">
    <input type="hidden" name="emp_id" id="emp_id">

    <!-- Campo: Nombre del Empleado -->
    <div class="form-floating mb-3">
        <input type="text" name="emp_nombre" id="emp_nombre" class="form-control" placeholder="Nombre completo" required>
        <label for="emp_nombre">Nombre del Empleado</label>
        <div class="invalid-feedback">Por favor, ingrese su nombre.</div>
    </div>

    <!-- Campo: DPI del Empleado -->
    <div class="form-floating mb-3">
        <input type="text" name="emp_dpi" id="emp_dpi" class="form-control" placeholder="Número de DPI" maxlength="15" required>
        <label for="emp_dpi">DPI del Empleado</label>
        <div class="invalid-feedback">Por favor, ingrese su DPI.</div>
    </div>

    <!-- Campo: Dirección del Empleado -->
    <div class="form-floating mb-3">
        <input type="text" name="emp_direccion" id="emp_direccion" class="form-control" placeholder="Dirección" required>
        <label for="emp_direccion">Dirección del Empleado</label>
        <div class="invalid-feedback">Por favor, ingrese su dirección.</div>
    </div>

    <!-- Campo: Teléfono del Empleado -->
    <div class="form-floating mb-3">
        <input type="text" name="emp_tel" id="emp_tel" class="form-control" placeholder="Teléfono" maxlength="10" required>
        <label for="emp_tel">Teléfono del Empleado</label>
        <div class="invalid-feedback">Por favor, ingrese su teléfono.</div>
    </div>

    <!-- Campo: Situación del Empleado -->
    <div class="form-floating mb-4">
        <select name="emp_situacion" id="emp_situacion" class="form-select" required>
            <option value="" disabled selected>Seleccione situación</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        <label for="emp_situacion">Situación del Empleado</label>
        <div class="invalid-feedback">Por favor, seleccione una situación.</div>
    </div>

   
    <div class="form-floating mb-3">
        <input type="text" name="doc_nombre" id="doc_nombre" class="form-control" placeholder="Nombre del Documento" required>
        <label for="doc_nombre">Nombre del Documento</label>
        <div class="invalid-feedback">Por favor, ingrese el nombre del documento.</div>
    </div>

   
    <div class="mb-3">
        <label for="doc_ruta" class="form-label">Seleccione el archivo PDF</label>
        <input type="file" name="doc_ruta" id="doc_ruta" class="form-control" accept=".pdf" required>
        <div class="invalid-feedback">Por favor, seleccione un archivo PDF.</div>
    </div>

    <!-- Botones de Acción -->
    <div class="row mb-3">
        <div class="col">
            <button type="submit" id="btnGuardar" class="btn btn-primary w-100">REGISTRARSE</button>
        </div>
    </div>
</form>


    <div class="text-center">
        <p class="mt-3 text-muted">* Todos los campos son obligatorios*</p>
    </div>
</div>

<script src="<?= asset('./build/js/empleado/registro.js') ?>"></script>

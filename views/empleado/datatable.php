<h1 class="text-center">DATATABLE de empleado</h1>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="table-responsive">
        <table id="tablaEmpleado" class="table table-bordered table-hover">
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
<div class="container mt-5">
    <h1 class="mb-4">Lista de Empleados</h1>
    
    <table id="tablaEmpleado" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nombre</th>
                <th>DPI</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Situación</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se llenarán los datos dinámicamente con DataTables -->
        </tbody>
    </table>
</div>


<script src="<?= asset('./build/js/empleado/lista.js') ?>"></script>

<?php
use Model\Puesto;
$puesto = new Puesto($_GET);
$puestos = $puesto->buscar();
?>

<?php
use Model\Empleado;
$empleado = new Empleado($_GET);
$empleados = $empleado->buscar();
?>

<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaTurnos">
        </table>
    </div>
</div>    
<script src="<?= asset('./build/js/turno/lista.js') ?>"></script>
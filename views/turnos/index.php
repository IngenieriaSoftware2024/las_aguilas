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

<h1 class="text-center">Formulario de Turnos</h1>
<div class="row justify-content-center mb-4">
    <form id="formTurno" class="border shadow p-4 col-lg-4">
        <input type="hidden" name="turno_id" id="turno_id">
        <div class="row mb-3">
                <div class="col">
                    <label for="turno_empleado">Seleccione el Empleado </label>
                    <select name="turno_empleado" id="turno_empleado" class="form-control" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($empleados as $empleado) : ?>
                            <option value="<?= $empleado['emp_id'] ?>">
                                <?= $empleado['emp_nombre'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
        </div>
        <div class="row mb-3">
                <div class="col">
                    <label for="turno_puesto">Seleccione el Puesto </label>
                    <select name="turno_puesto" id="turno_puesto" class="form-control" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($puestos as $puesto) : ?>
                            <option value="<?= $puesto['puesto_id'] ?>">
                                <?= $puesto['puesto_nombre'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="turno_fecha_inicio">Ingrese Fecha de Inicio de Turno</label>
                <input type="datetime-local" name="turno_fecha_inicio" id="turno_fecha_inicio" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="turno_fecha_fin">Ingrese Fecha de Finalización de Turno</label>
                <input type="datetime-local" name="turno_fecha_fin" id="turno_fecha_fin" class="form-control">
            </div>
        </div>
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
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaTurnos">
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/turno/index.js') ?>"></script>

<?php
use Model\Cliente;
$cliente = new Cliente($_GET);
$clientes = $cliente->buscar();
?>

<h1 class="text-center">Formulario de Puestos</h1>
<div class="row justify-content-center mb-4">
    <form id="formPuesto" class="border shadow p-4 col-lg-4">
        <input type="hidden" name="puesto_id" id="puesto_id">
        <div class="row mb-3">
            <div class="col">
                <label for="puesto_nombre">Nombre del Puesto</label>
                <input type="text" name="puesto_nombre" id="puesto_nombre" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="puesto_descripcion">Descripción del Puesto</label>
                <input type="text" name="puesto_descripcion" id="puesto_descripcion" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="puesto_salario">Salario del Puesto</label>
                <input type="number" name="puesto_salario" id="puesto_salario" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="puesto_direccion">Dirección del Puesto</label>
                <input type="text" name="puesto_direccion" id="puesto_direccion" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
                <div class="col">
                    <label for="puesto_cliente">Seleccione el Cliente </label>
                    <select name="puesto_cliente" id="puesto_cliente" class="form-control" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($clientes as $cliente) : ?>
                            <option value="<?= $cliente['cliente_id'] ?>">
                                <?= $cliente['cliente_nombre'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
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
        <table class="table table-bordered table-hover w-100" id="tablaPuestos">
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/puesto/index.js') ?>"></script>
<div class="row justify-content-center">
    <form class="col-lg-5 border rounded shadow p-4" style="background-color: #26252533;" id="form-factura">
        <h3 class="text-center mb-4" style="font-family: 'Cinzel', serif; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5); font-size: 2.5rem; color: #0056b3;">
            <b>Generar Factura</b>
        </h3>

        <div class="mb-3">
            <label for="factura_cliente" class="form-label">Seleccionar Cliente</label>
            <input type="hidden" name="factura_correlativo" id="factura_correlativo" class="form-control" readonly>

            <select name="factura_cliente" id="factura_cliente" class="form-select" style="border: 1px solid #007bff;">
                <option value="">SELECCIONE...</option>
                <?php foreach ($clientes as $cliente) : ?>
                    <option value="<?= $cliente['cliente_id'] ?>" data-codigo="<?= $cliente['cliente_nit'] ?>">
                        <?= $cliente['cliente_nombre'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="factura_mes" class="form-label">Mes</label>
                <select name="factura_mes" id="factura_mes" class="form-select" style="border: 1px solid #007bff;">
                    <option value="">SELECCIONE EL MES...</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>

            <div class="col">
                <label for="factura_anio" class="form-label">Año</label>
                <input type="number" name="factura_anio" id="factura_anio" class="form-control" placeholder="Ingresa el año" style="border: 1px solid #007bff;" min="2000" max="2100">
            </div>
        </div>
        <input type="hidden" name="factura_nit" id="factura_nit" class="form-control" readonly>
        <input type="hidden" name="detalle_cantidad_empleados" id="detalle_cantidad_empleados" class="form-control" readonly>
        <input type="hidden" name="detalle_empleados" id="detalle_empleados" class="form-control" readonly>
        <input type="hidden" name="detalle_total" id="detalle_total" class="form-control" readonly>
        <div class="row p-1 justify-content-center">
            <div class="col-auto">
                <button type="submit" id="BtnGenerar" class="btn btn-primary">Generar Factura</button>
            </div>
            <div class="col-auto">
                <button type="button" id="BtnMostrarFacturas" class="btn btn-success text-uppercase shadow border-0">Ver todas las facturas</button>
            </div>
            <div class="col-auto">
                <button type="button" id="BtnBuscar" class="btn btn-warning text-uppercase shadow border-0">Buscar</button>
            </div>
        </div>
    </form>
</div>
<div class="row justify-content-center">
    <div class="col-lg-10">
        <table id="FacturasRegistradas" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre de la Empresa</th>
                    <th>No. de Factura</th>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Ver la Factura</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>


<script src="<?= asset('/build/js/facturas/facturas.js') ?>"></script>
<script src="<?= asset('/build/js/funciones.js') ?>"></script>
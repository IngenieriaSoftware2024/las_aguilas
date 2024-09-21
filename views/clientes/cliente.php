<div class="row justify-content-center">
    <form class="col-lg-5 border rounded shadow p-4" style="background-color: #26252533;" enctype="multipart/form-data" id="form-cliente">
        <h3 class="text-center mb-4"><b>REGISTRO DE CLIENTES</b></h3>
        <div class="mb-3">
            <input type="hidden" name="cliente_id" id="cliente_id" class="form-control">
        </div>
        <div class="mb-3">
            <label for="cliente_nombre" class="form-label">Nombre de la Empresa</label>
            <input type="text" name="cliente_nombre" id="cliente_nombre" class="form-control" placeholder="Ingresa el nombre de la empresa" style="border: 1px solid #007bff;">
        </div>
        <div class="mb-3">
            <label for="cliente_propietario" class="form-label">Nombre del Propietario</label>
            <input type="text" name="cliente_propietario" id="cliente_propietario" class="form-control" placeholder="Ingresa el nombre aquí" style="border: 1px solid #007bff;">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="cliente_nit" class="form-label">NIT</label>
                <input type="text" name="cliente_nit" id="cliente_nit" class="form-control" placeholder="Ingresa tu NIT de la empresa" style="border: 1px solid #007bff;">
            </div>
            <div class="col">
                <label for="cliente_telefono" class="form-label">Teléfono</label>
                <input type="tel" name="cliente_telefono" id="cliente_telefono" class="form-control" placeholder="Ingresa tu teléfono" style="border: 1px solid #007bff;">
            </div>
        </div>
        <div class="mb-3">
            <label for="cliente_correo" class="form-label">Correo Electrónico</label>
            <input type="email" name="cliente_correo" id="cliente_correo" class="form-control" placeholder="Ingresa tu correo" style="border: 1px solid #007bff;">
        </div>
        <div class="mb-3">
            <label for="cliente_ubicacion" class="form-label">Ubicación de la Empresa</label>
            <input type="text" name="cliente_ubicacion" id="cliente_ubicacion" class="form-control" placeholder="Coordenadas geográficas (ej. 15.783471, -90.230759)" style="border: 1px solid #007bff;">
        </div>
        <div class="mb-3">
            <label for="cliente_contrato" class="form-label">Contrato (PDF)</label>
            <div class="input-group">
                <input type="file" name="cliente_contrato" id="cliente_contrato" class="form-control" accept=".pdf" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" id="BtnEnviar" class="btn btn-primary w-100 btn-lg" style="background-color: #007bff; border: none;">
                    Registrar Cliente
                </button>
            </div>
        </div>
    </form>
</div>
<script src="<?= asset('/build/js/clientes/clientes.js') ?>"></script>
<script src="<?= asset('/build/js/funciones.js') ?>"></script>
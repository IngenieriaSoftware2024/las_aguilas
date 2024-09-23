<div class="container my-4">
    <h2 class="mb-4">Asignar Permiso</h2>
    <form id="formPermiso">
    
        <div class="mb-3">
            <label for="rol_id" class="form-label">Seleccione Rol</label>
            <select id="listaRoles" class="form-select" name="rol_id" required>
                <option value="">Seleccione un rol</option>
                <!-- Opciones de roles se llenarán aquí -->
            </select>
        </div>
        <div class="mb-3">
            <label for="usu_id" class="form-label">Seleccione Usuario</label>
            <select id="listaUsuarios" class="form-select" name="usu_id" required>
                <option value="">Seleccione un usuario</option>
                <!-- Opciones de usuarios se llenarán aquí -->
            </select>
        </div>
        <div class="row mb-4">
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

    <h2 class="mt-5">Permisos Asignados</h2>
    <table id="tablaPermisos" class="table table-striped mt-3">
        <thead>
            <tr>
                <th>No.</th>
                <th>USUARIOS</th>
                <th>ROL</th>
                <th>MODIFICAR</th>
                <th>ELIMINAR</th>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas de la tabla se llenarán aquí -->
        </tbody>
    </table>
</div>

<script src="<?= asset('./build/js/permiso/datatable.js') ?>"></script>

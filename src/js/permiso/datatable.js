import { Dropdown } from "bootstrap";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('formPermiso');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');
let permisosData = [];
let datatable;

btnModificar.parentElement.style.display = 'none';
btnModificar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
btnCancelar.disabled = true;

const cargarRoles = async () => {
    try {
        const url = '/las_aguilas/API/rol/buscar';
        const respuesta = await fetch(url);
        const data = await respuesta.json();
        const listaRoles = document.getElementById('listaRoles');
        listaRoles.innerHTML = '<option value="">Seleccione un rol</option>';
        data.datos.forEach(rol => {
            const option = document.createElement('option');
            option.value = rol.rol_id; 
            option.textContent = rol.rol_nombre;
            listaRoles.appendChild(option);
        });
    } catch (error) {
        console.log(error);
    }
};

const cargarUsuarios = async () => {
    try {
        const url = '/las_aguilas/API/usuario/buscar';
        const respuesta = await fetch(url);
        const data = await respuesta.json();
        const listaUsuarios = document.getElementById('listaUsuarios');
        listaUsuarios.innerHTML = '<option value="">Seleccione un usuario</option>';
        data.datos.forEach(usuario => {
            const option = document.createElement('option');
            option.value = usuario.usu_id; 
            option.textContent = `${usuario.usu_nombre} - ${usuario.usu_catalogo}`;
            listaUsuarios.appendChild(option);
        });
    } catch (error) {
        console.log(error);
    }
};

const guardarPermiso = async (e) => {
    e.preventDefault();
    if (!validarFormulario(formulario)) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }
    try {
        const formData = new FormData(formulario);
        const url = '/las_aguilas/API/permiso/guardar';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const data = await respuesta.json();
        const { codigo, mensaje } = data;
        let icon = codigo === 1 ? 'success' : 'error';
        Toast.fire({ icon, title: mensaje });
        if (codigo === 1) {
            formulario.reset();
            buscarPermisos();
        }
    } catch (error) {
        console.log("Error en la solicitud:", error);
        Swal.fire({
            title: "Error",
            text: "Ocurrió un error al intentar guardar el permiso",
            icon: "error"
        });
    }
};

const buscarPermisos = async () => {
    try {
        const url = '/las_aguilas/API/permiso/buscar';
        const respuesta = await fetch(url);
        const data = await respuesta.json();
        permisosData = data.datos || [];
        if (datatable) {
            datatable.clear().draw();
            datatable.rows.add(permisosData).draw();
        } else {
            inicializarDataTable(permisosData);
        }
    } catch (error) {
        console.log(error);
    }
};

const inicializarDataTable = (data) => {
    datatable = new DataTable('#tablaPermisos', {
        language: lenguaje,
        data: data,
        columns: [
            { title: "No.", render: (data, type, row, meta) => meta.row + 1 },
            { title: "USUARIOS", data: 'usu_nombre' }, 
            { title: "ROL", data: 'rol_nombre' }, 
            {
                title: "MODIFICAR",
                data: 'per_id',
                render: (data) => `<button class="btn btn-warning btn-modificar" data-id="${data}">Modificar</button>`
            },
            {
                title: "ELIMINAR",
                data: 'per_id',
                render: (data) => `<button class="btn btn-danger btn-eliminar" data-id="${data}">Eliminar</button>`
            },
        ]
    });

    document.querySelector('#tablaPermisos tbody').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-modificar')) {
            const per_id = e.target.getAttribute('data-id');
            const permiso = permisosData.find(p => p.per_id == per_id);
            llenarFormulario(permiso);
        } else if (e.target.classList.contains('btn-eliminar')) {
            const per_id = e.target.getAttribute('data-id');
            eliminarPermiso(per_id);
        }
    });
};

const llenarFormulario = (permiso) => {
    console.log(permiso);
    formulario.listaRoles.value = permiso.rol_nombre; 
    formulario.listaUsuarios.value = permiso.usu_nombre; 
    btnGuardar.parentElement.style.display = 'none';
    btnModificar.parentElement.style.display = '';
    btnCancelar.parentElement.style.display = '';
    btnModificar.disabled = false;
    btnCancelar.disabled = false;
};

const modificarPermiso = async (e) => {
    e.preventDefault();
    if (!validarFormulario(formulario)) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }
    try {
        const formData = new FormData(formulario);
        const url = '/las_aguilas/API/permiso/modificar';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: formData
        });
        const data = await respuesta.json();
        const { codigo, mensaje } = data;
        let icon = codigo === 1 ? 'success' : 'error';
        if (codigo === 1) {
            formulario.reset();
            buscarPermisos();
            btnGuardar.parentElement.style.display = '';
            btnModificar.parentElement.style.display = 'none';
            btnCancelar.parentElement.style.display = 'none';
        }
        Toast.fire({ icon, title: mensaje });
    } catch (error) {
        console.log(error);
    }
};

const eliminarPermiso = async (per_id) => {
    try {
        const url = '/las_aguilas/API/permiso/eliminar';
        const respuesta = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ per_id })
        });
        const data = await respuesta.json();
        const { codigo, mensaje } = data;
        let icon = codigo === 1 ? 'success' : 'error';
        if (codigo === 1) {
            buscarPermisos();
        }
        Toast.fire({ icon, title: mensaje });
    } catch (error) {
        console.log(error);
    }
};

const cancelarModificacion = () => {
    formulario.reset();
    btnGuardar.parentElement.style.display = '';
    btnModificar.parentElement.style.display = 'none';
    btnCancelar.parentElement.style.display = 'none';
};

formulario.addEventListener('submit', guardarPermiso);
btnModificar.addEventListener('click', modificarPermiso);
btnCancelar.addEventListener('click', cancelarModificacion);

document.addEventListener('DOMContentLoaded', () => {
    cargarRoles();
    cargarUsuarios();
    buscarPermisos();
});

import { Dropdown } from "bootstrap";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('formUsuario');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.parentElement.style.display = 'none';
btnModificar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
btnCancelar.disabled = true;

let usuariosData = []; 

const cargarEmpleadosActivos = async () => {
    try {
        const url = '/las_aguilas/API/empleado/buscar';
        const respuesta = await fetch(url);
        const data = await respuesta.json();
        const empleadosActivos = data.datos.filter(empleado => empleado.emp_situacion === '1');

        const listaEmpleados = document.getElementById('listaEmpleados');
        listaEmpleados.innerHTML = '';

        empleadosActivos.forEach(empleado => {
            const li = document.createElement('li');
            li.textContent = ${empleado.emp_nombre} - ACTIVO;
            listaEmpleados.appendChild(li);
        });
    } catch (error) {
        console.log(error);
    }
};

const guardar = async (e) => {
    e.preventDefault();
    if (!validarFormulario(formulario, ['usu_id'])) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }
    try {
        const body = new FormData(formulario);
        const url = "/las_aguilas/API/usuario/guardar";
        const config = {
            method: 'POST',
            body
        };
        const respuesta = await fetch(url, config);
        
        if (!respuesta.ok) {
            const errorText = await respuesta.text(); // Obtener el texto de error
            console.error('Error en la respuesta del servidor:', errorText);
            throw new Error('Error en la respuesta del servidor');
        }

        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        if (codigo == 1) {
            icon = 'success';
            formulario.reset();
            buscar();
        } else {
            icon = 'error';
            console.log(detalle);
        }
        Toast.fire({
            icon: icon,
            title: mensaje
        });
    } catch (error) {
        console.error('Error al guardar:', error);
        Swal.fire({
            title: "Error",
            text: "Hubo un problema al guardar el usuario.",
            icon: "error"
        });
    }
};


const traerDatos = (usuario) => {
    formulario.usu_id.value = usuario.usu_id;
    formulario.usu_nombre.value = usuario.usu_nombre;
    formulario.usu_catalogo.value = usuario.usu_catalogo;
    formulario.usu_password.value = usuario.usu_password;
    formulario.usu_situacion.value = usuario.usu_situacion;

    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.parentElement.style.display = '';
    btnModificar.disabled = false;
    btnCancelar.parentElement.style.display = '';
    btnCancelar.disabled = false;
}

const cancelar = () => {
    formulario.reset();
    btnGuardar.parentElement.style.display = '';
    btnGuardar.disabled = false;
    btnModificar.parentElement.style.display = 'none';
    btnModificar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
}

const modificar = async (e) => {
    e.preventDefault();
    if (!validarFormulario(formulario)) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }
    try {
        const body = new FormData(formulario);
        const url = "/las_aguilas/API/usuario/modificar";
        const config = {
            method: 'POST',
            body
        };
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        if (codigo == 1) {
            icon = 'success';
            formulario.reset();
            buscar();
            cancelar();
        } else {
            icon = 'error';
            console.log(detalle);
        }
        Toast.fire({
            icon: icon,
            title: mensaje
        });
    } catch (error) {
        console.log(error);
    }
}

const eliminar = async (usu_id) => {
    let confirmacion = await Swal.fire({
        icon: 'question',
        title: 'Confirmación',
        text: '¿Está seguro que desea eliminar este registro?',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    });
    if (confirmacion.isConfirmed) {
        try {
            const body = new FormData();
            body.append('usu_id', usu_id);
            const url = "/las_aguilas/API/usuario/eliminar";
            const config = {
                method: 'POST',
                body
            };
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { codigo, mensaje, detalle } = data;
            let icon = 'info';
            if (codigo == 1) {
                icon = 'success';
                formulario.reset();
                buscar();
            } else {
                icon = 'error';
                console.log(detalle);
            }
            Toast.fire({
                icon: icon,
                title: mensaje
            });
        } catch (error) {
            console.log(error);
        }
    }
};

const buscar = async (e) => {
    e && e.preventDefault();
    try {
        const url = '/las_aguilas/API/usuario/buscar';
        const headers = new Headers();
        headers.append('X-Requested-With', 'fetch');
        const config = {
            method: 'GET',
            headers,
        };
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        usuariosData = data.datos || [];
        console.log(usuariosData)
        datatable.clear().draw();
        if (usuariosData.length > 0) {
            datatable.rows.add(usuariosData).draw();
        } else {
            Toast.fire({
                icon: 'info',
                title: 'No hay datos registrados'
            });
        }
    } catch (error) {
        console.log(error);
    }
};

const datatable = new DataTable('#tablaUsuario', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: "No.",
            render: (data, type, row, meta) => {
                return meta.row + 1;
            }
        },
        {
            title: "NOMBRE",
            data: 'usu_nombre'
        },
        {
            title: "CATALOGO",
            data: 'usu_catalogo'
        },
        {
            title: "PASSWORD",
            data: 'usu_password'
        },
        {
            title: "SITUACIÓN",
            data: 'usu_situacion',
            render: (data) => data === "1" ? "ACTIVO" : data 
        },
        {
            title: "MODIFICAR",
            data: 'usu_id',
            render: (data) => <button class="btn btn-warning btn-modificar" data-id="${data}">Modificar</button>
        },
        {
            title: "ELIMINAR",
            data: 'usu_id',
            render: data => <button class="btn btn-danger btn-eliminar" data-id="${data}">Eliminar</button>
        },
    ]
});

buscar();

datatable.on('click', '.btn-modificar', (e) => {
    const usu_id = e.currentTarget.dataset.id; 
    const usuario = usuariosData.find(usu => usu.usu_id === usu_id); 
    if (usuario) {
        traerDatos(usuario); 
    }
});

datatable.on('click', '.btn-eliminar', (e) => {
    const usu_id = e.currentTarget.dataset.id; 
    eliminar(usu_id); 
});

cargarEmpleadosActivos();
formulario.addEventListener('submit', guardar);
btnCancelar.addEventListener('click', cancelar);
btnModificar.addEventListener('click', modificar);

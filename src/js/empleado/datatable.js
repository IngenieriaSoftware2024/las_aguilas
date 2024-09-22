import { Dropdown } from "bootstrap";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('formEmpleado');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.parentElement.style.display = 'none';
btnModificar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
btnCancelar.disabled = true;

let empleadosData = []; // Variable global para almacenar los datos

const guardar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario, ['emp_id'])) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = "/las_aguilas/API/empleado/guardar";
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

const traerDatos = (empleado) => {
    console.log(empleado);
    formulario.emp_id.value = empleado.emp_id;
    formulario.emp_nombre.value = empleado.emp_nombre;
    formulario.emp_dpi.value = empleado.emp_dpi;
    formulario.emp_direccion.value = empleado.emp_direccion;
    formulario.emp_tel.value = empleado.emp_tel;
    formulario.emp_situacion.value = empleado.emp_situacion;

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
        const url = "/las_aguilas/API/empleado/modificar";
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

const eliminar = async (emp_id) => {
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
            body.append('emp_id', emp_id);
            const url = "/las_aguilas/API/empleado/eliminar";
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
        const url = '/las_aguilas/API/empleado/buscar';
        const headers = new Headers();
        headers.append('X-Requested-With', 'fetch');
        const config = {
            method: 'GET',
            headers,
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);

        empleadosData = data.datos || []; // Almacena los datos de empleados

        datatable.clear().draw();

        if (empleadosData.length > 0) {
            datatable.rows.add(empleadosData).draw();
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

const datatable = new DataTable('#tablaEmpleado', {
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
            data: 'emp_nombre'
        },
        {
            title: "DPI",
            data: 'emp_dpi'
        },
        {
            title: "DIRECCIÓN",
            data: 'emp_direccion'
        },
        {
            title: "TELÉFONO",
            data: 'emp_tel'
        },
        {
            title: "SITUACIÓN",
            data: 'emp_situacion',
            render: (data) => data === "1" ? "ACTIVO" : data // Cambia 1 por ACTIVO
        },
        {
            title: "MODIFICAR",
            data: 'emp_id',
            render: (data) => `<button class="btn btn-warning btn-modificar" data-id="${data}">Modificar</button>`
        },
        {
            title: "ELIMINAR",
            data: 'emp_id',
            render: data => `<button class="btn btn-danger btn-eliminar" data-id="${data}">Eliminar</button>`
        },
    ]
});

// Llama a la función para buscar los datos
buscar();

datatable.on('click', '.btn-modificar', (e) => {
    const emp_id = e.currentTarget.dataset.id; // Obtener el ID del empleado desde el botón
    const empleado = empleadosData.find(emp => emp.emp_id === emp_id); // Buscar el empleado en el array
    console.log(empleado); // Verifica que obtienes el objeto correcto
    if (empleado) {
        traerDatos(empleado); // Llama a la función para llenar el formulario
    } else {
        console.error("Empleado no encontrado");
    }
});

datatable.on('click', '.btn-eliminar', (e) => {
    const emp_id = e.currentTarget.dataset.id; // Obtener el ID del empleado
    eliminar(emp_id); // Llamar a la función de eliminar
});

// Eventos de formulario
formulario.addEventListener('submit', guardar);
btnCancelar.addEventListener('click', cancelar);
btnModificar.addEventListener('click', modificar);

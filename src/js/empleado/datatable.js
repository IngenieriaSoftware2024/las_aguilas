import { Dropdown } from "bootstrap";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

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
        console.log(data); // Aquí vemos la estructura de datos

        datatable.clear().draw();

        // Verifica que los datos estén en el array correcto
        if (data && data.datos && Array.isArray(data.datos) && data.datos.length > 0) {
            datatable.rows.add(data.datos).draw(); // Agrega el array de empleados
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
                return meta.row + 1; // Muestra el número de la fila
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
            data: 'emp_situacion'
        },
        {
            title: "MODIFICAR",
            data: 'emp_id',
            render: (data, meta, row, type) => `<button class="btn btn-warning">Modificar</button>`
        },
        {
            title: "ELIMINAR",
            data: 'emp_id',
            render: data => `<button class="btn btn-danger">Eliminar</button>`
        },
    ]
});

// Llama a la función para buscar los datos
buscar();

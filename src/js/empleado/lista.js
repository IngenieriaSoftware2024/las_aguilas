import { Dropdown } from "bootstrap";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

let empleadosData = []; // Variable global para almacenar los datos de los empleados

// Función para buscar los datos
const buscar = async () => {
    try {
        const url = '/las_aguilas/API/empleado/buscar'; // URL de la API que obtiene los datos
        const headers = new Headers();
        headers.append('X-Requested-With', 'fetch'); // Encabezado opcional para solicitudes AJAX
        const config = {
            method: 'GET',
            headers,
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);

        empleadosData = data.datos || []; // Almacena los datos de empleados

        datatable.clear().draw(); // Limpia la tabla antes de llenarla

        if (empleadosData.length > 0) {
            datatable.rows.add(empleadosData).draw(); // Agrega y muestra los nuevos datos
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

// Inicialización de DataTable
const datatable = new DataTable('#tablaEmpleado', {
    language: lenguaje, // Cambia el lenguaje de la tabla (puedes ajustar esto a tus necesidades)
    data: null, // Inicialmente no hay datos
    columns: [
        {
            title: "No.",
            render: (data, type, row, meta) => {
                return meta.row + 1; // Número de fila
            }
        },
        {
            title: "NOMBRE",
            data: 'emp_nombre' // Nombre del empleado
        },
        {
            title: "DPI",
            data: 'emp_dpi' // DPI del empleado
        },
        {
            title: "DIRECCIÓN",
            data: 'emp_direccion' // Dirección del empleado
        },
        {
            title: "TELÉFONO",
            data: 'emp_tel' // Teléfono del empleado
        },
        {
            title: "SITUACIÓN",
            data: 'emp_situacion',
            render: (data) => data === "1" ? "ACTIVO" : "INACTIVO" // Muestra ACTIVO si el valor es 1
        },
    ]
});

// Llama a la función para buscar los datos al cargar la página
buscar();

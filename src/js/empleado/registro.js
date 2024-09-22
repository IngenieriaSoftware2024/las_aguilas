import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

// Seleccionamos los elementos del DOM
const formulario = document.getElementById('formEmpleado');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

// Inicializamos algunos botones que aún no se usan en este momento
btnModificar.parentElement.style.display = 'none';
btnModificar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
btnCancelar.disabled = true;

// Función para guardar el nuevo empleado
const guardar = async (e) => {
    e.preventDefault();

    // Validación de formulario
    if (!validarFormulario(formulario, ['emp_id'])) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        // Recolectamos los datos del formulario
        const body = new FormData(formulario);
        const url = "/las_aguilas/API/empleado/guardar"; // URL donde se enviarán los datos
        const config = {
            method: 'POST',
            body
        };

        // Enviamos los datos al servidor
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        // Verificamos la respuesta del servidor
        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        if (codigo == 1) {
            icon = 'success';
            formulario.reset();  // Reiniciamos el formulario
            buscar();  // Recargamos la tabla con los datos nuevos
        } else {
            icon = 'error';
            console.log(detalle);
        }

        // Mostramos una alerta con el resultado
        Toast.fire({
            icon: icon,
            title: mensaje
        });
    } catch (error) {
        console.log(error);
    }
}

// Función para cancelar la operación actual
const cancelar = () => {
    formulario.reset(); // Limpia los campos del formulario
    btnGuardar.parentElement.style.display = ''; // Muestra el botón de guardar
    btnGuardar.disabled = false; // Habilita el botón de guardar
    btnModificar.parentElement.style.display = 'none'; // Oculta el botón de modificar
    btnModificar.disabled = true; // Deshabilita el botón de modificar
    btnCancelar.parentElement.style.display = 'none'; // Oculta el botón de cancelar
    btnCancelar.disabled = true; // Deshabilita el botón de cancelar
}

// Función para buscar empleados (aquí sólo para recargar la tabla si es necesario)
const buscar = async () => {
    // Implementación para buscar empleados, si fuera necesario.
};

// Eventos del formulario
formulario.addEventListener('submit', guardar);
btnCancelar.addEventListener('click', cancelar);

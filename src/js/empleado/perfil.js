import { Dropdown } from "bootstrap";
import { BootstrapTheme } from "fullcalendar";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('formBuscar');
const info = document.getElementById('info');
const overlay = document.getElementById('overlay');
const closePerfil = document.getElementById('closePerfil');
const tablaEmpleados = document.getElementById('tablaEmpleados').getElementsByTagName('tbody')[0];
const send = document.getElementById('send');

const cargarEmpleadosActivos = async () => {
    try {
        const url = "/las_aguilas/API/empleado/buscar";
        const respuesta = await fetch(url, { method: 'GET' });
        if (respuesta.ok) {
            const empleadosResponse = await respuesta.json();
            const empleados = empleadosResponse.datos;

            empleados.forEach(empleado => {
                if (empleado.emp_situacion === "1") {
                    const fila = tablaEmpleados.insertRow();
                    fila.innerHTML = `
                        <td>${empleado.emp_id}</td>
                        <td>${empleado.emp_nombre}</td>
                        <td>${empleado.emp_dpi}</td>
                        <td>${empleado.emp_tel}</td>
                        <td>${empleado.emp_direccion}</td>
                    `;
                }
            });
        } else {
            console.error('Error al cargar los empleados');
        }
    } catch (error) {
        console.log("Error:", error.message);
    }
};

const buscar = async (e) => {
    e.preventDefault();
    const name = document.getElementById('emp_nombre').value.trim();
    if (name === '') {
        alert('Ingrese un nombre');
        return;
    }

    send.disabled = true;

    try {
        const url = "/las_aguilas/API/empleado/buscar"; 
        const respuesta = await fetch(url, { method: 'GET' });
        if (respuesta.ok) {
            const empleadosResponse = await respuesta.json();
            const empleados = empleadosResponse.datos;
            const empleadoEncontrado = empleados.find(emp => emp.emp_nombre.toLowerCase() === name.toLowerCase());

            if (empleadoEncontrado) {
                document.getElementById('nombreEmpleado').textContent = `Nombre: ${empleadoEncontrado.emp_nombre}`;
                document.getElementById('dpiEmpleado').textContent = `DPI: ${empleadoEncontrado.emp_dpi}`;
                document.getElementById('direccionEmpleado').textContent = `Dirección: ${empleadoEncontrado.emp_direccion}`;
                document.getElementById('situacionEmpleado').textContent = `Situación: ${empleadoEncontrado.emp_situacion}`;
                document.getElementById('telEmpleado').textContent = `Teléfono: ${empleadoEncontrado.emp_tel}`;

                info.style.display = 'block';
                overlay.style.display = 'block';
            } else {
                alert('Empleado no encontrado');
            }
        } else {
            console.error('Error al buscar el empleado');
        }
    } catch (error) {
        console.log("Error:", error.message);
    } finally {
        send.disabled = false; 
    }
};

closePerfil.addEventListener('click', () => {
    info.style.display = 'none';
    overlay.style.display = 'none';
});

formulario.addEventListener('submit', buscar);
cargarEmpleadosActivos(); 
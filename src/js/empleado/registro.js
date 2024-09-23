import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('formEmpleado');
const btnGuardar = document.getElementById('btnGuardar');

const guardar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario, ['emp_id'])) {
        Swal.fire({
            title: "Campos vacíos",
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

formulario.addEventListener('submit', guardar);


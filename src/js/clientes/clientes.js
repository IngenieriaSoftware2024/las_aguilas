import { Dropdown } from "bootstrap";
import { validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('form-cliente');
const BtnEnviar = document.getElementById('BtnEnviar');



const GuardarClientes = async (e) => {
    e.preventDefault();
    BtnEnviar.disabled = true;

    if (!validarFormulario(formulario, ['cliente_id'])) {
        Swal.fire({
            title: "¡Atención!",
            text: "Por favor, completa todos los campos requeridos.",
            icon: "warning",
            background: '#e3f2fd',
            color: '#1e88e5',
            confirmButtonColor: '#42a5f5',
            confirmButtonText: 'Entendido',
            customClass: {
                popup: 'animated bounceIn',
            }
        });
        BtnEnviar.disabled = false;
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = '/las_aguilas/API/cliente/guardar';

        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        
        console.log(data);


    } catch (error) {
        console.log(error);
    }


}

document.getElementById('cliente_contrato').addEventListener('change', function () {
    const NombrePDF = this.files[0] ? this.files[0].name : 'Seleccionar archivo...';
    document.querySelector('.form-control').placeholder = NombrePDF;
});
formulario.addEventListener('submit', GuardarClientes);
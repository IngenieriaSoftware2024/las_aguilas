import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario } from "../funciones";

const formulario = document.getElementById('form-factura');
const BtnGenerar = document.getElementById('BtnGenerar');
const BtnMostrarFacturas = document.getElementById('BtnMostrarFacturas');
const BtnBuscar = document.getElementById('BtnBuscar');
const inputNit = document.getElementById('factura_nit');
const inputClienteSeleccionado = document.getElementById('factura_cliente');

const GenerarFactura = async (e) => {
    e.preventDefault();
    BtnGenerar.disabled = true;
    
    if (!validarFormulario(formulario)) {
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
        BtnGenerar.disabled = false;
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = '/las_aguilas/API/factura/generar';

        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        const { codigo, mensaje, detalle } = data

        if (codigo == 1) {

            Swal.fire({
                title: '¡Éxito!',
                text: mensaje,
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#e0f7fa',
                customClass: {
                    title: 'custom-title-class',
                    text: 'custom-text-class'
                }

            });
            formulario.reset();
        } else {
            Swal.fire({
                title: '¡Error!',
                text: mensaje,
                icon: 'warning',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#e0f7fa',
                customClass: {
                    title: 'custom-title-class',
                    text: 'custom-text-class'
                }

            });
        }


    } catch (error) {
        console.log(error);
    }

    BtnGenerar.disabled = false;
}

inputClienteSeleccionado.addEventListener('change', () => {

    const OpcionSeleccionada = inputClienteSeleccionado.options[inputClienteSeleccionado.selectedIndex];
    const NitCliente = OpcionSeleccionada.getAttribute('value');

    if (NitCliente) {
        inputNit.value = NitCliente; 
    } 
})


formulario.addEventListener('submit', GenerarFactura)
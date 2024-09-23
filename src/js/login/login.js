document.addEventListener('DOMContentLoaded', () => {

    const { default: Swal } = require("sweetalert2");
    const { validarFormulario } = require("../funciones");

    const formulario = document.querySelector('form');

    const IniciarSesion = async (e) => {
        e.preventDefault();

        if (!validarFormulario(formulario)) {
            Swal.fire({
                title: "Campos vacios",
                text: "Debe llenar todos los campos",
                icon: "info"
            })
            return
        }

        try {
            const body = new FormData(formulario)
            const url = '/las_aguilas/API/login';

            const config = {
                method: 'POST',
                body
            }

            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { codigo, mensaje, detalle } = data
    
          
                formulario.reset();
                location.href = '/las_aguilas/menu'

        } catch (error) {
            console.log(error)
        }

    }

    formulario.addEventListener('submit', IniciarSesion)
});
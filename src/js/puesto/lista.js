import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";


const tabla = document.getElementById('tablaPuestos')

let contador = 1;
const datatable = new DataTable('#tablaPuestos', {
    data: null,
    language: lenguaje,
    pageLength: '15',
    lengthMenu: [3, 9, 11, 25, 100],
    columns: [
        {
            title: 'No.',
            data: 'puesto_id',
            width: '2%',
            render: (data, type, row, meta) => {
                // console.log(meta.ro);
                return meta.row + 1;
            }
        },
        {
            title: 'Nombre del Puesto',
            data: 'puesto_nombre'
        },
        {
            title: 'Descripción del Puesto',
            data: 'puesto_descripcion'
        },
        {
            title: 'Salario del Puesto',
            data: 'puesto_salario'
        },
        {
            title: 'Direccion del Puesto',
            data: 'puesto_direccion'
        },
        {
            title: 'Cliente',
            data: 'cliente_nombre'
        },

    ]
})


const buscar = async () => {
    try {
        const url = "/las_aguilas/API/puesto/buscar"
        const config = {
            method: 'GET',
        }

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle, datos } = data;

        // tabla.tBodies[0].innerHTML = ''
        // const fragment = document.createDocumentFragment();
        console.log(datos);
        datatable.clear().draw();

        if (datos) {
            datatable.rows.add(datos).draw();
        }
        

    } catch (error) {
        console.log(error);
    }
}
buscar();

const traerDatos = (e) => {
    const elemento = e.currentTarget.dataset

    formulario.puesto_id.value = elemento.puesto_id
    formulario.puesto_nombre.value = elemento.puesto_nombre
    formulario.puesto_descripcion.value = elemento.puesto_descripcion
    formulario.puesto_salario.value = elemento.puesto_salario
    formulario.puesto_direccion.value = elemento.puesto_direccion
    formulario.puesto_cliente.value = elemento.puesto_cliente
    tabla.parentElement.parentElement.style.display = 'none'

    btnGuardar.parentElement.style.display = 'none'
    btnGuardar.disabled = true
    btnModificar.parentElement.style.display = ''
    btnModificar.disabled = false
    btnCancelar.parentElement.style.display = ''
    btnCancelar.disabled = false
}

const cancelar = () => {
    tabla.parentElement.parentElement.style.display = ''
    formulario.reset();
    btnGuardar.parentElement.style.display = ''
    btnGuardar.disabled = false
    btnModificar.parentElement.style.display = 'none'
    btnModificar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
}

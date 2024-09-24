import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const tabla = document.getElementById('tablaTurnos')


let contador = 1;
const datatable = new DataTable('#tablaTurnos', {
    data: null,
    language: lenguaje,
    pageLength: '15',
    lengthMenu: [3, 9, 11, 25, 100],
    columns: [
        {
            title: 'No.',
            data: 'turno_id',
            width: '2%',
            render: (data, type, row, meta) => {
                // console.log(meta.ro);
                return meta.row + 1;
            }
        },
        {
            title: 'Empleado',
            data: 'emp_nombre'
        },
        {
            title: 'Puesto',
            data: 'puesto_nombre'
        },
        {
            title: 'Fecha Inicio',
            data: 'turno_fecha_inicio'
        },
        {
            title: 'Fecha Fin',
            data: 'turno_fecha_fin'
        },
       
    ]
})

const buscar = async () => {
    try {
        const url = "/las_aguilas/API/turno/buscar"
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

    formulario.turno_id.value = elemento.turno_id
    formulario.turno_empleado.value = elemento.turno_empleado
    formulario.turno_puesto.value = elemento.turno_puesto
    formulario.turno_fecha_inicio.value = elemento.turno_fecha_inicio
    formulario.turno_fecha_fin.value = elemento.turno_fecha_fin
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




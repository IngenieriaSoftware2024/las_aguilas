import { Dropdown } from "bootstrap";
import { Toast, validarFormulario } from "../funciones";
import Swal from "sweetalert2";

const formulario = document.getElementById('formEmpleado');
const tabla = document.getElementById('tablaEmpleado');
const btnGuardar = document.getElementById('btnGuardar');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');

btnModificar.parentElement.style.display = 'none';
btnModificar.disabled = true;
btnCancelar.parentElement.style.display = 'none';
btnCancelar.disabled = true;

const guardar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario, ['emp_id'])) {
        Swal.fire({
            title: "Campos vacios",
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
            buscar();
        } else {
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

const buscar = async () => {
    try {
        const url = "/las_aguilas/API/empleado/buscar";
        const config = {
            method: 'GET',
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle, datos } = data;
        tabla.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        console.log(datos);
        if (codigo == 1) {
            let counter = 1;
            datos.forEach(empleado => {
                const tr = document.createElement('tr');
                const td1 = document.createElement('td');
                const td2 = document.createElement('td');
                const td3 = document.createElement('td');
                const td4 = document.createElement('td');
                const td5 = document.createElement('td');
                const td6 = document.createElement('td');
                const td7 = document.createElement('td');
                const td8 = document.createElement('td');

                const buttonModificar = document.createElement('button');
                const buttonEliminar = document.createElement('button');
                td1.innerText = counter;
                td2.innerText = empleado.emp_nombre;
                td3.innerText = empleado.emp_dpi;
                td4.innerText = empleado.emp_direccion;
                td5.innerText = empleado.emp_tel;
                td6.innerText = empleado.emp_situacion === 1 ? 'Activo' : 'Inactivo';

                buttonModificar.classList.add('btn', 'btn-warning');
                buttonEliminar.classList.add('btn', 'btn-danger');
                buttonModificar.innerText = 'Modificar';
                buttonEliminar.innerText = 'Eliminar';

                buttonModificar.addEventListener('click', () => traerDatos(empleado));
                buttonEliminar.addEventListener('click', () => eliminar(empleado));

                td7.appendChild(buttonModificar);
                td8.appendChild(buttonEliminar);

                counter++;

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td6);
                tr.appendChild(td7);
                tr.appendChild(td8);



                fragment.appendChild(tr);
            });
        } else {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.innerText = "No hay empleados";
            td.colSpan = 6;

            tr.appendChild(td);
            fragment.appendChild(tr);
        }

        tabla.tBodies[0].appendChild(fragment);
    } catch (error) {
        console.log(error);
    }
}
buscar();

const traerDatos = (empleado) => {
    console.log(empleado);
    formulario.emp_id.value = empleado.emp_id;
    formulario.emp_nombre.value = empleado.emp_nombre;
    formulario.emp_dpi.value = empleado.emp_dpi;
    formulario.emp_direccion.value = empleado.emp_direccion;
    formulario.emp_tel.value = empleado.emp_tel;
    formulario.emp_situacion.value = empleado.emp_situacion;

    tabla.parentElement.parentElement.style.display = 'none';

    btnGuardar.parentElement.style.display = 'none';
    btnGuardar.disabled = true;
    btnModificar.parentElement.style.display = '';
    btnModificar.disabled = false;
    btnCancelar.parentElement.style.display = '';
    btnCancelar.disabled = false;
}

const cancelar = () => {
    tabla.parentElement.parentElement.style.display = '';
    formulario.reset();
    btnGuardar.parentElement.style.display = '';
    btnGuardar.disabled = false;
    btnModificar.parentElement.style.display = 'none';
    btnModificar.disabled = true;
    btnCancelar.parentElement.style.display = 'none';
    btnCancelar.disabled = true;
}

const modificar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario)) {
        Swal.fire({
            title: "Campos vacios",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = "/las_aguilas/API/empleado/modificar";
        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje, detalle } = data;
        console.log(data);
        let icon = 'info';
        if (codigo == 1) {
            icon = 'success';
            formulario.reset();
            buscar();
            cancelar();
        } else {
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

const eliminar = async (empleado) => {
    let confirmacion = await Swal.fire({
        icon: 'question',
        title: 'Confirmación',
        text: '¿Está seguro que desea eliminar este registro?',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    });

    if (confirmacion.isConfirmed) {
        try {
            const body = new FormData();
            body.append('emp_id', empleado.emp_id);
            const url = "/las_aguilas/API/empleado/eliminar";
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
                buscar();
            } else {
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
};

formulario.addEventListener('submit', guardar);
btnCancelar.addEventListener('click', cancelar);
btnModificar.addEventListener('click', modificar);

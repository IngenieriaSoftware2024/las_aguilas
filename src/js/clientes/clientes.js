import { Dropdown } from "bootstrap";
import { validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const formulario = document.getElementById('form-cliente');
const BtnEnviar = document.getElementById('BtnEnviar');
const BtnMostrar = document.getElementById('BtnMostrar');
const TablaClientes = document.getElementById('ClientesRegistrados');
const BtnVolver = document.getElementById('BtnVolver');
const tablaClientesContainer = document.getElementById('tabla-clientes-container');
const BtnModificar = document.getElementById('BtnModificar');
const BtnCancelar = document.getElementById('BtnCancelar');

BtnModificar.parentElement.classList.add('d-none');
BtnCancelar.parentElement.classList.add('d-none');
tablaClientesContainer.classList.add('d-none');


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

    BtnEnviar.disabled = false;
}

const Buscar = async () => {
    const url = '/las_aguilas/API/clientes/buscar';

    const config = {
        method: 'GET'
    };

    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();

    // console.log(datos)
    datatable.clear().draw();

    if (datos) {
        datatable.rows.add(datos).draw();
    }

};

const datatable = new DataTable('#ClientesRegistrados', {
    data: null,
    language: lenguaje,
    columns: [
        {
            title: 'No.',
            data: 'cliente_id',
            render: (data, type, row, meta) => {
                return meta.row + 1;
            }
        },
        {
            title: 'Nombre de la Empresa',
            data: 'cliente_nombre'
        },
        {
            title: 'Propietario',
            data: 'cliente_propietario'
        },
        {
            title: 'NIT',
            data: 'cliente_nit'
        },
        {
            title: 'Teléfono',
            data: 'cliente_telefono'
        },
        {
            title: 'Correo Electrónico',
            data: 'cliente_email'
        },
        {
            title: 'Ubicación',
            data: 'cliente_ubicacion'
        },
        {
            title: 'Contrato',
            data: 'cliente_nit',
            render: (data, type, row) => {
                return `<button class="btn btn-primary ver-contrato" data-nit="${data}">Ver Contrato</button>`;
            }
        },
        {
            title: 'Acciones',
            data: 'cliente_id',
            searchable: false,
            orderable: false,
            render: (data, type, row) => {
                return `
                    <div class='d-flex justify-content-center'>
                    <button class='btn btn-warning modificar mx-1' 
                        data-cliente-id="${data}" 
                        data-cliente-nombre="${row.cliente_nombre}" 
                        data-cliente-propietario="${row.cliente_propietario}" 
                        data-cliente-nit="${row.cliente_nit}" 
                        data-cliente-telefono="${row.cliente_telefono}" 
                        data-cliente-email="${row.cliente_email}" 
                        data-cliente-ubicacion="${row.cliente_ubicacion}">
                        <i class='bi bi-pencil-square'></i> Modificar
                    </button>
                        <button class='btn btn-danger eliminar mx-1' data-id="${data}">
                            <i class='bi bi-trash'></i> Eliminar
                        </button>
                    </div>
                `;
            }
        },
    ]
});


const BuscarContrato = async (nit) => {
    const buscar = nit.currentTarget.dataset.nit;

    const url = `/las_aguilas/API/cliente/MostrarContrato?nit=${buscar}`;

    const config = {
        method: 'GET'
    };

    let AlertaCargando = Swal.fire({
        title: 'Cargando',
        text: 'Por favor espera mientras se carga el contrato...',
        icon: 'info',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    try {
        const respuesta = await fetch(url, config);
        Swal.close();
        if (!respuesta.ok) {
            throw new Error('Error en la respuesta de la red');
        }


        const blob = await respuesta.blob();
        const newTab = window.open(URL.createObjectURL(blob), '_blank');
        if (!newTab) {
            Swal.fire({
                title: '¡Atención!',
                text: 'Por favor, permite las ventanas emergentes para ver el contrato.',
                icon: 'warning',
                confirmButtonText: 'Entendido'
            });
            // HABILITAR ALERTA, QUE INDICA QUE EL ARCHIVO SE CARGO
            // } else {
            //     Swal.fire({
            //         title: '¡Éxito!',
            //         text: 'El contrato se ha cargado correctamente.',
            //         icon: 'success',
            //         confirmButtonText: '¡Genial!',
            //         background: '#e3f2fd',
            //         color: '#1e88e5',
            //         confirmButtonColor: '#42a5f5',
            //         customClass: {
            //             title: 'custom-title-class',
            //             text: 'custom-text-class',
            //             confirmButton: 'custom-confirm-button'
            //         }
            //     });
        }

    } catch (error) {
        Swal.close();

        console.error('Error:', error);
        Swal.fire({
            title: '¡Error!',
            text: 'Hubo un problema al intentar cargar el contrato.',
            icon: 'error'
        });
    }
};

datatable.on('click', '.ver-contrato', BuscarContrato)

const llenarDatos = (e) => {
    BtnEnviar.parentElement.classList.add('d-none');
    BtnModificar.parentElement.classList.remove('d-none');
    BtnCancelar.parentElement.classList.remove('d-none');
    BtnMostrar.parentElement.classList.add('d-none')
    const elemento = e.currentTarget.dataset;

    VolverAlFormulario();

    formulario.cliente_id.value = elemento.clienteId; 
    formulario.cliente_nombre.value = elemento.clienteNombre;
    formulario.cliente_propietario.value = elemento.clientePropietario;
    formulario.cliente_nit.value = elemento.clienteNit;
    formulario.cliente_telefono.value = elemento.clienteTelefono;
    formulario.cliente_email.value = elemento.clienteEmail;
    formulario.cliente_ubicacion.value = elemento.clienteUbicacion;

    document.getElementById('cliente_contrato').disabled = true;
    document.getElementById('cliente_nit').disabled = true;
};

const Modificar = async (e) => {
    e.preventDefault();

    if (!validarFormulario(formulario, ['cliente_contrato'])) {
        Swal.fire({
            title: "Campos vacíos",
            text: "Debe llenar todos los campos",
            icon: "info"
        });
        return;
    }

    try {
        const body = new FormData(formulario);
        const url = '/las_aguilas/API/cliente/modificar';

        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        const { codigo, mensaje } = data;

        if (codigo === 3) {
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
            document.getElementById('cliente_contrato').disabled = false;
            document.getElementById('cliente_nit').disabled = false;
            formulario.reset();
            MostrarDatos();
        } else {
            Swal.fire({
                title: '¡Error!',
                text: mensaje,
                icon: 'error',
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
};

const Cancelar = () => {
    BtnEnviar.parentElement.classList.remove('d-none');
    BtnModificar.parentElement.classList.add('d-none');
    BtnCancelar.parentElement.classList.add('d-none');
    BtnMostrar.parentElement.classList.remove('d-none');
    formulario.reset();
    
};

const MostrarDatos = () => {
    formulario.classList.add('d-none');
    tablaClientesContainer.classList.remove('d-none');
    Buscar();
};

const VolverAlFormulario = () => {
    formulario.classList.remove('d-none');
    tablaClientesContainer.classList.add('d-none');
};


document.getElementById('cliente_contrato').addEventListener('change', function () {
    const NombrePDF = this.files[0] ? this.files[0].name : 'Seleccionar archivo...';
    document.querySelector('.form-control').placeholder = NombrePDF;
});

BtnVolver.addEventListener('click', VolverAlFormulario);
BtnMostrar.addEventListener('click', MostrarDatos);
formulario.addEventListener('submit', GuardarClientes);
BtnModificar.addEventListener('click', Modificar);
BtnCancelar.addEventListener('click', Cancelar)

datatable.on('click', '.modificar', llenarDatos)


Buscar();
import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario } from "../funciones";
import { lenguaje } from "../lenguaje";
import DataTable from "datatables.net-bs5";

const formulario = document.getElementById('form-factura');
const BtnGenerar = document.getElementById('BtnGenerar');
const BtnMostrarFacturas = document.getElementById('BtnMostrarFacturas');
const BtnBuscar = document.getElementById('BtnBuscar');
const inputNit = document.getElementById('factura_nit');
const inputClienteSeleccionado = document.getElementById('factura_cliente');
const TablaFacturas = document.getElementById('FacturasRegistradas');

const GenerarFactura = async (e) => {
    e.preventDefault();
    BtnGenerar.disabled = true;
    
    if (!validarFormulario(formulario, ['factura_correlativo'])) {
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
        // console.log(data);

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
            Buscar();
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



const llenarDatos =  async () => {

    const OpcionSeleccionada = inputClienteSeleccionado.options[inputClienteSeleccionado.selectedIndex];
    const NitCliente = OpcionSeleccionada.getAttribute('data-codigo');
    const idCliente = OpcionSeleccionada.getAttribute('value');


    if (idCliente) {
        inputNit.value = NitCliente;

        try {
            
            const url = '/las_aguilas/API/totalempleados/buscar?id='+idCliente+'';
    
            const config = {
                method: 'GET'
            };
        
            const respuesta = await fetch(url, config);
            const datos = await respuesta.json(); 
            console.log(datos)

            if (datos != null) {
                
                const cantidad = datos.cantidad;  
                const puesto = datos.puesto;      
                const salario = datos.salario;    

                const total = cantidad * salario;

                document.getElementById('detalle_cantidad_empleados').value = cantidad;
                document.getElementById('detalle_empleados').value = puesto;
                document.getElementById('detalle_total').value = total;
                
            } else{
                Swal.fire({
                    title: '¡Error!',
                    text: 'Cliente sin empleados registrados, no puedes generar la factura ni realizar busquedas de facturas.',
                    icon: 'warning',
                    showConfirmButton: true,
                    timerProgressBar: false,
                    background: '#e0f7fa',
                    customClass: {
                        title: 'custom-title-class',
                        text: 'custom-text-class'
                    }
    
                });
            }
        } catch (error) {
            console.log(error)
        }
    } 
};

const Buscar = async () => {
    const url = '/las_aguilas/API/facturas/buscar';

    const config = {
        method: 'GET'
    };

    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();

    // console.log(datos);
    datatable.clear().draw();

    const tablaClientesContainer = document.getElementById('tabla-clientes-container');

    if (datos) {
        datatable.rows.add(datos).draw();
    }
};

const meses = [
    '', 
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre'
];

const datatable = new DataTable('#FacturasRegistradas', {
    data: null,
    language: lenguaje,
    columns: [
        { title: 'No.', data: 'factura_id', render: (data, type, row, meta) => meta.row + 1 },
        { title: 'Nombre de la Empresa', data: 'cliente_nombre' },
        { title: 'No. de Factura', data: 'factura_correlativo' },
        { title: 'Año', data: 'factura_anio' },
        { 
            title: 'Mes', 
            data: 'factura_mes',
            render: (data) => meses[data] || 'Desconocido' 
        },
        {
            title: 'Ver la Factura',
            data: 'detalle_id',
            searchable: false,
            orderable: false,
            render: (data, type, row) => {
                return `<button class="btn btn-info verPdf"  
                            data-clienteId="${row.cliente_id}" 
                            data-facturaId="${row.factura_id}" 
                            data-detalleId="${row.detalle_id}">
                            Abrir Factura</button>`;
            }
        }
    ]
});

const GenerarPdf = async (e) => {
    const elemento = e.currentTarget.dataset;

    let AlertaCargando = Swal.fire({
        title: 'Cargando',
        text: 'Por favor espera mientras se carga la Factura... ¡Gracias por tu comprension!',
        icon: 'info',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    try {
        const body = new FormData();
        body.append('cliente_id', elemento.clienteid);
        body.append('detalle_id', elemento.detalleid);
        body.append('factura_id', elemento.facturaid);

        const url = '/las_aguilas/API/factura/generarPdf';

        const config = {
            method: 'POST',
            body
        };

        const respuesta = await fetch(url, config);
        if (!respuesta.ok) {
            throw new Error('Error en la respuesta de la red');
        }

        const blob = await respuesta.blob();

        Swal.close(); 
        const newTab = window.open(URL.createObjectURL(blob), '_blank');
        if (!newTab) {
            Swal.fire({
                title: '¡Atención!',
                text: 'Por favor, permite las ventanas emergentes para ver el contrato.',
                icon: 'warning',
                confirmButtonText: 'Entendido'
            });
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


const BusquedaPersonalizada = async () => {
    const mes = document.getElementById('factura_mes').value;
    const anio = document.getElementById('factura_anio').value;
    const cliente = document.getElementById('factura_cliente').value;

    let url = '/las_aguilas/API/facturas/busqueda?';

    if (mes) {
        url += `mes=${mes}&`;
    }
    if (anio) {
        url += `anio=${anio}&`;
    }
    if (cliente) {
        url += `cliente=${encodeURIComponent(cliente)}&`;
    }

    if (url.endsWith('&')) {
        url = url.slice(0, -1);
    }

    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();


        if (datos.codigo === 1 && datos.detalle.length > 0) {
            datatable.clear().draw(); 
            datatable.rows.add(datos.detalle).draw(); 

            Swal.fire({
                title: 'Resultados encontrados',
                text: `${datos.detalle.length} resultados encontrados.`,
                icon: 'success',
                timer: 1500,
                timerProgressBar: true,
                background: '#e0f7fa',
                customClass: {
                    title: 'custom-title-class',
                    text: 'custom-text-class'
                }
            });
        } else {
      
            datatable.clear().draw();
            Swal.fire({
                title: 'Sin resultados',
                text: 'No se encontraron facturas que coincidan con los criterios de búsqueda.',
                icon: 'info'
            });
        }
    } catch (error) {
        
        Swal.fire({
            title: 'Error',
            text: 'Hubo un problema al realizar la búsqueda.',
            icon: 'error'
        });
    }
};


Buscar();
inputClienteSeleccionado.addEventListener('change', llenarDatos)
formulario.addEventListener('submit', GenerarFactura);
BtnBuscar.addEventListener('click', BusquedaPersonalizada);
BtnMostrarFacturas.addEventListener('click', Buscar);
datatable.on('click', '.verPdf', GenerarPdf)
import { Dropdown } from "bootstrap";
import { Chart } from "chart.js/auto";

const canvas = document.getElementById('chartTurnosPuesto');
const ctx = canvas.getContext('2d');
const btnactualizar = document.getElementById('actualizarTurnos');

// Configuración inicial de los datos del gráfico
const data = {
    labels: [],  // Nombres de los puestos
    datasets: [{
        label: 'Turnos por Puesto',  // Etiqueta de la gráfica
        data: [],  // Cantidades de turnos por puesto
        borderWidth: 5,
        backgroundColor: []  // Colores para cada barra
    }]
};

// Creación de la gráfica usando Chart.js
const chartCliente = new Chart(ctx, {
    type: 'bar',  // Tipo de gráfica
    data: data,
});

// Función para obtener los datos de la API y actualizar la gráfica
const getEstadisticas = async () => {
    const url = '/las_aguilas/API/turnos/estadisticas';  // URL del nuevo endpoint
    const config = { method: "GET" };
    const response = await fetch(url, config);
    const data = await response.json();

    if (data) {
        if (chartCliente.data.datasets[0]) {
            // Limpiar los datos actuales del gráfico
            chartCliente.data.labels = [];
            chartCliente.data.datasets[0].data = [];
            chartCliente.data.datasets[0].backgroundColor = [];

            // Añadir los datos nuevos obtenidos de la API
            data.forEach(r => {
                chartCliente.data.labels.push(r.puesto);  // Añadir nombre del puesto
                chartCliente.data.datasets[0].data.push(r.cantidad_turnos);  // Añadir cantidad de turnos
                chartCliente.data.datasets[0].backgroundColor.push(generateRandomColor());  // Generar un color aleatorio
            });
        }
    }
    chartCliente.update();  // Actualizar la gráfica
};

// Función para generar colores aleatorios
const generateRandomColor = () => {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);

    return `rgb(${r}, ${g}, ${b})`;
};

// Evento para actualizar la gráfica cuando se hace clic en el botón
btnactualizar.addEventListener('click', getEstadisticas);

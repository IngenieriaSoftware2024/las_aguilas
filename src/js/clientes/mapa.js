import { Dropdown } from "bootstrap";
import L from 'leaflet';


const map = L.map('map', {
    center: [15.783471, -90.230759], 
    zoom: 7,
    layers: []
});


L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


const markerLayer = L.layerGroup().addTo(map);


const icon = L.icon({
    iconUrl: './images/punto.png',  
    iconSize: [35, 35] 
});


const cargarClientes = async () => {
    try {
        const url = '/las_aguilas/API/cliente/mapa';
        const respuesta = await fetch(url);
        const datos = await respuesta.json();
        console.log(datos);

    
        markerLayer.clearLayers();

        datos.forEach(cliente => {
            const ubicacion = cliente.cliente_ubicacion.trim();
            const coordenadas = ubicacion.replace(/,/g, ' ').split(/\s+/);

            if (coordenadas.length === 2) {
                const lat = parseFloat(coordenadas[0]);
                const lng = parseFloat(coordenadas[1]);

                if (!isNaN(lat) && !isNaN(lng)) {
                    const marker = L.marker([lat, lng], { icon: icon }).addTo(markerLayer);
                    marker.bindTooltip(cliente.cliente_nombre, {
                        permanent: true, 
                        direction: 'top',
                        className: 'tooltip',
                        offset: L.point(0, -20)  
                    }).openTooltip();
                    marker.bindPopup(` 
                        <b>${cliente.cliente_nombre}</b><br>
                        NIT: ${cliente.cliente_nit}<br>
                        Propietario: ${cliente.cliente_propietario}<br>
                        Teléfono: ${cliente.cliente_telefono}<br>
                        Email: ${cliente.cliente_email}
                    `);
                } else {
                    console.error(`Coordenadas inválidas para el cliente: ${cliente.cliente_nombre} - Coordenadas: ${lat}, ${lng}`);
                }
            } else {
                console.error(`Formato de coordenadas inválido para el cliente: ${cliente.cliente_nombre} - Ubicación: ${ubicacion}`);
            }
        });
    } catch (error) {
        console.error('Error cargando los clientes:', error);
    }
};


cargarClientes();

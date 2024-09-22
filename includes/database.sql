CREATE DATABASE forma_b_alumnos;

create table clientes (
    cliente_id SERIAL PRIMARY KEY,
    cliente_nombre VARCHAR(100),
    cliente_nit INTEGER,
    cliente_propietario VARCHAR(100),
    cliente_telefono INTEGER,
    cliente_email VARCHAR(50),
    cliente_ubicacion VARCHAR(100),
    cliente_contrato VARCHAR(255)
);


CREATE TABLE encabezado_factura (
    factura_id SERIAL PRIMARY KEY,
    factura_correlativo VARCHAR(150),
    factura_cliente INT,
    factura_NIT INTEGER,
    factura_mes INT,
    factura_anio INT, 
    factura_situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (factura_cliente) REFERENCES clientes(cliente_id)
);


CREATE TABLE detalle_factura (
    detalle_id SERIAL PRIMARY KEY,
    detalle_encabezado INT,
    detalle_cantidad_empleados INTEGER,
    detalle_empleados VARCHAR(100),
    detalle_total INTEGER,
    detalle_situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (detalle_encabezado) REFERENCES encabezado_factura(factura_id)
);

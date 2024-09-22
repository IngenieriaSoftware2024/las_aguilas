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
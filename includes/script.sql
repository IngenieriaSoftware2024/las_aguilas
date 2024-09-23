CREATE DATABASE forma_b_alumnos;

CREATE TABLE aplicacion(
    app_id SERIAL NOT NULL,
    app_nombre VARCHAR (50),
    app_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY (app_id)
);

CREATE TABLE rol(
    rol_id SERIAL NOT NULL,
    rol_nombre VARCHAR (10),
    rol_app INTEGER,
    rol_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY (rol_id),
    FOREIGN KEY (rol_app) REFERENCES aplicacion (app_id)
);

CREATE TABLE empleado(
    emp_id SERIAL NOT NULL,
    emp_nombre VARCHAR (80),
    emp_dpi VARCHAR (15),
    emp_direccion VARCHAR (80),
    emp_tel VARCHAR (10),
    PRIMARY KEY (emp_id)
);

CREATE TABLE usuario(
    usu_id SERIAL NOT NULL,
    usu_nombre VARCHAR (50),
    usu_catalogo INTEGER,
    usu_password LVARCHAR,
    usu_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY (usu_id)
);

CREATE TABLE permiso(
    per_id SERIAL NOT NULL,
    per_usuario INTEGER,
    per_rol INTEGER,
    per_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY (per_id),
    FOREIGN KEY (per_usuario) REFERENCES usuario (usu_id),
    FOREIGN KEY (per_rol) REFERENCES rol (rol_id)
);

CREATE TABLE turnos (
    turno_id SERIAL,
    turno_empleado INTEGER,
    turno_puesto INTEGER,
    turno_fecha_inicio DATETIME YEAR TO MINUTE,
    turno_fecha_fin DATETIME YEAR TO MINUTE,
    turno_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY (turno_id),
    FOREIGN KEY (turno_empleado) REFERENCES empleado(emp_id),
    FOREIGN KEY (turno_puesto) REFERENCES puestos(puesto_id)
);

CREATE TABLE puestos(
    puesto_id SERIAL,
    puesto_nombre VARCHAR(50),
    puesto_descripcion VARCHAR(150),
    puesto_salario MONEY (10,2),
    puesto_direccion VARCHAR (100),
    puesto_cliente INTEGER,
    puesto_situacion SMALLINT DEFAULT 1, 
    PRIMARY KEY (puesto_id),
    FOREIGN KEY (puesto_cliente) REFERENCES clientes(cliente_id)
);
 
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


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
    emp_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY (emp_id)
);

CREATE TABLE usuario(
    usu_id SERIAL NOT NULL,
    usu_nombre INTEGER,
    usu_catalogo INTEGER,
    usu_password LVARCHAR,
    usu_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY (usu_id),
    FOREIGN KEY (usu_nombre) REFERENCES empleado (emp_id)
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

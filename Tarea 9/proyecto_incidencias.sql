-- 1) Crear la base de datos si no existe y usarla
IF DB_ID('proyecto_incidencias') IS NULL
BEGIN
    CREATE DATABASE proyecto_incidencias
      COLLATE Latin1_General_100_CI_AS_SC_UTF8;
END;
GO

USE proyecto_incidencias;
GO

-- 2) Catálogos de ubicación
CREATE TABLE provincia (
    id_provincia    INT            IDENTITY(1,1) PRIMARY KEY,
    nombre          NVARCHAR(100)  NOT NULL UNIQUE
);

CREATE TABLE municipio (
    id_municipio    INT            IDENTITY(1,1) PRIMARY KEY,
    nombre          NVARCHAR(100)  NOT NULL,
    id_provincia    INT            NOT NULL,
    CONSTRAINT UX_municipio_nombre_prov UNIQUE(nombre, id_provincia),
    CONSTRAINT FK_municipio_provincia FOREIGN KEY(id_provincia)
        REFERENCES provincia(id_provincia)
        ON DELETE NO ACTION
);

CREATE TABLE barrio (
    id_barrio       INT            IDENTITY(1,1) PRIMARY KEY,
    nombre          NVARCHAR(100)  NOT NULL,
    id_municipio    INT            NOT NULL,
    CONSTRAINT UX_barrio_nombre_mun UNIQUE(nombre, id_municipio),
    CONSTRAINT FK_barrio_municipio FOREIGN KEY(id_municipio)
        REFERENCES municipio(id_municipio)
        ON DELETE NO ACTION
);

-- 3) Usuarios
CREATE TABLE usuario (
    id_usuario            INT               IDENTITY(1,1) PRIMARY KEY,
    nombre                NVARCHAR(100)     NOT NULL,
    email                 NVARCHAR(150)     NOT NULL UNIQUE,
    metodo_autenticacion  VARCHAR(10)       NOT NULL CHECK(metodo_autenticacion IN ('gmail','office365','local')),
    password              NVARCHAR(255)     NULL,
    rol                   VARCHAR(10)       NOT NULL CHECK(rol IN ('reportero','validador'))
);

-- 4) Tipos de incidencia
CREATE TABLE tipo_incidencia (
    id_tipo      INT            IDENTITY(1,1) PRIMARY KEY,
    nombre       NVARCHAR(50)   NOT NULL UNIQUE
);

-- 5) Incidencias
CREATE TABLE incidencia (
    id_incidencia    INT             IDENTITY(1,1) PRIMARY KEY,
    fecha_ocurrencia DATETIME2       NOT NULL,
    titulo           NVARCHAR(200)   NOT NULL,
    descripcion      NVARCHAR(MAX)   NULL,
    id_provincia     INT             NOT NULL,
    id_municipio     INT             NOT NULL,
    id_barrio        INT             NOT NULL,
    latitud          DECIMAL(9,6)    NOT NULL,
    longitud         DECIMAL(9,6)    NOT NULL,
    muertos          INT             NOT NULL DEFAULT 0,
    heridos          INT             NOT NULL DEFAULT 0,
    perdida_estimada DECIMAL(12,2)   NULL,
    link_redes       NVARCHAR(255)   NULL,
    foto_url         NVARCHAR(255)   NULL,
    estado           VARCHAR(10)     NOT NULL DEFAULT 'pendiente',
    id_reportero     INT             NOT NULL,
    CONSTRAINT FK_incidencia_provincia FOREIGN KEY(id_provincia)
        REFERENCES provincia(id_provincia)
        ON DELETE NO ACTION,
    CONSTRAINT FK_incidencia_municipio FOREIGN KEY(id_municipio)
        REFERENCES municipio(id_municipio)
        ON DELETE NO ACTION,
    CONSTRAINT FK_incidencia_barrio FOREIGN KEY(id_barrio)
        REFERENCES barrio(id_barrio)
        ON DELETE NO ACTION,
    CONSTRAINT FK_incidencia_usuario FOREIGN KEY(id_reportero)
        REFERENCES usuario(id_usuario)
        ON DELETE NO ACTION
);
CREATE INDEX IX_incidencia_fecha ON incidencia(fecha_ocurrencia);

-- 6) Relación N:M incidencia – tipo
CREATE TABLE incidencia_tipo (
    id_incidencia  INT NOT NULL,
    id_tipo        INT NOT NULL,
    CONSTRAINT PK_incidencia_tipo PRIMARY KEY(id_incidencia, id_tipo),
    CONSTRAINT FK_IT_incidencia FOREIGN KEY(id_incidencia)
        REFERENCES incidencia(id_incidencia)
        ON DELETE CASCADE,
    CONSTRAINT FK_IT_tipo FOREIGN KEY(id_tipo)
        REFERENCES tipo_incidencia(id_tipo)
        ON DELETE NO ACTION
);

-- 7) Comentarios
CREATE TABLE comentario (
    id_comentario   INT           IDENTITY(1,1) PRIMARY KEY,
    id_incidencia   INT           NOT NULL,
    id_usuario      INT           NOT NULL,
    fecha_comentario DATETIME2    NOT NULL DEFAULT SYSUTCDATETIME(),
    contenido       NVARCHAR(MAX) NOT NULL,
    CONSTRAINT FK_comentario_incidencia FOREIGN KEY(id_incidencia)
        REFERENCES incidencia(id_incidencia)
        ON DELETE CASCADE,
    CONSTRAINT FK_comentario_usuario FOREIGN KEY(id_usuario)
        REFERENCES usuario(id_usuario)
        ON DELETE NO ACTION
);

-- 8) Correcciones sugeridas
CREATE TABLE correccion_incidencia (
    id_correccion    INT           IDENTITY(1,1) PRIMARY KEY,
    id_incidencia    INT           NOT NULL,
    id_usuario       INT           NOT NULL,
    campo            VARCHAR(20)   NOT NULL CHECK(campo IN ('muertos','heridos','provincia','municipio','barrio','perdida_estimada','coordenadas')),
    valor_sugerido   NVARCHAR(255) NOT NULL,
    fecha_sugerencia DATETIME2     NOT NULL DEFAULT SYSUTCDATETIME(),
    estado_revision  VARCHAR(10)   NOT NULL DEFAULT 'pendiente',
    id_validador     INT           NULL,
    fecha_revision   DATETIME2     NULL,
    CONSTRAINT FK_corr_incidencia FOREIGN KEY(id_incidencia)
        REFERENCES incidencia(id_incidencia)
        ON DELETE CASCADE,
    CONSTRAINT FK_corr_usuario FOREIGN KEY(id_usuario)
        REFERENCES usuario(id_usuario)
        ON DELETE NO ACTION,
    CONSTRAINT FK_corr_validador FOREIGN KEY(id_validador)
        REFERENCES usuario(id_usuario)
        ON DELETE SET NULL
);
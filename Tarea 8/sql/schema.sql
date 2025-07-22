-- sql/schema.sql

-- 1) Empleados (login)
CREATE TABLE IF NOT EXISTS empleados (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  correo VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2) Clientes
CREATE TABLE IF NOT EXISTS clientes (
  codigo INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3) Productos
CREATE TABLE IF NOT EXISTS productos (
  codigo_producto INT AUTO_INCREMENT PRIMARY KEY,
  nombre_producto VARCHAR(100) NOT NULL,
  descripcion TEXT,
  cantidad_almacen INT NOT NULL,
  fecha_entrada DATE NOT NULL,
  fecha_vencimiento DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4) Facturas
CREATE TABLE IF NOT EXISTS facturas (
  numero_recibo INT AUTO_INCREMENT PRIMARY KEY,
  fecha_factura DATE NOT NULL,
  codigo_cliente INT NOT NULL,
  nombre_cliente VARCHAR(100) NOT NULL,
  codigo_producto INT NOT NULL,
  nombre_producto VARCHAR(100) NOT NULL,
  descripcion TEXT,
  cantidad INT NOT NULL,
  precio_unitario DECIMAL(10,2) NOT NULL,
  total_por_articulo DECIMAL(10,2) NOT NULL,
  total_general DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (codigo_cliente) REFERENCES clientes(codigo),
  FOREIGN KEY (codigo_producto) REFERENCES productos(codigo_producto)
);

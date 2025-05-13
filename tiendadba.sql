CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  usuario VARCHAR(50) UNIQUE,
  clave VARCHAR(255),
  rol ENUM('admin', 'vendedor')
);

CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100)
);

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  codigo VARCHAR(50),
  precio_compra DECIMAL(10,2),
  precio_venta DECIMAL(10,2),
  stock INT,
  id_categoria INT,
  FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

CREATE TABLE ventas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha DATETIME,
  id_usuario INT,
  total DECIMAL(10,2),
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE detalle_venta (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_venta INT,
  id_producto INT,
  cantidad INT,
  precio_unitario DECIMAL(10,2),
  FOREIGN KEY (id_venta) REFERENCES ventas(id),
  FOREIGN KEY (id_producto) REFERENCES productos(id)
);

CREATE TABLE gastos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(255),
  monto DECIMAL(10,2),
  fecha DATE
);

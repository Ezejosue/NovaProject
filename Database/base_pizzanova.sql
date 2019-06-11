CREATE DATABASE IF NOT EXISTS PizzaNova;
USE PizzaNova;

CREATE TABLE TipoUsuario(
    id_Tipousuario INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(20),
    descripcion VARCHAR(1000),
    estado TINYINT (1) NOT NULL DEFAULT 1 comment '1 es activo 0 es inactivo');

CREATE TABLE Categorias(
    id_categoria INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_categoria VARCHAR(50) NOT NULL,
    descripcion VARCHAR(1000) NOT NULL,
    foto_categoria VARCHAR(50),
    estado TINYINT (1) NOT NULL DEFAULT 1 comment '1 es activo 0 es inactivo');


CREATE TABLE Usuarios(
    id_usuario INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    alias VARCHAR(50) NOT NULL,
    clave_usuario VARCHAR(60) NOT NULL,
    foto_usuario VARCHAR(50),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado_usuario TINYINT (1) NOT NULL DEFAULT 1 comment '1 es activo 0 es inactivo',
    id_Tipousuario INT UNSIGNED,
    FOREIGN KEY (id_Tipousuario) REFERENCES TipoUsuario(id_Tipousuario));

CREATE TABLE Cargo(
    id_Cargo INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_Cargo VARCHAR(50));

CREATE TABLE Empleados(
    id_empleado INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_empleado VARCHAR(20) NOT NULL,
    apellido_empleado VARCHAR(20) NOT NULL,
    dui VARCHAR(10) NOT NULL UNIQUE,
    direccion VARCHAR(100) NOT NULL,
    telefono VARCHAR(9) NOT NULL UNIQUE,
    genero ENUM('M', 'F') NULL,
    fecha_nacimiento DATE NOT NULL,
    nacionalidad VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    id_Cargo INT UNSIGNED,
    FOREIGN KEY (id_Cargo) REFERENCES Cargo(id_Cargo),
    id_usuario INT UNSIGNED,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario));

CREATE TABLE UnidadMedida(
    id_Medida INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_medida VARCHAR(40) NOT NULL,
    descripcion VARCHAR(50)
);


CREATE TABLE MateriasPrimas(
    idMateria INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_materia VARCHAR(50) NOT NULL,
    descripcion VARCHAR(50),
    cantidad INT,
    foto VARCHAR(100),
    id_categoria INT UNSIGNED,
    id_Medida INT UNSIGNED,
    estado TINYINT (1) NOT NULL DEFAULT 1 comment '1 es activo 0 es inactivo',
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id_categoria) 
    FOREIGN KEY (id_Medida) REFERENCES UnidadMedida(id_Medida) 
);

CREATE TABLE Receta(
    id_receta INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_receta VARCHAR(1000) NOT NULL,
    tiempo VARCHAR(11) NOT NULL,
    elaboracion VARCHAR(350) NOT NULL,
    id_categoria INT UNSIGNED,
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id_categoria),
    idMateria INT UNSIGNED,
    FOREIGN KEY (idMateria) REFERENCES MateriasPrimas(idMateria)
);


CREATE TABLE Platillos(
    id_platillo INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_platillo VARCHAR(50) NOT NULL,
    precio DOUBLE(6,2),
    estado TINYINT (1) NOT NULL DEFAULT 1 comment '1 es activo 0 es inactivo',
    id_receta INT UNSIGNED,
    FOREIGN KEY (id_receta) REFERENCES Receta(id_receta),
    id_categoria INT UNSIGNED,
    imagen VARCHAR(50),
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id_categoria) 
);

CREATE TABLE EncabezadoFactura(
    id_EncabezadoFac INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_cliente VARCHAR(50),
    id_empleado INT UNSIGNED,
    FOREIGN KEY (id_empleado) REFERENCES Empleados(id_empleado)    
);

CREATE TABLE DetalleFactura(
    id_detallefac INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    cantidad INT,
    id_platillo INT UNSIGNED,
    FOREIGN KEY (id_platillo) REFERENCES Platillos(id_platillo),
    subtotal DOUBLE(6,2)
); 

CREATE TABLE Bitacoras(
    id_bitacora INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    accion VARCHAR(50) NOT NULL,
    id_usuario INT UNSIGNED,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);
    


--insert tipo usuarios
INSERT INTO TipoUsuario(tipo, descripcion) VALUES
    ('Administrador','Tiene acceso a todas las funciones del programa web'),
    ('Empleado','Tiene acceso a todas las funciones del programa web menos la administracion de clientes');
--final insert tipo usuarios

--Insert categoria
INSERT INTO Categorias(nombre_categoria, descripcion, foto_categoria) VALUES
    ('Pizzas', 'Diferentes tipos de pizza que se preparan', 'pizza.jpg'),
    ('Bebidad', 'Diferentes tipos de bebidad', 'bebidad.jpg'),
    ('Platillos', 'Diferentes platillos que se preparan', 'Platillo.jpg');
--Final insert categoria

--Insert Cargo
INSERT INTO Cargo(nombre_Cargo) VALUES
    ('Gerente'),
    ('Administrador');
--Final insert cargo


--insert unidad de medidad
INSERT INTO UnidadMedida(nombre_medida, descripcion) VALUES
    ('Kilogramo', '1000'),
    ('Gramo', '1'),
    ('Miligramo', '0001'),
    ('Litro', '1000');
--final insert unidad de medidad

--insert encabezado factura
INSERT INTO EncabezadoFactura(nombre_cliente, id_empleado) VALUES
    ('Josue', 1),
    ('Carlos', 3),
    ('Frank', 4),
    ('Gerardo', 5);
--final insert encabezado factura

--insert detalle factura
INSERT INTO DetalleFactura(cantidad, id_platillo, subtotal) VALUES
    (2, 1, '25.00'),
    (3, 2, '30.00'),
    (1, 3, '27.00'),
    (4, 4, '22.00');
--final insert detalle factura


--TRIGGER INSERT
CREATE TRIGGER Llenar_bitacora AFTER INSERT ON Empleados
FOR EACH ROW
INSERT INTO Bitacoras(Usuario, Fecha, Accion) Values ('Josue', now(), 'Agrego un empleado');
--FINAL TRIGGER INSERT

--TRIGGER UPDATE
CREATE TRIGGER Llenar_bitacora1 AFTER UPDATE ON Empleados
FOR EACH ROW
INSERT INTO Bitacoras(Usuario, Fecha, Accion) Values ('Josue', now(), 'Modifico un empleado');
--FINAL TRIGGER UPDATE

--TRIGGER
CREATE TRIGGER Llenar_bitacora3 AFTER UPDATE ON Usuarios
FOR EACH ROW
INSERT INTO Bitacoras(Usuario, Fecha, Accion) Values ('Josue', now(), 'Modifico un Usuario');
--FINAL TRIGGER 


--Procedure
DELIMITER $$
CREATE PROCEDURE `EncabezadoFactura` (IN `id_EncabezadoFac` INT UNSIGNED, IN `nombre_cliente` VARCHAR(50), IN `id_empleado` INT UNSIGNED)
BEGIN
INSERT INTO EncabezadoFactura(id_EncabezadoFac, nombre_cliente, id_empleado)
VALUES (id_EncabezadoFac, nombre_cliente, id_empleado);
END$$
DELIMITER ;
--Procedure

--Procedure
DELIMITER $$
CREATE PROCEDURE `DetalleFactura` (IN `id_detallefac` INT UNSIGNED, IN `cantidad` INT, IN `id_platillo` INT UNSIGNED,
IN `subtotal` DOUBLE)
BEGIN
INSERT INTO DetalleFactura(id_detallefac, cantidad, id_platillo, subtotal)
VALUES (id_detallefac, cantidad, id_platillo, subtotal);
END$$
DELIMITER ;
--Procedure

--Procedure
DELIMITER $$
CREATE PROCEDURE `Platillo` (IN `id_platillo` INT UNSIGNED, IN `nombre_platillo` VARCHAR(50), IN `precio` DOUBLE(6,2),
IN `idMateria` INT UNSIGNED, IN `id_categoria` INT UNSIGNED) 
BEGIN
INSERT INTO Platillos(id_platillo, nombre_platillo, precio, idMateria, id_categoria)
VALUES (id_platillo, nombre_platillo, precio, idMateria, id_categoria);
END$$
DELIMITER ;
--Procedure


SELECT * FROM Usuarios;
SELECT * FROM UnidadMedida;
SELECT * FROM TipoUsuario;
SELECT * FROM Platillos;
SELECT * FROM MateriasPrimas;
SELECT * FROM EncabezadoFactura;
SELECT * FROM Empleados;
SELECT * FROM DetalleFactura;
SELECT * FROM Categorias;
SELECT * FROM Cargo;
SELECT * FROM Bitacoras;

--Consultas multitabla 
SELECT COUNT(u.id_usuario)N_usuarios, u.alias, p.tipo
FROM usuarios u, Tipousuario p
where u.id_Tipousuario = p.id_Tipousuario GROUP BY p.tipo;

SELECT AVG(platillos.precio)Precio, c.nombre_categoria
FROM platillos 
INNER JOIN categorias c  ON platillos.id_categoria = c.id_categoria GROUP by c.id_categoria;

SELECT COUNT(id_empleado)N_empleados, empleados.genero
FROM empleados
INNER JOIN usuarios ON empleados.id_usuario = usuarios.id_usuario GROUP BY empleados.genero;

SELECT SUM(platillos.id_platillo)N_platillos, c.nombre_categoria
FROM platillos
INNER JOIN categorias c
ON platillos.id_categoria = c.id_categoria  GROUP BY c.id_categoria;

SELECT nombre_empleado, fecha_nacimiento
FROM empleados
WHERE fecha_nacimiento BETWEEN '1900-01-01' AND '2001-12-31' ORDER BY fecha_nacimiento DESC; 
--Consultas multitabla  


CREATE DATABASE IF NOT EXISTS PizzaNova;
USE PizzaNova;

CREATE TABLE TipoUsuario(
    id_Tipousuario INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(20),
    descripcion VARCHAR(1000),
    estado TINYINT (1) NOT NULL DEFAULT 1 comment '1 es activo 0 es inactivo');

CREATE TABLE Categorias(
    id_categoria INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_categoria VARCHAR(50) NOT NULL,
    descripcion VARCHAR(1000) NOT NULL,
    foto_categoria VARCHAR(50),
    estado TINYINT (1) NOT NULL DEFAULT 1 comment '1 es activo 0 es inactivo');
------------------------------------------------

-------------------------------------------------
CREATE TABLE Usuarios(
    id_usuario INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(30) NOT NULL,
    clave VARCHAR(30) NOT NULL,
    foto_usuario VARCHAR(50),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado TINYINT (1) NOT NULL DEFAULT 1 comment '1 es activo 0 es inactivo',
    id_Tipousuario INT UNSIGNED,
    FOREIGN KEY (id_Tipousuario) REFERENCES TipoUsuario(id_Tipousuario));
---------------------------------------------------
CREATE TABLE Cargo(
    id_Cargo INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_Cargo VARCHAR(50));
----------------------------------------------------
CREATE TABLE Empleados(
    id_empleado INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_empleado VARCHAR(20) NOT NULL,
    apellido_empleado VARCHAR(20) NOT NULL,
    dui VARCHAR(10) NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    telefono INT NOT NULL,
    genero ENUM('M', 'F') NULL,
    fecha_nacimiento DATE NOT NULL,
    nacionalidad VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    id_Cargo INT UNSIGNED,
    FOREIGN KEY (id_Cargo) REFERENCES Cargo(id_Cargo),
    id_usuario INT UNSIGNED,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario));
----------------------------------------------------------
CREATE TABLE UnidadMedida(
    id_Medida INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_medida VARCHAR(40) NOT NULL,
    Unidad DECIMAL NOT NULL);
----------------------------------------------------------
CREATE TABLE MateriasPrimas(
    idMateria INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_materia VARCHAR(50) NOT NULL,
    id_Medida INT UNSIGNED,
    FOREIGN KEY (id_Medida) REFERENCES UnidadMedida(id_Medida),
    id_categoria INT UNSIGNED,
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id_categoria)   
);
--------------------------------------------------------------
CREATE TABLE Platillos(
    id_platillo INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_platillo VARCHAR(50) NOT NULL,
    precio DOUBLE(6,2),
    idMateria INT UNSIGNED,
    FOREIGN KEY (idMateria) REFERENCES MateriasPrimas(idMateria),
    id_categoria INT UNSIGNED,
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id_categoria) 
);
---------------------------------------------------------------
/* CREATE TABLE Entradas(
    id_entrada INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    fecha_entrada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT NOT NULL
    FOREIGN KEY id_usuario REFERENCES usuarios(id_usuario),
    cantidad INT NOT NULL,
    id_producto INT UNSIGNED,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)); */
--------------------------------------------------------------------
CREATE TABLE EncabezadoFactura(
    id_EncabezadoFac INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre_cliente VARCHAR(50),
    id_empleado INT UNSIGNED,
    FOREIGN KEY (id_empleado) REFERENCES Empleados(id_empleado)    
);
----------------------------------------------------------------
CREATE TABLE DetalleFactura(
    id_detallefac INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    cantidad INT,
    id_platillo INT UNSIGNED,
    FOREIGN KEY (id_platillo) REFERENCES Platillos(id_platillo),
    subtotal DOUBLE(6,2)
); 
--------------------------------------------------------------
CREATE TABLE Bitacoras(
    id_bitacora INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    accion VARCHAR(50) NOT NULL,
    id_usuario INT UNSIGNED,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario));
----------------------------------------------------------------


--insert tipo usuarios
INSERT INTO TipoUsuario(nombre_usuario, descripcion) VALUES
    ('Administrador','Tiene acceso a todas las funciones del programa web'),
    ('Empleado','Tiene acceso a todas las funciones del programa web menos la administracion de clientes'),
    ('Gerente', 'Tiene acceso a todas las funciones menos a las graficas y reportes de ganacias'),
    ('Invitado', 'Solo puede visualizar las paginas pero no puede agrgar, modificar ni eliminar datos');
--final insert tipo usuarios

--Insert categoria
INSERT INTO Categorias(nombre_categoria, descripcion, foto_categoria) VALUES
    ('Pizzas', 'Diferentes tipos de pizza que se preparan', 'pizza.jpg'),
    ('Bebidad', 'Diferentes tipos de bebidad', 'bebidad.jpg'),
    ('Platillos', 'Diferentes platillos que se preparan', 'Platillo.jpg'),
    ('Entradas', 'Diferentes tipos de entradas que se preparan antes del plato fuerte', 'Entrada.jpg'),
    ('Pastas', 'Diferentes platillos que son preparados a base de harina mezclada con agua', 'Pastas.jpg');
--Final insert categoria

--Insert Cargo
INSERT INTO Cargo(nombre_Cargo) VALUES
    ('Gerente'),
    ('Administrador'),
    ('Contador'),
    ('Cocinero'),
    ('Ordenanza'),
    ('Vigilante');
--Final insert cargo

--insert usuario
INSERT INTO Usuarios(nombre_usuario, clave, foto_usuario, id_Tipousuario) VALUES
    ('Raik', '123', 'empleado.jpg', 2),    
    ('Conrad', '123', 'empleado.jpg', 1),    
    ('Assuanta', '123', 'empleado.jpg', 5),    
    ('Lexus', '123', 'empleado.jpg', 1),    
    ('Elyse', '123', 'empleado.jpg', 2),    
    ('Marlin', '123', 'empleado.jpg', 6),    
    ('Ray', '123', 'empleado.jpg', 4),    
    ('Sebastian', '123', 'empleado.jpg', 4),    
    ('Fatima', '123', 'empleado.jpg', 3),    
    ('Florine', '123', 'empleado.jpg', 1);   
--Final insert usuario

--Insert usuarios
INSERT INTO Empleados(nombre_empleado, apellido_empleado, dui, direccion, telefono, genero,
            fecha_nacimiento, nacionalidad, correo, id_Cargo, id_usuario) VALUES
    ('Ricky', 'Balistreri', '46795687-8', 'Apopa',  78745896,'M', '1996-07-17', 'El Salvador', 'rick@mail.com',1,1),
    ('Conrad', 'Legros', '64795687-9', 'Santa Ana',  78745896,'M', '1994-10-15', 'El Salvador', 'Conrad@mail.com',2,2),
    ('Assunta', 'Pouros', '68795687-8', 'Sonsonate', 78745896,'F', '1993-09-01', 'El Salvador', 'Assun@mail.com',1,3),
    ('Lexus', 'Beatty', '94795687-8', 'Libertad', 78745896,'M', '1987-04-26', 'El Salvador', 'lexs@mail.com',1,4),
    ('Elyse', 'Bashirian', '12795687-9', 'Soyapango', 78745896,'F', '1996-07-19', 'El Salvador', 'Eys@mail.com',1,5),
    ('Marlin', 'Spinka', '13795687-8', 'San Salvador', 78745896,'F', '1986-08-12', 'El Salvador', 'Marlin@mail.com',1,6),
    ('Ray', 'Wunsch', '44795687-9', 'Cabañas',  78745896,'M', '1999-02-23', 'El Salvador', 'Ray@mail.com',1,7),
    ('Sebastian', 'Morar', '98795687-9', 'La Union', 78745896,'M', '1991-09-07', 'El Salvador', 'Sebas@mail.com',1,8),
    ('Fatima', 'Windler', '35795687-8', 'Santa Tecla', 78745896,'F', '1992-06-24', 'El Salvador', 'Fatwin@mail.com',1,9),
    ('Florine', 'Mills', '49795687-9', 'Ilobasco', 78745896,'F', '1991-02-26', 'El Salvador', 'Florine@mail.com',1,10);
--Final insert usuarios

--insert unidad de medidad
INSERT INTO UnidadMedida(nombre_medida, Unidad) VALUES
    ('Kilogramo', 1000),
    ('Gramo', 1),
    ('Miligramo', 0.001),
    ('Litro', 1000);
    ('Mililitro' 0.001),
    ('Onza' 28.3495)
    ('Libra', 453.592);
--final insert unidad de medidad

--insert materia prima
INSERT INTO MateriasPrimas(nombre_materia, id_Medida, id_categoria) VALUES
    ('Masa', 2, 1),
    ('Piña', 7, 1),
    ('Harina' 1, 1),
    ('Sal', 2, 1),
    ('Levadura' 2, 1),
    ('Aceite', 5, 1),
    ('Queso' 2, 1)
    ('Coca-Cola', 4, 2),
    ('Pepperoni', 2, 1),
    ('Carne', 2, 1),
    ('Nachos', 2, 4)
--final insert materia prima

--insert platillos
INSERT INTO Platillos(nombre_platillo, precio, idMateria, id_categoria) VALUES
    ('Pizza Cuatro', '12.99', 1, 1),
    ('Pizza carne', '10.00', 2, 1),
    ('Pizza masa suave', '9.00', 4, 1),
    ('Pizza comun', '5.99', 1, 1),
    ('Pan con ajo sin queso' '2.35', 1, 4),
    ('Pan con ajo con queso', '3.25', 1, 4),
    ('Calzone de un ingrediente', '4.45', 1, 1),
    ('Calzone mixto', '4.75', 1, 1),
    ('Lasagna Bolognese', '5.25', 1, 5),
    ('Lasagna de pollo', '5.25', 1, 5),
    ('Spaghetti Alla Bolognese', '4.00', 1, 5);
--final insert platillos

--insert encabezado factura
INSERT INTO EncabezadoFactura(nombre_cliente, id_empleado) VALUES
    ('Josue', 1),
    ('Carlos', 3),
    ('Frank', 4),
    ('Aljandro', 5);
    ('María', 5);
    ('Gerardo', 1);
    ('Ezequiel', 2);
    ('Vanesa', 5);
--final insert encabezado factura

--insert detalle factura
INSERT INTO DetalleFactura(cantidad, id_platillo, subtotal) VALUES
    (2, 1, '25.00'),
    (3, 2, '30.00'),
    (1, 3, '27.00'),
    (2, 5, '28.00');
    (1, 6, '3.75');
    (4, 4, '22.00');
    (1, 4, '5.99');
    (1, 2, '11.98');
    (8, 2, '47.92');
    (4, 4, '22.00');
--final insert detalle factura
-------------------------------------------------------------

-------------------------------------------------------------
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

---------------------------------------------

-------------------------------------------------------------
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
-------------------------------------------------------------

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
SELECT COUNT(u.id_usuario)N_usuarios, u.nombre_usuario, p.nombre_usuario
FROM usuarios u, Tipousuario p
where u.id_Tipousuario = p.id_Tipousuario GROUP BY p.nombre_usuario;

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


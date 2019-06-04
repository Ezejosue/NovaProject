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
    estado TINYINT (1) NOT NULL DEFAULT 1 comment '1 es activo 0 es inactivo',
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id_categoria) 
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
    id_receta INT UNSIGNED,
    FOREIGN KEY (id_receta) REFERENCES Receta(id_receta),
    id_categoria INT UNSIGNED,
    FOREIGN KEY (id_categoria) REFERENCES Categorias(id_categoria) 
);

/* CREATE TABLE Entradas(
    id_entrada INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    fecha_entrada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT NOT NULL
    FOREIGN KEY id_usuario REFERENCES usuarios(id_usuario),
    cantidad INT NOT NULL,
    id_producto INT UNSIGNED,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)); */


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

--insert usuario
INSERT INTO Usuarios(alias, clave_usuario, foto_usuario, id_Tipousuario) VALUES
    ('Raik', '123', 'empleado.jpg', 2),    
    ('Conrad', '123', 'empleado.jpg', 1),    
    ('Assuanta', '123', 'empleado.jpg', 2),    
    ('Lexus', '123', 'empleado.jpg', 2),    
    ('Elyse', '123', 'empleado.jpg', 2),    
    ('Marlin', '123', 'empleado.jpg', 2),    
    ('Ray', '123', 'empleado.jpg', 2),    
    ('Sebastian', '123', 'empleado.jpg', 2),    
    ('Fatima', '123', 'empleado.jpg', 2),    
    ('Florine', '123', 'empleado.jpg', 2);   
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

--insert materia prima
INSERT INTO MateriasPrimas(nombre_materia, descripcion, foto, id_categoria) VALUES
    ('Pepperoni', '2', 'pp.png', 1),
    ('Carne', 'oi', 'gg.png', 1),
    ('Pepsi', 'ñko', 'dd.png', 1),
    ('Masa', 'koñ', 'ff.png', 1);
--final insert materia prima

--insert receta
    INSERT INTO Receta(nombre_receta, tiempo, elaboracion, id_categoria, dificultad, imagen, idMateria) VALUES
        ('Pizza 4 quesos', '20 min', 'Le das verga a la mesa hasta que quede redonda y le hechas un vergo de queso', 1, 1, 'awdawd.png', 1);
--final insert receta


--insert unidad de medidad
INSERT INTO UnidadMedida(nombre_medida, descripcion) VALUES
    ('Kilogramo', '1000'),
    ('Gramo', '1'),
    ('Miligramo', '0001'),
    ('Litro', '1000');
--final insert unidad de medidad


--insert platillos
INSERT INTO Platillos(nombre_platillo, precio, id_receta, id_categoria) VALUES
    ('Pizza Cuatro', '12.99', 1, 1),
    ('Pizza carne', '10.00', 2, 1),
    ('Pizza masa suave', '9.00', 4, 1),
    ('Pizza comun', '5.99', 1, 1);
--final insert platillos

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


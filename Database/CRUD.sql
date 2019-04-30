--Update tipo usuarios
UPDATE TipoUsuario SET nombre_usuario = `ADMIN` WHERE id_Tipousuario = 1;
UPDATE TipoUsuario SET Estado = 0 where id_Tipousuario = 1;
--Update tipo usuarios

--update categoria
UPDATE Categorias SET nombre_categoria = 'pizzas' WHERE id_categoria = 1;
--update categoria

--update usuarios
UPDATE Usuarios  SET nombre_usuario = 'Kratos' WHERE id_usuario = 1;
--update usuarios

--update cargo
UPDATE Cargo SET nombre_Cargo = 'Supervisor' WHERE id_Cargo = 1;
--update cargo

--update unidad de medida 
UPDATE UnidadMedida SET nombre_medida = 'gr' WHERE id_Medida = 1;
--update unidad de medida 

--update empleado
UPDATE Empleados SET nombre_empleado = 'Ezio' WHERE id_empleado = 1;
--update empleado

--update materia
UPDATE MateriasPrimas SET nombre_materia = 'Salsa' WHERE idMateria = 1;
--update materia

--update platillos
UPDATE Platillos SET nombre_platillo = 'Macarrones' WHERE id_platillo = 1;
--update platillos

--update encabezado
UPDATE EncabezadoFactura SET nombre_cliente = 'Melvin' WHERE id_EncabezadoFac = 1;
--update encabezado

--update detalle
UPDATE DetalleFactura SET subtotal = '30.00' WHERE id_detallefac = 1;
--update detalle

--DELETE
DELETE FROM TipoUsuario Where id_Tipousuario = 2;
DELETE FROM Categorias Where id_categoria = 2;
DELETE FROM Usuarios Where id_usuario = 2;
DELETE FROM Cargo Where id_Cargo = 2;
DELETE FROM Empleados Where id_empleado = 2;
DELETE FROM UnidadMedida Where id_Medida = 2;
DELETE FROM MateriasPrimas Where idMateria = 2;
DELETE FROM Platillos Where id_platillo = 2;
DELETE FROM EncabezadoFactura Where id_EncabezadoFac = 2;
DELETE FROM DetalleFactura Where id_detallefac = 2;
--DELETE

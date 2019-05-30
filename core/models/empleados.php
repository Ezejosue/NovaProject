<?php
class Empleados extends Validator
{
    private $id = null;
    private $nombre_empleado = null;
    private $apellido_empleado = null;
    private $dui = null;
    private $direccion = null;
    private $telefono = null;
    private $genero = null;
    private $fecha_nacimiento = null;
    private $nacionalidad = null;
    private $correo = null;
    private $id_cargo = null;
    private $id_usuario = null;

    //Métodos para sobrecarga de propiedades
    public function setId($value)
    {
        if ($this->ValidateId($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNombres($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombre_empleado = $value;
            return true;   
        } else {
            return false;
        }
    }

    public function getNombres()
    {
        return $this->nombre_empleado;
    }

    public function setApellido($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellido_empleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getApellido()
    {
        return $this->apellido_empleado;
    }

    public function setDui($value)
	{
		if ($this->validateAlphanumeric($value, 1, 11)) {
			$this->dui = $value;
			return true;
		} else {
			return false;
		}
    }
    
    public function getDui()
    {
        return $this->dui;
    }

    public function setTelefono($value)
	{
		if ($this->validateAlphanumeric($value, 1, 10)) {
			$this->telefono = $value;
			return true;
		} else {
			return false;
		}
    }
    
    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setGenero($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->genero = $value;
			return true;
		} else {
			return false;
		}
    }
    
    public function getGenero()
    {
        return $this->genero;
    }

    public function setNacimiento($value)
	{
		if ($this->validateDate($value)) {
			$this->fecha_nacimiento = $value;
			return true;
		} else {
			return false;
		}
    }
    
    public function getNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    public function setNacionalidad($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->nacionalidad = $value;
			return true;
		} else {
			return false;
		}
    }

    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    public function setDireccion($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->direccion = $value;
			return true;
		} else {
			return false;
		}
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        }else {
            return false;
        }
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCargo($value)
    {
        if ($this->validateId($value)) {
            $this->id_cargo = $value;
            return true;
        }else {
            return false;
        }
    }

    public function getCargo()
    {
        return $this->id_cargo; 
    }

    public function setUsuario($value) 
    {
        if ($this->validateId($value)) {
            $this->id_usuario = $value;
            return true;
        }else {
            return false;
        }
    }

    public function getUsuario()
    {
        return $this->id_usuario;
    }

    //Métodos para manejar la sesión del usuario
    public function createEmpleado()
    {
        $sql = 'INSERT INTO Empleados(nombre_empleado, apellido_empleado, dui, direccion, telefono, genero, fecha_nacimiento, nacionalidad, correo, id_cargo, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre_empleado, $this->apellido_empleado, $this->dui, $this->direccion, $this->telefono, $this->genero, $this->fecha_nacimiento, $this->nacionalidad, $this->correo, $this->id_cargo, $this->id_usuario);
        return Conexion::executeRow($sql, $params);
    }

    public function getEmpleado()
    {
        $sql = 'SELECT id_empleado, nombre_empleado, apellido_empleado, dui, direccion,  telefono, genero, fecha_nacimiento, nacionalidad, correo, id_cargo, id_usuario FROM Empleados WHERE id_empleado = ?';
        $params = array($this ->id);
        return Conexion::getRow($sql, $params);
    }

    public function readUsuarios()
    {
        $sql = 'SELECT  id_usuario, alias FROM Usuarios ORDER BY alias';
		$params = array($this->id_usuario);
		return Conexion::getRows($sql, $params);
    }

    public function readEmpleados()
    {
        $sql = 'SELECT id_empleado, nombre_empleado, apellido_empleado, dui, direccion, telefono From Empleados ORDER BY nombre_empleado';
        $params = array(null);
        return Conexion::getRows($sql, $params);
    }

    public function searchEmpleados()
    {
        $sql = 'SELECT * FROM Empleados WHERE nombre_empleado LIKE ? OR apellido_empleado LIKE ? ORDER BY nombre_empleado';
        $params = array("%$value%", "%$value%");
        return Conexion::getRows($sql, $params);
    }

    public function readCargo()
    {
        $sql = 'SELECT id_cargo, nombre_Cargo FROM Cargo';
        $params = array(null);
        return Conexion::getRows($sql, $params);
    }

    public function updateEmpleado()
    {
        $sql = 'UPDATE Empleados SET nombre_empleado = ?, apellido_empleado = ?, dui = ?, direccion = ?, telefono = ?, genero = ?, fecha_nacimiento = ?, nacionalidad = ?, correo = ?, id_cargo = ?, id_usuario = ? WHERE id_empleado = ?';
        $params = array($this->nombre_empleado, $this->apellido_empleado, $this->dui, $this->direccion, $this->telefono, $this->genero, $this->fecha_nacimiento, $this->nacionalidad, $this->correo, $this->id_cargo, $this->id_usuario, $this->id);
        return Conexion::executeRow($sql, $params);
    }

    public function deleteEmpleado()
    {
        $sql = 'DELETE FROM Empleados WHERE id_empleado = ?';
        $params = array($this->id);
        return Conexion::executeRow($sql, $params);
    }
}
?>
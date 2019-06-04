<?php
class Platillos extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $nombre = null;
	private $imagen = null;
	private $precio = null;
	private $id_categoria = null;
	private $id_receta = null;
	private $estado = null;
	private $ruta = '../../resources/img/platillos/';

	// Métodos para sobrecarga de propiedades de el metodo platillos
	public function setId($value)
	{
		if ($this->validateId($value)) {
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

	public function setNombre($value)
	{
		if($this->validateAlphanumeric($value, 1, 50)) {
			$this->nombre = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setImagen($file, $name)
	{
		if ($this->validateImageFile($file, $this->ruta, $name, 500, 500)) {
			$this->imagen = $this->getImageName();
			return true;
		} else {
			return false;
		}
	}

	
	public function setEstado($value)
	{
		if ($value == 0 || $value == 1) {
			$this->estado = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getEstado()
	{
		return $this->estado;
	}


	public function getImagen()
	{
		return $this->imagen;
	}

	public function getRuta()
	{
		return $this->ruta;
	}

	public function setPrecio($value)
	{
		if ($value) {
			if ($this->validateMoney($value)) {
				$this->precio = $value;
				return true;
			} else {
				return false;
			}
		} else {
			$this->precio = null;
			return true;
		}
	}

	public function getPrecio()
	{
		return $this->precio;
	}
	public function setCategoria($value)
	{
		if($this->validateId($value)){
			$this->id_categoria=$value;
			return true;	
		}else{
			return false;
		}
	}
	public function getCategoria()
	{
		return $this->id_categoria;
	}

	public function setReceta($value)
	{
		if($this->validateId($value)){
			$this->id_receta= $value;
			return true;
		}else{
			return false;
		}

	}
	public function getReceta()
	{
		return $this->id_receta;
	}


	// Metodos para el manejo del SCRUD
	public function createPlatillo()
    {
        $sql = 'INSERT INTO platillos(nombre_platillo, precio, id_receta, id_categoria, estado, imagen) VALUES (?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->precio, $this->id_receta, $this->id_categoria, $this->estado, $this->imagen);
        return Conexion::executeRow($sql, $params);
    }

    public function getPlatillo()
    {
        $sql = 'SELECT id_platillo, nombre_platillo, imagen, precio, estado, id_receta, id_categoria FROM Platillos WHERE id_platillo = ?';
        $params = array($this ->id);
        return Conexion::getRow($sql, $params);
    }
    public function readPlatillo()
    {
        $sql = 'SELECT id_platillo, nombre_platillo, precio, receta.nombre_receta, categorias.nombre_categoria, imagen, platillos.estado From Platillos INNER JOIN categorias USING (id_categoria) INNER JOIN receta USING (id_receta) ORDER BY nombre_platillo';
        $params = array(null);
        return Conexion::getRows($sql, $params);
    }

    public function searchEmpleados()
    {
        $sql = 'SELECT * FROM Platillos WHERE nombre_platillo LIKE ? OR precio';
        $params = array("%$value%", "%$value%");
        return Conexion::getRows($sql, $params);
    }

    public function readCategoria()
    {
        $sql = 'SELECT id_categoria, nombre_categoria FROM Categorias';
        $params = array(null);
        return Conexion::getRows($sql, $params);
	}
	public function readReceta()
    {
        $sql = 'SELECT id_receta, nombre_receta FROM Receta';
        $params = array(null);
        return Conexion::getRows($sql, $params);
    }

    public function updatePlatillo()
    {
        $sql = 'UPDATE Empleados SET nombre_empleado = ?, apellido_empleado = ?, dui = ?, direccion = ?, telefono = ?, genero = ?, fecha_nacimiento = ?, nacionalidad = ?, correo = ?, id_cargo = ?, id_usuario = ? WHERE id_empleado = ?';
        $params = array($this->nombre_empleado, $this->apellido_empleado, $this->dui, $this->direccion, $this->telefono, $this->genero, $this->fecha_nacimiento, $this->nacionalidad, $this->correo, $this->id_cargo, $this->id_usuario, $this->id);
        return Conexion::executeRow($sql, $params);
    }

    public function deletePlatillo()
    {
        $sql = 'DELETE FROM Platillos WHERE id_platillo = ?';
        $params = array($this->id);
        return Conexion::executeRow($sql, $params);
    }
}
?>
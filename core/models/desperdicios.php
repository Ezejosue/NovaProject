<?php
class Desperdicios extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $id_platillo = null;
	private $id_usuario = null;
	private $id_empleado = null;

	// Métodos para sobrecarga de propiedades
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
	
	
	public function getid_platillo()
	{
		return $this->id_platillo;
	}

	public function setid_platillo($value)
	{
		if ($this->validateId($value)) {
			$this->id_platillo = $value;
			return true;
		} else {
			return false;
		}
	}


	public function setid_usuario($value){
		if ($this->validateId($value)) {
			$this->id_usuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getid_usuario()
	{
		return $this->id_usuario;
	}

	public function setid_empleado($value)
	{
		if($this->validateId($value)) {
			$this->id_usuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getid_empleado()
	{
		return $this->id_empleado;
	}

	// Metodos para el manejo del SCRUD
	public function readDesperdicios()
	{
		$sql = 'SELECT id_desperdicios, nombre_platillo, alias, nombre_empleado FROM platillos INNER JOIN desperdicios USING(id_platillo) 
        INNER JOIN usuarios USING (id_usuario) 
        INNER JOIN empleados USING (id_empleado) GROUP BY nombre_platillo';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function createDesperdicios()
	{
		$sql = 'INSERT INTO `desperdicios` (`id_platillo`, `id_usuario`, `id_empleado`) VALUES (?, ?, ?);';
		$params = array($this->id_platillo, $this->id_usuario, $this->id_empleado);
		return conexion::executeRow($sql, $params);
	}
	
	public function getDesperdicios()
	{
		$sql = 'SELECT id_platillo, id_usuario id_empleado FROM desperdicios WHERE id_desperdicios = ?';
		$params = array($this->id);
		return conexion::getRow($sql, $params);
	}
	

	public function readPlatillos()
	{
		$sql = 'SELECT id_platillo, nombre_platillo FROM platillos';
		$params = array(null);
		return conexion::getRow($sql, $params);
	}

	
	public function readNombreUsuario()
	{
		$sql = 'SELECT id_usuario, alias FROM usuarios WHERE estado_usuario = 1';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function readEmpleados()
	{
		$sql = 'SELECT id_empleado, nombre_empleado FROM empleados';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function updateDesperdicios()
	{
		$sql = 'UPDATE desperdicios SET id_platillo = ?, id_usuario= ?, id_empleado=? WHERE id_desperdicios = ?';
		$params = array($this->id_platillo,  $this->id_usuario, $this->id_empleado);
		return conexion::executeRow($sql, $params);
	}

	public function deleteDesperdicios()
	{
		$sql = 'DELETE FROM desperdicios WHERE id_desperdicios = ?';
		$params = array($this->id);
		return conexion::executeRow($sql, $params);
	}
}
?>

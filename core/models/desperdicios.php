<?php
class Desperdicios extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $cantidad = null;
	private $id_receta = null;
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
	
	
	public function getid_receta()
	{
		return $this->id_receta;
	}

	
	public function setCantidad($value)
	{
		if ($this->validateMoney($value, 1, 2000)) {
			$this->cantidad = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCantidad()
	{
		return $this->cantidad;
	}

	public function setid_receta($value)
	{
		if ($this->validateId($value)) {
			$this->id_receta = $value;
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
			$this->id_empleado = $value;
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
		$sql = 'SELECT id_desperdicios, desperdicios.cantidad, nombre_receta, alias, nombre_empleado, fecha_desperdicio FROM desperdicios INNER JOIN receta USING(id_receta) 
        INNER JOIN usuarios USING (id_usuario) 
        INNER JOIN empleados USING (id_empleado)';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function createDesperdicios()
	{
		$sql = 'INSERT INTO `desperdicios` (`id_receta`, `cantidad`, `id_usuario`, `id_empleado`) VALUES (?, ?, ?, ?);';
		$params = array($this->id_receta, $this->cantidad, $this->id_usuario, $this->id_empleado);
		return conexion::executeRow($sql, $params);
	}
	
	public function getDesperdicios()
	{
		$sql = 'SELECT id_desperdicios, id_receta, cantidad, id_usuario, id_empleado FROM desperdicios WHERE id_desperdicios = ?';
		$params = array($this->id);
		return conexion::getRow($sql, $params);
	}
	

	public function readReceta()
	{
		$sql = 'SELECT id_receta, nombre_receta FROM receta';
		$params = array(null);
		return conexion::getRows($sql, $params);
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

	public function readRecetaDesperdicio($receta)
	{
		$sql = "SELECT alias, fecha_desperdicio, nombre_receta, COUNT(cantidad) as Desperdicio from desperdicios INNER JOIN receta USING(id_receta) INNER JOIN usuarios USING(id_usuario) where id_receta =  $receta  GROUP BY nombre_receta";
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function updateDesperdicios()
	{
		$sql = 'UPDATE desperdicios SET id_receta = ?, cantidad = ?, id_usuario= ?, id_empleado=? WHERE id_desperdicios = ?';
		$params = array($this->id_receta, $this->cantidad, $this->id_usuario, $this->id_empleado, $this->id);
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

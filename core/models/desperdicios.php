<?php
class Materias extends Validator
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
	
	public function setid_platillo($value)
	{
		if ($this->validateId($value) {
			$this->id_platillo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getid_platillo()
	{
		return $this->id_platillo;
	}

	public function setid_usuario($value)
	{
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
		if($this->validateId($value) {
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

	public function getMateriaPrima()
	{
		$sql = 'SELECT idMateria , nombre_materia, m.descripcion, cantidad, foto, id_categoria, id_Medida, m.estado 
				FROM materiasprimas m
				WHERE idMateria = ?';
		$params = array($this->id);
		return conexion::getRow($sql, $params);
	}

	
	public function readCategoriaMateria()
	{
		$sql = 'SELECT id_categoria, nombre_categoria, descripcion FROM categorias WHERE estado = 1';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function readMedidaMateria()
	{
		$sql = 'SELECT id_Medida, nombre_medida, descripcion FROM unidadmedida';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function updateMateriaPrima()
	{
		$sql = 'UPDATE materiasprimas SET nombre_materia = ?, descripcion = ?, cantidad=?, id_categoria = ?, id_Medida = ?, foto = ?, estado = ? WHERE idMateria = ?';
		$params = array($this->nombre,  $this->descripcion, $this->cantidad, $this->categorias, $this->idmedida, $this->imagen, $this->estado, $this->id);
		return conexion::executeRow($sql, $params);
	}

	public function deleteMateriaPrima()
	{
		$sql = 'DELETE FROM materiasprimas WHERE idMateria = ?';
		$params = array($this->id);
		return conexion::executeRow($sql, $params);
	}
}
?>

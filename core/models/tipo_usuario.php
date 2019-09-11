<?php
class Tipo_usuario extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $nombre = null;
	private $descripcion = null;
	private $estado = null;

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

	public function setDescripcion($value)
	{
		if ($value) {
			if ($this->validateAlphanumeric($value, 1, 200)) {
				$this->descripcion = $value;
				return true;
			} else {
				return false;
			}
		} else {
			$this->descripcion = null;
			return true;
		}
	}

	public function getDescripcion()
	{
		return $this->descripcion;
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

	// Metodos para el manejo del SCRUD
	public function readTipo_usuario()
	{
		$sql = 'SELECT id_Tipousuario, tipo, descripcion, estado FROM tipousuario ORDER BY tipo';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function readVistas()
	{
		$sql = 'SELECT id_vista, nombre_vista, id_Tipousuario, estado FROM acciones INNER JOIN vistas USING(id_vista) WHERE id_Tipousuario = ?';
		$params = array($this->id);
		return conexion::getRows($sql, $params);
	}

	public function createTipo_usuario()
	{
		$sql = 'INSERT INTO tipousuario(tipo, descripcion, estado) VALUES(?, ?, ?)';
		$params = array($this->nombre, $this->descripcion, $this->estado);
		return conexion::executeRow($sql, $params);
	}

	public function getTipo_usuario()
	{
		$sql = 'SELECT id_Tipousuario, tipo, descripcion, estado FROM tipousuario WHERE id_Tipousuario = ?';
		$params = array($this->id);
		return conexion::getRow($sql, $params);
	}

	public function updateTipo_usuario()
	{
		$sql = 'UPDATE tipousuario SET tipo = ?, descripcion = ?, estado=? WHERE id_Tipousuario = ?';
		$params = array($this->nombre,  $this->descripcion, $this->estado, $this->id);
		return conexion::executeRow($sql, $params);
	}

	public function deleteTipo_usuario()
	{
		$sql = 'DELETE FROM tipousuario WHERE id_Tipousuario = ?';
		$params = array($this->id);
		return conexion::executeRow($sql, $params);
	}
}
?>

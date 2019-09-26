<?php
class Tipo_usuario extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $nombre = null;
	private $descripcion = null;
	private $estado = null;
	private $idVista = null;

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

	public function setIdVista($value)
	{
		if ($this->validateId($value)) {
			$this->idVista = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdVista()
	{
		return $this->idVista;
	}

	// Metodos para el manejo del SCRUD
	public function readTipo_usuario()
	{
		$sql = 'SELECT id_Tipousuario, tipo, descripcion, estado FROM tipousuario ORDER BY tipo';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function readAcciones()
	{
		$sql = 'SELECT id_vista, nombre_vista, id_Tipousuario, estado FROM acciones INNER JOIN vistas USING(id_vista) WHERE id_Tipousuario = ?';
		$params = array($this->id);
		return conexion::getRows($sql, $params);
	}

	public function updateAcciones()
	{
		$sql = 'UPDATE acciones SET estado = ? WHERE id_vista = ? AND id_Tipousuario = ?';
		$params = array($this->estado, $this->idVista, $this->id);
		return conexion::executeRow($sql, $params);
	}

	public function readMenu()
	{
		$sql = 'SELECT nombre_vista, ruta, icono FROM acciones INNER JOIN vistas USING(id_vista) WHERE estado = 1 AND id_Tipousuario = ?';
		$params = array($this->id);
		return Conexion::getRows($sql, $params);
	}

	public function createTipo_usuario()
	{
		$sql = 'INSERT INTO tipousuario(tipo, descripcion, estado) VALUES(?, ?, ?)';
		$params = array($this->nombre, $this->descripcion, $this->estado);
		return conexion::executeRow($sql, $params);
	}

	public function readUltimoTipo()
	{
		$sql = 'SELECT MAX(id_Tipousuario) as Id FROM tipousuario';
		$params = array(null);
		$data = conexion::getRow($sql, $params);
		if($data){
			$this->id = $data['Id'];
			return true;
		} else {
			return false;
		}
	}

	public function getVistas()
	{
		$sql = 'SELECT id_vista FROM vistas ORDER BY id_vista';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function createAccion()
	{
		$sql = 'INSERT INTO acciones(id_vista, id_Tipousuario, estado) VALUES (?, ?, ?)';
		$params = array($this->idVista,  $this->id, $this->estado);
		return conexion::executeRow($sql, $params);
	}

	public function getTipo_usuario()
	{
		$sql = 'SELECT id_Tipousuario, tipo, descripcion, estado FROM tipousuario WHERE id_Tipousuario = ? LIMIT 1';
		$params = array($this->id);
		return conexion::getRow($sql, $params);
	}

	public function updateTipo_usuario()
	{
		$sql = 'UPDATE tipousuario SET tipo = ?, descripcion = ?, estado=? WHERE id_Tipousuario = ?';
		$params = array($this->nombre,  $this->descripcion, $this->estado, $this->id);
		return conexion::executeRow($sql, $params);
	}

	public function deleteAcciones()
	{
		$sql = 'DELETE FROM acciones WHERE id_Tipousuario = ?';
		$params = array($this->id);
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

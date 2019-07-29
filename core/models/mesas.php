<?php
class Mesas extends Validator
{
	// Declaración de propiedades
	private $idMesa = null;
	private $numero_mesa = null;
	private $estado_mesa = null;
	// Métodos para sobrecarga de propiedades
	public function setIdMesa($value)
	{
		if ($this->validateId($value)) {
			$this->idMesa = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdMesa()
	{
		return $this->idMesa;
	}

	public function setNumero_mesa($value)
	{
		if ($this->validateId($value)) {
			$this->numero_mesa = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNumero_mesa()
	{
		return $this->numero_mesa;
	}

	public function setEstado_mesa($value)
	{
		if ($value == 0 || $value == 1) {
			$this->estado_mesa = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getEstado_mesa()
	{
		return $this->estado_mesa;
	}

	// Metodos para el manejo del SCRUD

	public function createMesas()
	{
		$sql = 'INSERT INTO mesas(numero_mesa, estado_mesa) VALUES(?, ?)';
		$params = array($this->numero_mesa, $this->estado_mesa);
		return conexion::executeRow($sql, $params);
    }
    
	public function readMesas()
	{
		$sql = 'SELECT id_mesa, numero_mesa, estado_mesa FROM mesas';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function getMesa()
	{
		$sql = 'SELECT id_mesa, numero_mesa, estado_mesa FROM mesas WHERE id_mesa = ?';
		$params = array($this->idMesa);
		return conexion::getRow($sql, $params);
	}

	public function updateMesas()
	{
		$sql = 'UPDATE mesas SET numero_mesa = ?, estado_mesa = ? WHERE id_mesa = ?';
		$params = array($this->numero_mesa,  $this->estado_mesa, $this->idMesa);
		return conexion::executeRow($sql, $params);
	}
}
?>

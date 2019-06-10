<?php
class UnidadMedida extends Validator
{
	// Declaración de propiedades
	private $idmedida = null;
	private $nombremedida = null;
	private $descripcion = null;

	// Métodos para sobrecarga de propiedades
	public function setIdMedida($value)
	{
		if ($this->validateId($value)) {
			$this->idmedida = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdMedida()
	{
		return $this->idmedida;
	}

	public function setNombreMedida($value)
	{
		if($this->validateAlphanumeric($value, 1, 50)) {
			$this->nombremedida = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombreMedida()
	{
		return $this->nombremedida;
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
			$this->elaboracion = null;
			return true;
		}
	}

	public function getDescripcion()
	{
		return $this->descripcion;
	}

	// Metodos para el manejo del SCRUD
	public function readUnidades()
	{
		$sql = 'SELECT id_Medida, nombre_medida, descripcion FROM unidadmedida ORDER BY nombre_medida';
		$params = array(null);
		return conexion::getRows($sql, $params);
	} 

	public function createMedida()
	{
		$sql = 'INSERT INTO unidadmedida(nombre_medida, descripcion) VALUES(?, ?)';
		$params = array($this->nombremedida, $this->descripcion);
		return conexion::executeRow($sql, $params);
    }
    
	public function getMedida()
	{
		$sql = 'SELECT id_Medida, nombre_medida, descripcion FROM unidadmedida WHERE id_Medida = ?';
		$params = array($this->idmedida);
		return conexion::getRow($sql, $params);
	}

	public function updateMedida()
	{
		$sql = 'UPDATE unidadmedida SET nombre_medida = ?, descripcion = ? WHERE id_Medida = ?';
		$params = array($this->nombremedida,  $this->descripcion, $this->idmedida);
		return conexion::executeRow($sql, $params);
	}

	public function deleteMedida()
	{
		$sql = 'DELETE FROM unidadmedida WHERE id_Medida = ?';
		$params = array($this->idmedida);
		return conexion::executeRow($sql, $params);
	}
}
?>

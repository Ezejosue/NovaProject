<?php
class Recetas extends Validator
{
	// Declaración de propiedades
	private $idreceta = null;
	private $nombrereceta = null;
	private $tiempo = null;
	private $elaboracion = null;
	private $idmateria = null;
	private $idmedida = null;
	private $cantidad = null;

	// Métodos para sobrecarga de propiedades
	public function setIdReceta($value)
	{
		if ($this->validateId($value)) {
			$this->idreceta = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdReceta()
	{
		return $this->idreceta;
	}

	public function setNombreReceta($value)
	{
		if($this->validateAlphanumeric($value, 1, 50)) {
			$this->nombrereceta = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombreReceta()
	{
		return $this->nombrereceta;
	}

	public function setElaboracion($value)
	{
		if ($value) {
			if ($this->validateAlphanumeric($value, 1, 200)) {
				$this->elaboracion = $value;
				return true;
			} else {
				return false;
			}
		} else {
			$this->elaboracion = null;
			return true;
		}
	}

	public function getElaboracion()
	{
		return $this->elaboracion;
	}

	public function setTiempo($value)
	{
		if($this->validateAlphanumeric($value, 1, 500)) {
			$this->tiempo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getTiempo()
	{
		return $this->tiempo;
	}

	public function setIdCategoria($value)
	{
		if ($this->validateId($value)) {
			$this->idcategoria = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdCategoria()
	{
		return $this->idcategoria;
	}

	public function setIdMateria($value)
	{
		if ($this->validateId($value)) {
			$this->idmateria = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdMateria()
	{
		return $this->idmateria;
	}

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

	public function setCantidad($value)
	{
		if ($this->validateId($value)) {
			$this->idmedida = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCantidad()
	{
		return $this->idmedida;
	}

	


	// Metodos para el manejo del SCRUD
	public function readRecetas()
	{
		$sql = 'SELECT id_receta, nombre_receta, tiempo, elaboracion
				FROM receta r 
				ORDER BY nombre_receta';
		$params = array(null);
		return conexion::getRows($sql, $params);
	} 

	public function createRecetas()
	{
		$sql = 'INSERT INTO receta(nombre_receta, tiempo, elaboracion, idMateria, cantidad) VALUES(?, ?, ?, ?, ?)';
		$params = array($this->nombrereceta, $this->tiempo, $this->elaboracion, $this->idmateria, $this->cantidad);
		return conexion::executeRow($sql, $params);
	}

	public function getReceta()
	{
		$sql = 'SELECT id_receta, nombre_receta, tiempo, elaboracion, m.nombre_materia, u.nombre_medida, r.cantidad 
				FROM receta r 
				INNER JOIN materiasprimas m ON m.idMateria = r.idMateria 
				INNER JOIN unidadmedida u ON u.id_Medida = m.id_Medida 
				ORDER BY nombre_receta
				WHERE id_receta = ?';
		$params = array($this->idreceta);
		return conexion::getRow($sql, $params);
	}

	public function readMateriaPrima()
	{
		$sql = 'SELECT idMateria, nombre_materia, u.descripcion 
				FROM materiasprimas m 
				INNER JOIN unidadmedida u ON m.id_Medida = u.id_Medida
				WHERE estado = 1';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function updateReceta()
	{
		$sql = 'UPDATE receta SET nombre_receta = ?, tiempo = ?, elaboracion = ?, id_categoria = ?, idMateria = ? WHERE id_receta = ?';
		$params = array($this->nombrereceta,  $this->tiempo, $this->elaboracion, $this->idcategoria, $this->idmateria, $this->idreceta);
		return conexion::executeRow($sql, $params);
	}

	public function deleteReceta()
	{
		$sql = 'DELETE FROM receta WHERE id_receta = ?';
		$params = array($this->idreceta);
		return conexion::executeRow($sql, $params);
	}
}
?>

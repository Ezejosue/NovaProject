<?php
class Recetas extends Validator
{
	// Declaración de propiedades
	private $idreceta = null;
	private $nombrereceta = null;
	private $tiempo = null;
	private $elaboracion = null;
	private $idelab = null;
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

	public function setIdElab($value)
	{
		if ($this->validateId($value)) {
			$this->idelab = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdElab()
	{
		return $this->idelab;
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

	// Metodos para el manejo del SCRUD
	public function readRecetas()
	{
		$sql = 'SELECT id_receta, nombre_receta, tiempo
				FROM receta r 
				ORDER BY nombre_receta';
		$params = array(null);
		return conexion::getRows($sql, $params);
	} 

	public function createRecetas()
	{
		$sql = 'INSERT INTO receta(nombre_receta, tiempo) VALUES(?, ?)';
		$params = array($this->nombrereceta, $this->tiempo);
		return conexion::executeRow($sql, $params);
	}

	public function getReceta()
	{
		$sql = 'SELECT id_receta, nombre_receta, tiempo
				FROM receta 
				WHERE id_receta = ? LIMIT 1';
		$params = array($this->idreceta);
		return conexion::getRow($sql, $params);
	}

	public function getElab()
	{
		$sql = 'SELECT id_elaboracion, id_receta, e.cantidad, idMateria 
		FROM elaboraciones e 
		INNER JOIN materiasprimas USING(idMateria) 
		WHERE id_elaboracion = ? LIMIT 1';
		$params = array($this->idelab);
		return conexion::getRow($sql, $params);
	}

	public function createElaboracion()
	{
		$sql = 'INSERT INTO elaboraciones(id_receta, cantidad, idMateria) VALUES(?, ?, ?)';
		$params = array($this->idreceta, $this->cantidad, $this->idmateria);
		return Conexion::executeRow($sql, $params);
	}


	public function readMateriasPrimas()
	{
		$sql = 'SELECT idMateria, CONCAT(nombre_materia, " (" ,u.descripcion, ")") AS Materia 
		FROM materiasprimas INNER JOIN unidadmedida u USING(id_Medida) GROUP BY nombre_materia ';
		$params = array($this->idreceta);
		return Conexion::getRows($sql, $params);
	}

	public function updateReceta()
	{
		$sql = 'UPDATE receta SET nombre_receta = ?, tiempo = ? WHERE id_receta = ?';
		$params = array($this->nombrereceta,  $this->tiempo, $this->idreceta);
		return conexion::executeRow($sql, $params);
	}

	public function updateElaboracion()
	{
		$sql = 'UPDATE elaboraciones SET id_receta = ?, cantidad = ?, idMateria = ? WHERE id_elaboracion = ?';
		$params = array($this->idreceta,  $this->cantidad, $this->idmateria, $this->idelab);
		return conexion::executeRow($sql, $params);
	}

	public function deleteElaboracion()
	{
		$sql = 'DELETE FROM elaboraciones WHERE id_elaboracion = ?';
		$params = array($this->idelab);
		return conexion::executeRow($sql, $params);
	}

	public function deleteReceta()
	{
		$sql = 'DELETE FROM elaboraciones WHERE id_receta = ? ; DELETE FROM receta WHERE id_receta = ?';
		$params = array($this->idreceta, $this->idreceta);
		return conexion::executeRow($sql, $params);
	}

	public function deleteElaboracion()
	{
		$sql = 'DELETE FROM elaboraciones WHERE id_elaboracion = ?';
		$params = array($this->idelab);
		return conexion::executeRow($sql, $params);
	}
	
	public function getMateriasRecetas()
	{
		$sql = 'SELECT id_elaboracion, id_receta, CONCAT(nombre_materia, " (", u.descripcion, ")") AS MateriaPrima, e.cantidad
		FROM elaboraciones e 
		INNER JOIN materiasprimas USING (idMateria)
		INNER JOIN unidadmedida u USING (id_Medida) WHERE id_receta = ?';
		$params = array($this->idreceta);
		return conexion::getRows($sql, $params);
	}

	public function RecetaCategoria()
	{
		$sql = 'SELECT nombre_categoria, nombre_receta, elaboracion from receta INNER JOIN categorias USING(id_categoria) GROUP by nombre_categoria LIMIT 10';
		$params = array(null);
		return conexion::executeRow($sql, $params);
	}
}
?>

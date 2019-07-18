<?php
class Categorias extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $nombre = null;
	private $imagen = null;
	private $descripcion = null;
	private $estado = null;
	private $ruta = '../../resources/img/categorias/';

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

	public function setImagen($file, $name)
	{
		if ($this->validateImageFile($file, $this->ruta, $name, 500, 500)) {
			$this->imagen = $this->getImageName();
			return true;
		} else {
			return false;
		}
	}

	public function getImagen()
	{
		return $this->imagen;
	}

	public function getRuta()
	{
		return $this->ruta;
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

	// Métodos para el manejo del SCRUD
	public function readCategorias()
	{
		$sql = 'SELECT id_categoria, nombre_categoria, descripcion, foto_categoria, estado FROM categorias ORDER BY nombre_categoria';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function createCategoria()
	{
		$sql = 'INSERT INTO categorias(nombre_categoria, descripcion, foto_categoria, estado) VALUES(?, ?, ?, ?)';
		$params = array($this->nombre, $this->descripcion, $this->imagen, $this->estado);
		return conexion::executeRow($sql, $params);
	}

	public function getCategoria()
	{
		$sql = 'SELECT id_categoria, nombre_categoria, descripcion, foto_categoria, estado FROM categorias WHERE id_categoria = ?';
		$params = array($this->id);
		return conexion::getRow($sql, $params);
	}

	public function updateCategoria()
	{
		$sql = 'UPDATE categorias SET nombre_categoria = ?, descripcion = ?, foto_categoria = ?, estado=? WHERE id_categoria = ?';
		$params = array($this->nombre,  $this->descripcion, $this->imagen, $this->estado, $this->id);
		return conexion::executeRow($sql, $params);
	}

	public function deleteCategoria()
	{
		$sql = 'DELETE FROM categorias WHERE id_categoria = ?';
		$params = array($this->id);
		return conexion::executeRow($sql, $params);
	}

	public function graficar_existencia_categoria()
	{//funcion para traer la cantidad de materia prima por categoria
		$sql = 'SELECT SUM(materiasprimas.cantidad) cantidad, nombre_categoria FROM materiasprimas INNER JOIN categorias USING (id_categoria) WHERE materiasprimas.estado = 1 GROUP BY nombre_categoria';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

}
?>

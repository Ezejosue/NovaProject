<?php
class Materias extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $nombre = null;
	private $imagen = null;
	private $descripcion = null;
	private $categorias = null;
	private $estado = null;
	private $ruta = '../../resources/img/materia/';

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

	public function setCategorias($value)
	{
		if ($this->validateId($value)) {
			$this->categorias = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCategorias()
	{
		return $this->categorias;
	}

	public function setNombre($value)
	{
		if($this->validateAlphanumeric($value, 1, 120)) {
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
			if ($this->validateAlphanumeric($value, 1, 300)) {
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
	public function readMateriaPrima()
	{
		$sql = 'SELECT idMateria , nombre_materia, materiasprimas.descripcion, foto, nombre_categoria, materiasprimas.estado FROM materiasprimas INNER JOIN categorias using (id_categoria)';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function createMateriaPrima()
	{
		$sql = 'INSERT INTO materiasprimas(nombre_materia, descripcion, foto, id_categoria, estado) VALUES(?, ?, ?, ?, ?)';
		$params = array($this->nombre, $this->descripcion, $this->imagen, $this->categorias,  $this->estado);
		return conexion::executeRow($sql, $params);
	}

	public function getMateriaPrima()
	{
		$sql = 'SELECT idMateria , nombre_materia , descripcion, foto, id_categoria, estado FROM materiasprimas WHERE idMateria = ?';
		$params = array($this->id);
		return conexion::getRow($sql, $params);
	}

	
	public function readCategoriaMateria()
	{
		$sql = 'SELECT id_categoria, nombre_categoria, descripcion FROM categorias WHERE estado = 1';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function updateMateriaPrima()
	{
		$sql = 'UPDATE materiasprimas SET nombre_materia = ?, descripcion = ?, id_categoria = ?, foto = ?, estado=? WHERE idMateria = ?';
		$params = array($this->nombre,  $this->descripcion, $this->categorias, $this->imagen, $this->estado, $this->id);
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

<?php
class Materias extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $nombre = null;
	private $descripcion = null;
	private $cantidad = null;
	private $imagen = null;
	private $categorias = null;
	private $idmedida = null;
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
		$sql = 'SELECT idMateria , nombre_materia, m.descripcion, cantidad, foto, nombre_categoria, nombre_medida, m.estado 
				FROM materiasprimas m 
				INNER JOIN categorias c ON c.id_categoria = m.id_categoria 
				INNER JOIN unidadmedida u ON u.id_Medida = m.id_Medida';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function createMateriaPrima()
	{
		$sql = 'INSERT INTO materiasprimas(nombre_materia, descripcion, cantidad, foto, id_categoria, id_Medida, estado) VALUES(?, ?, ?, ?, ?, ?, ?)';
		$params = array($this->nombre, $this->descripcion, $this->cantidad, $this->imagen, $this->categorias, $this->idmedida, $this->estado);
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

	public function readMeteriaCategoria()
	{
		$sql = 'SELECT nombre_materia, cantidad, nombre_categoria from materiasprimas INNER JOIN categorias USING(id_categoria) GROUP by nombre_categoria';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function readMeteriaCategoria1($categoria)
	{
		$sql = "SELECT nombre_materia, cantidad, nombre_categoria from materiasprimas INNER JOIN categorias USING(id_categoria) WHERE id_categoria = $categoria GROUP by nombre_categoria";
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

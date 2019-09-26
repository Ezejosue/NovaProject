<?php
class Materias extends Validator
{
	// Declaración de propiedades
	private $id = null;
	private $nombre = null;
	private $descripcion = null;
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
			if ($this->validateAlphanumeric($value, 1, 1000)) {
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
		$sql = 'SELECT idMateria , nombre_materia, m.descripcion, foto, nombre_categoria, nombre_medida, m.estado 
				FROM materiasprimas m 
				INNER JOIN categorias c ON c.id_categoria = m.id_categoria 
				INNER JOIN unidadmedida u ON u.id_Medida = m.id_Medida';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function createMateriaPrima()
	{
		$sql = 'INSERT INTO materiasprimas(nombre_materia, descripcion, foto, id_categoria, id_Medida, estado) VALUES(?, ?, ?, ?, ?, ?)';
		$params = array($this->nombre, $this->descripcion, $this->imagen, $this->categorias, $this->idmedida, $this->estado);
		return conexion::executeRow($sql, $params);
	}

	public function getMateriaPrima()
	{
		$sql = 'SELECT idMateria , nombre_materia, m.descripcion, foto, id_categoria, id_Medida, m.estado 
				FROM materiasprimas m
				WHERE idMateria = ? LIMIT 1';
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
		$sql = 'CALL `materiasPorCategoria`();';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function readMeteriaCategoria1($categoria)
	{
		$sql = "SELECT nombre_categoria, (COALESCE(SUM(cantidad),0)-(SELECT COALESCE(SUM(elab.`cantidad`),0) 
		FROM pedidos AS ped 
		JOIN detalle_pedido detped USING(`id_pedido`) 
		JOIN platillos plat USING (`id_platillo`) 
		JOIN receta rec USING(`id_receta`)
		JOIN elaboraciones elab USING(`id_receta`)
		WHERE elab.`idMateria`=inv.`idMateria` ORDER BY elab.`idMateria`)-(SELECT (COALESCE(SUM(des.cantidad),0)*COALESCE(SUM(elab.cantidad),0)) AS Cantidad FROM desperdicios des JOIN receta re USING(`id_receta`) JOIN elaboraciones elab USING(`id_receta`)
		WHERE elab.idMateria= inv.`idMateria`
		GROUP BY elab.idMateria )) AS CantidadTotal, CONCAT(nombre_materia, ' (', uni.descripcion, ')') AS Materia 
		FROM inventarios AS inv JOIN facturas AS fact ON inv.`id_factura`=fact.`id_factura` 
		JOIN materiasprimas mate USING(`idMateria`) JOIN unidadmedida uni USING(id_Medida)
		JOIN categorias cat USING(`id_categoria`)
		WHERE fact.`estado`= 1 AND mate.`id_categoria` = $categoria GROUP BY cat.`nombre_categoria`";
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function updateMateriaPrima()
	{
		$sql = 'UPDATE materiasprimas SET nombre_materia = ?, descripcion = ?, id_categoria = ?, id_Medida = ?, foto = ?, estado = ? WHERE idMateria = ?';
		$params = array($this->nombre,  $this->descripcion, $this->categorias, $this->idmedida, $this->imagen, $this->estado, $this->id);
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

<?php
class Inventarios extends Validator
{
	/* Declaración de propiedades */
    private $id_inventario = null;
    private $id_factura = null;
    private $idMateria = null;
    private $cantidad = null;
    private $precio = null;
	private $id_proveedor = null;
	private $id_usuario = null;
    private $correlativo = null;
    private $estado = null;

	/* Métodos para sobrecarga de propiedades */
	public function setId_inventario($value)
	{
		if ($this->validateId($value)) {
			$this->id_inventario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getId_inventario()
	{
		return $this->id_inventario;
	}
	
	public function setCorrelativo($value)
	{
		if ($this->validateCorrelativo($value)) {
			$this->correlativo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCorrelativo()
	{
		return $this->correlativo;
	}

	public function setId_factura($value)
	{
		if ($this->validateId($value)) {
			$this->id_factura = $value;
			return true;
		} else {
			return false;
		}
    }
    
    public function getId_factura()
	{
		return $this->id_factura;
    }
    
    public function setIdmateria($value)
	{
		if ($this->validateId($value)) {
			$this->idMateria = $value;
			return true;
		} else {
			return false;
		}
    }
    
    public function getIdmateria()
	{
		return $this->idMateria;
    }
    
    public function setId_proveedor($value)
	{
		if ($this->validateId($value)) {
			$this->id_proveedor = $value;
			return true;
		} else {
			return false;
		}
    }
    
    public function getId_proveedor()
	{
		return $this->id_proveedor;
    }


	public function setId_usuario($value){
		if ($this->validateId($value)) {
			$this->id_usuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getId_usuario()
	{
		return $this->id_usuario;
	}

	public function setCantidad($value)
	{
		if($this->validateId($value)) {
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

    public function setPrecio($value)
	{
		if ($value) {
			if ($this->validateMoney($value)) {
				$this->precio = $value;
				return true;
			} else {
				return false;
			}
		} else {
			$this->precio = null;
			return true;
		}
    }
    
	public function getPrecio()
	{
		return $this->precio;
	}

    public function setEstado($value)
	{
		if($this->validateId($value)) {
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

	/* Metodos para el manejo del SCRUD */
	/* Método para llenar table de facturas */
	public function readFacturas()
	{
		$sql = 'SELECT id_factura, correlativo, p.nom_proveedor, fecha_ingreso, u.alias, f.estado
        FROM facturas f INNER JOIN proveedores p USING(id_proveedor) 
        INNER JOIN usuarios u USING(id_usuario) ORDER BY f.estado';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	/* Método para obtener detalle de facturas */
	public function readFactura()
	{
		$sql = 'SELECT f.id_factura, correlativo, id_inventario, p.nom_proveedor, fecha_ingreso, us.alias , CONCAT(nombre_materia, " (" ,u.descripcion, ")") AS Materia, cantidad, precio, f.estado 
		FROM inventarios inv RIGHT JOIN materiasprimas m USING(idMateria) 
		RIGHT JOIN unidadmedida u USING(id_Medida) 
		RIGHT JOIN facturas f USING(id_factura) 
		RIGHT JOIN usuarios us USING(id_usuario) 
		RIGHT JOIN proveedores p USING(id_proveedor) WHERE f.id_factura = ?';
		$params = array($this->id_factura);
		return conexion::getRows($sql, $params);
	}

	/* Método para obtener datos de una factura */
	public function getFactura()
	{
		$sql = 'SELECT id_factura, correlativo, id_proveedor, estado FROM facturas f WHERE id_factura = ? LIMIT 1';
		$params = array($this->id_factura);
		return conexion::getRow($sql, $params);
	}

	/* Método para obtener datos de una fila de productos ingresados */
	public function getInventario()
	{
		$sql = 'SELECT id_inventario, idMateria, cantidad, precio, id_factura FROM inventarios WHERE id_inventario = ? LIMIT 1';
		$params = array($this->id_inventario);
		return conexion::getRow($sql, $params);
	}

	/* Método para crear una factura */
	public function createFactura()
	{
		$sql = 'INSERT INTO `facturas` (`correlativo`, `id_proveedor`, `id_usuario`, `estado`) VALUES (?, ?, ?, 2);';
		$params = array($this->correlativo, $this->id_proveedor, $this->id_usuario);
		return conexion::executeRow($sql, $params);
    }
	
	/* Método para llenar select de proveedores */
    public function readProveedores()
	{
		$sql = 'SELECT id_proveedor, nom_proveedor FROM proveedores WHERE estado = 1';
		$params = array(null);
		return conexion::getRows($sql, $params);
    }
	
	/* Método para llenar select de facturas con estado "en proceso" */
    public function readSelectFacturas()
	{
		$sql = 'SELECT id_factura, correlativo FROM facturas WHERE estado = 2';
		$params = array(null);
		return conexion::getRows($sql, $params);
    }
	
	/* Método para llenar select de materias primas/productos disponibles */
    public function readMateriasPrimas()
	{
		$sql = 'SELECT idMateria, CONCAT(nombre_materia, " (" ,u.descripcion, ")") AS Materia 
		FROM materiasprimas INNER JOIN unidadmedida u USING(id_Medida) GROUP BY nombre_materia ';
		$params = array(null);
		return Conexion::getRows($sql, $params);
    }
	
	/* Método para ingresar productos al detalle de facturas */    
    public function createInventario()
	{
		$sql = 'INSERT INTO `inventarios` (`idMateria`, `cantidad`, `precio`, `id_factura`) VALUES (?, ?, ?, ?);';
		$params = array($this->idMateria, $this->cantidad, $this->precio, $this->id_factura);
		return conexion::executeRow($sql, $params);
	}
	
	/* Método para modificar factura correlativo o proveedor de un factura */
	public function updateFactura()
	{
		$sql = 'UPDATE facturas SET correlativo = ?, id_proveedor = ? WHERE id_factura = ?';
		$params = array($this->correlativo,  $this->id_proveedor, $this->id_factura);
		return conexion::executeRow($sql, $params);
	}

	/* Método para modificar un producto del detalle de una factura */
	public function updateInventario()
	{
		$sql = 'UPDATE inventarios SET idMateria = ?, cantidad = ?, precio = ? WHERE id_inventario = ?';
		$params = array($this->idMateria,  $this->cantidad, $this->precio,  $this->id_inventario);
		return conexion::executeRow($sql, $params);
	}

	/* Método para cambiar estado de una factura */
	public function updateEstado()
	{
		$sql = 'UPDATE facturas SET estado = ? WHERE id_factura = ?';
		$estado_nuevo = null;
		if ($this->estado == 2) {
			$estado_nuevo = 1;
		}
		if ($this->estado == 1) {
			$estado_nuevo = 0;
		}
		$params = array($estado_nuevo, $this->id_factura);
		return conexion::executeRow($sql, $params);
	}

	/* Método para eliminar un producto del detalle de una factura */
	public function deleteInventario()
	{
		$sql = 'DELETE FROM inventarios WHERE id_inventario = ?';
		$params = array($this->id_inventario);
		return conexion::executeRow($sql, $params);
	}

	/* Método para llenar tabla de bodega */
	public function readBodega()
	{
		$sql = 'CALL readBodega();';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}
}
?>

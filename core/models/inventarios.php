<?php
class Inventarios extends Validator
{
	// Declaración de propiedades
    private $id_inventario = null;
    private $id_factura = null;
    private $idMateria = null;
    private $cantidad = null;
    private $precio = null;
	private $id_proveedor = null;
	private $id_usuario = null;
    private $correlativo = null;
    private $estado = null;

	// Métodos para sobrecarga de propiedades
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

	// Metodos para el manejo del SCRUD
	public function readFacturas()
	{
		$sql = 'SELECT correlativo, p.nom_proveedor, fecha_ingreso, u.alias 
        FROM facturas f INNER JOIN proveedores p USING(id_proveedor) 
        INNER JOIN usuarios u USING(id_usuario)';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function createFactura()
	{
		$sql = 'INSERT INTO `facturas` (`correlativo`, `id_proveedor`, `id_usuario`, `estado`) VALUES (?, ?, ?, 2);';
		$params = array($this->correlativo, $this->id_proveedor, $this->id_usuario);
		return conexion::executeRow($sql, $params);
    }
    
    public function readProveedores()
	{
		$sql = 'SELECT id_proveedor, nom_proveedor FROM proveedores WHERE estado = 1';
		$params = array(null);
		return conexion::getRows($sql, $params);
    }
    
    public function readSelectFacturas()
	{
		$sql = 'SELECT id_factura, correlativo FROM facturas WHERE estado = 2';
		$params = array(null);
		return conexion::getRows($sql, $params);
    }
    
    public function readMateriasPrimas()
	{
		$sql = 'SELECT idMateria, CONCAT(nombre_materia, " (" ,u.descripcion, ")") AS Materia 
		FROM materiasprimas INNER JOIN unidadmedida u USING(id_Medida) GROUP BY nombre_materia ';
		$params = array(null);
		return Conexion::getRows($sql, $params);
    }
    
    public function readInventario()
	{
		$sql = 'SELECT correlativo, CONCAT(nombre_materia, " (" ,u.descripcion, ")") AS Materia, cantidad, p.nom_proveedor, fecha_ingreso, us.alias 
        FROM inventarios INNER JOIN materiasprimas m USING(idMateria) 
        INNER JOIN unidadmedida u USING(id_Medida) 
        INNER JOIN facturas f USING(id_factura) 
        INNER JOIN usuarios us USING(id_usuario) 
        INNER JOIN proveedores p USING(id_proveedor)';
		$params = array(null);
		return Conexion::getRows($sql, $params);
    }
    
    public function createInventario()
	{
		$sql = 'INSERT INTO `inventarios` (`idMateria`, `cantidad`, `precio`, `id_factura`) VALUES (?, ?, ?, ?);';
		$params = array($this->idMateria, $this->cantidad, $this->precio, $this->id_factura);
		return conexion::executeRow($sql, $params);
    }
	
	public function getDesperdicios()
	{
		$sql = 'SELECT id_desperdicios, id_receta, cantidad, id_usuario, id_empleado FROM desperdicios WHERE id_desperdicios = ? LIMIT 1';
		$params = array($this->id);
		return conexion::getRow($sql, $params);
	}
	

	public function readReceta()
	{
		$sql = 'SELECT id_receta, nombre_receta FROM receta';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	
	public function readNombreUsuario()
	{
		$sql = 'SELECT id_usuario, alias FROM usuarios WHERE estado_usuario = 1';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function readEmpleados()
	{
		$sql = 'SELECT id_empleado, nombre_empleado FROM empleados';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function readRecetaDesperdicio($fecha, $fecha2)
	{
		$sql = "SELECT nombre_empleado, fecha_desperdicio, nombre_receta, cantidad from desperdicios INNER JOIN receta USING(id_receta) INNER JOIN empleados USING(id_empleado) where fecha_desperdicio >= ? AND fecha_desperdicio <= ?";
		$params = array($fecha, $fecha2);
		return Conexion::getRows($sql, $params);
	}

	public function updateDesperdicios()
	{
		$sql = 'UPDATE desperdicios SET id_receta = ?, cantidad = ?, id_usuario= ?, id_empleado=? WHERE id_desperdicios = ?';
		$params = array($this->id_receta, $this->cantidad, $this->id_usuario, $this->id_empleado, $this->id);
		return conexion::executeRow($sql, $params);
	}

	public function deleteDesperdicios()
	{
		$sql = 'DELETE FROM desperdicios WHERE id_desperdicios = ?';
		$params = array($this->id);
		return conexion::executeRow($sql, $params);
	}
}
?>

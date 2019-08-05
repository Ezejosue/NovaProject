<?php
class Pedidos extends Validator
{
	// Declaración de propiedades
	private $idPedido = null;
	private $fecha_pedido = null;
    private $idUsuario = null;
    private $idPlatillo = null;
    private $cantidad = null;
	// Métodos para sobrecarga de propiedades
	public function setIdPedido($value)
	{
		if ($this->validateId($value)) {
			$this->idPedido = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdPedido()
	{
		return $this->idPedido;
    }
    
    public function setFecha_pedido($value)
	{
		$this->fecha_pedido = $value;
	}

	public function getFecha_pedido()
	{
		return $this->fecha_pedido;
    }
    
    public function setIdUsuario($value)
	{
		if ($this->validateId($value)) {
			$this->idUsuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdUsuario()
	{
		return $this->idUsuario;
    }

    public function setIdPlatillo($value)
	{
		if ($this->validateId($value)) {
			$this->idPlatillo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdPlatillo()
	{
		return $this->idPlatillo;
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
	public function readDetalle()
	{
		$sql = 'SELECT id_detalle, id_pedido, id_platillo, nombre_platillo, cantidad, precio FROM detalle_pedido INNER JOIN platillos USING(id_platillo) WHERE id_pedido = ?';
		$params = array($this->idPedido);
		return conexion::getRows($sql, $params);
    }
    
    public function getPedido()
	{
		$sql = 'SELECT id_pedido, fecha_pedido, id_usuario FROM pedidos WHERE id_pedido = ?';
		$params = array($this->idPedido);
		return Conexion::getRow($sql, $params);
	}

	public function readPedidos()
	{
		$sql = 'SELECT id_pedido, fecha_pedido, alias FROM pedidos INNER JOIN usuarios USING(id_usuario)';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function readPedidosFecha()
	{
		$sql = 'SELECT fecha_pedido, COUNT(id_pedido) AS Pedidos FROM pedidos  GROUP BY fecha_pedido LIMIT 10';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}
}
?>

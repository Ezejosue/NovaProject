<?php
class Ordenes extends Validator
{
	// Declaración de propiedades
	private $idMesa = null;
	private $numero = null;
	private $categoria = null;
	private $platillo = null;
	private $cantidad = null;
	private $idPrepedido = null;
	private $idUsuario = null;	
	private $idPedido = null;

	// Métodos para sobrecarga de propiedades
	public function setIdMesa($value)
	{
		if ($this->validateId($value)) {
			$this->idMesa = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdMesa()
	{
		return $this->idMesa;
    }

    public function setNumero($value)
	{
		if ($this->validateId($value)) {
			$this->numero = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNumero()
	{
		return $this->numero;
	}
	
	public function setCategoria($value)
	{
		if ($this->validateId($value)) {
			$this->categoria = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCategoria()
	{
		return $this->categoria;
	}
	
	public function setPlatillo($value)
	{
		if ($this->validateId($value)) {
			$this->platillo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getPlatillo()
	{
		return $this->platillo;
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
	
	public function setIdPrepedido($value)
	{
		if ($this->validateId($value)) {
			$this->IdPrepedido = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getIdPrepedido()
	{
		return $this->IdPrepedido;
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

    public function readMesas(){
        $sql = 'SELECT id_mesa, numero_mesa FROM mesas WHERE estado_mesa = 1';
        $params = array(null);
        return conexion::getRows($sql, $params);
	}
	
	public function readCategorias(){
        $sql = 'SELECT id_categoria, nombre_categoria FROM categorias where estado = 1';
        $params = array(null);
        return conexion::getRows($sql, $params);
	}
	
	public function readProductos(){
	$sql = 'SELECT id_platillo, nombre_platillo, imagen, precio FROM platillos where estado = 1 AND id_categoria = ?';
    $params = array($this->categoria);
    return conexion::getRows($sql, $params);
	}
	
	public function readPrepedido(){
		$sql = 'SELECT id_prepedido, id_mesa, id_platillo, cantidad, nombre_platillo, precio, imagen FROM pre_pedido INNER JOIN platillos USING (id_platillo) where id_mesa = ?';
		$params = array($this->idMesa);
		return conexion::getRows($sql, $params);
	}

	public function readPrepedido2(){
		
		$sql = 'SELECT id_prepedido, id_mesa, id_platillo, cantidad FROM pre_pedido where id_mesa = ?';
		$params = array($this->idMesa);
		$data = Conexion::getRows($sql, $params);
		if($data){
			$this->platillo = $data[0]['id_platillo'];
			$this->cantidad = $data[0]['cantidad'];
			$this->idPrepedido = $data[0]['id_prepedido'];
			return $data;
		} else {
			return false;
		}
	}

	public function createPrepedido()
	{
		$sql = 'INSERT INTO pre_pedido (id_mesa, id_platillo, cantidad) VALUES (?, ?, ?);';
		$params = array($this->idMesa, $this->platillo, $this->cantidad);
		return conexion::executeRow($sql, $params);
	}
	
	public function deletePrepedido()
	{
		$sql = 'DELETE FROM pre_pedido WHERE id_mesa = ?';
		$params = array($this->idMesa);
		return conexion::executeRow($sql, $params);
	}

	public function getPre(){
		$sql = 'SELECT id_prepedido FROM pre_pedido WHERE id_prepedido = ?';
		$params = array($this->IdPrepedido);
		return Conexion::getRow($sql, $params);
	}

	public function updateCantidad()
	{
		$sql = 'UPDATE pre_pedido SET cantidad = ? WHERE id_prepedido = ?';
		$params = array($this->cantidad, $this->IdPrepedido);
		return conexion::executeRow($sql, $params);
	}

	public function createPedido(){
		$sql = 'INSERT INTO pedidos(id_usuario) VALUES (?)';
		$params = array($this->idUsuario);
		return Conexion::executeRow($sql, $params);
	}

	public function readUltimoPedido(){
		$sql = 'SELECT MAX(id_pedido) AS UltimoPedido FROM pedidos';
		$params = array(null);
		$data = Conexion::getRow($sql, $params);
		if($data){
			$this->idPedido = $data['UltimoPedido'];
			return $data;
		} else {
			return false;
		}
	}

	public function readDetalleFactura()
	{
		$sql = 'SELECT id_detalle, id_pedido, id_platillo, nombre_platillo, cantidad, precio FROM detalle_pedido INNER JOIN platillos USING(id_platillo) INNER JOIN pedidos USING(id_pedido) WHERE pedidos.id_pedido = ?';
		$params = array($this->idPedido);
		return Conexion::getRows($sql, $params);
	}
	
	public function createDetallePedido(){
		$sql = 'INSERT INTO detalle_pedido(id_pedido, id_platillo, cantidad) VALUES (?, ?, ?)';
		$params = array($this->idPedido, $this->platillo, $this->cantidad);
		return Conexion::executeRow($sql, $params);
	}


	
}
?>

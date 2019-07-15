<?php
class Mesas extends Validator
{
	// Declaración de propiedades
	private $idMesa = null;
	private $numero = null;
	private $categoria = null;

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

    public function readMesas(){
        $sql = 'SELECT * FROM mesas';
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
    


	
}
?>

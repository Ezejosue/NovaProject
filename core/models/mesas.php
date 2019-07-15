<?php
class Mesas extends Validator
{
	// Declaración de propiedades
	private $idMesa = null;
	private $numero = null;

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

    public function readMesas(){
        $sql = 'SELECT * FROM mesas';
        $params = array(null);
        return conexion::getRows($sql, $params);
    }
    


	
}
?>

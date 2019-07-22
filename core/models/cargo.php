<?php

class Cargo extends Validator
{
    //Declaración de propiedades
    private $id = null;
    private $nombre_cargo = null;
    
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
    
    public function setCargo($value)
	{
		if($this->validateAlphanumeric($value, 1, 50)) {
			$this->nombre_cargo = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getCargo()
	{
		return $this->nombre_cargo;
    }
    
	// Métodos para el manejo del SCRUD
    public function readCargo()
    {
        $sql = 'SELECT id_Cargo, nombre_Cargo FROM cargo';
        $params = array(null);
        return conexion::getRows($sql, $params);
    }

    public function createCargo()
    {
        $sql = 'INSERT INTO cargo(nombre_Cargo) VALUES (?)';
        $params = array($this->nombre_cargo);
		return conexion::executeRow($sql, $params);
    }

    public function searchCargo()
    {
        $sql = 'SELECT id_Cargo, nombre_cargo FROM cargo WHERE id_Cargo = ?';
        $params = array($this->id);
        return Conexion::getRow($sql, $params);
    }

    public function updateCargo()
	{
		$sql = 'UPDATE cargo SET nombre_cargo = ? WHERE id_Cargo = ?';
		$params = array($this->nombre_cargo, $this->id);
		return conexion::executeRow($sql, $params);
	}

    public function deleteCargo()
    {
        $sql = 'DELETE FROM cargo WHERE id_Cargo = ?';
        $params = array($this->id);
        return Conexion::executeRow($sql, $params);
    }
}

?>
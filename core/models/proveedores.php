<?php

class Proveedores extends Validator
{
    //Declaración de propiedades
    private $id = null;
    private $nom_proveedor = null;
    private $contacto = null;
    private $telefono = null;
    private $estado = null;
    
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
    
    public function setNomProveedor($value)
	{
		if($this->validateAlphabetic($value, 1, 50)) {
			$this->nom_proveedor = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNomProveedor()
	{
		return $this->nom_proveedor;
    }

    public function setContacto($value)
	{
		if($this->validateAlphabetic($value, 1, 100)) {
			$this->contacto = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getContacto()
	{
		return $this->contacto;
    }

    public function setTelefono($value)
	{
		if($this->validateAlphanumeric($value, 1, 8)) {
			$this->telefono = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getTelefono()
	{
		return $this->telefono;
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
    
	// Métodos para el manejo del SCRUD
    public function readProveedores()
    {
        $sql = 'SELECT id_proveedor, nom_proveedor, contacto, telefono, estado FROM proveedores';
        $params = array(null);
        return conexion::getRows($sql, $params);
    }

    public function createProveedor()
    {
        $sql = 'INSERT INTO Proveedores(nom_proveedor, contacto, telefono, estado) VALUES (?, ?, ?, ?)';
        $params = array($this->nom_proveedor, $this->contacto, $this->telefono, $this->estado);
		return conexion::executeRow($sql, $params);
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
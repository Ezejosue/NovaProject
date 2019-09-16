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
        $sql = 'INSERT INTO proveedores(nom_proveedor, contacto, telefono, estado) VALUES (?, ?, ?, ?)';
        $params = array($this->nom_proveedor, $this->contacto, $this->telefono, $this->estado);
		return conexion::executeRow($sql, $params);
    }

    public function getProveedor()
    {
        $sql = 'SELECT id_proveedor, nom_proveedor, contacto, telefono, estado FROM proveedores WHERE id_proveedor = ? LIMIT 1';
        $params = array($this->id);
		return conexion::getRow($sql, $params);
    }

    public function updateProveedor()
	{
		$sql = 'UPDATE proveedores SET nom_proveedor = ?, contacto = ?, telefono = ?, estado = ? WHERE id_proveedor = ?';
		$params = array($this->nom_proveedor, $this->contacto, $this->telefono, $this->estado, $this->id);
		return conexion::executeRow($sql, $params);
	}

    public function deleteProveedor()
    {
        $sql = 'DELETE FROM proveedores WHERE id_proveedor = ?';
        $params = array($this->id);
        return Conexion::executeRow($sql, $params);
    }
}

?>
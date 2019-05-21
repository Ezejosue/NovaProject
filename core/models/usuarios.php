<?php
class Usuarios extends Validator
{
	//Declaración de propiedades
	private $id = null;
	private $nombres = null;
	private $apellidos = null;
	private $alias = null;
	private $foto = null;
	private $fecha_creacion = null;
	private $estado = null;
	private $tipo_usuario = null;
	private $clave = null;
	private $ruta = '../resources/img/usuarios/';

	//Métodos para sobrecarga de propiedades
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

	public function setNombres($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->nombres = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getNombres()
	{
		return $this->nombres;
	}

	public function setApellidos($value)
	{
		if ($this->validateAlphabetic($value, 1, 50)) {
			$this->apellidos = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getApellidos()
	{
		return $this->apellidos;
	}

	public function setAlias($value)
	{
		if ($this->validateAlphanumeric($value, 1, 50)) {
			$this->alias = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getAlias()
	{
		return $this->alias;
	}

	public function setFoto($file, $name)
	{
		if ($this->validateImageFile($file, $this->ruta, $name, 500, 500)) {
			$this->foto = $this->getImageName();
			return true;
		} else {
			return false;
		}
	}

	public function getFoto()
	{
		return $this->foto;
	}

	public function setFecha_creacion($file, $name)
	{
		$this->fecha_creacion = $value;
	}

	public function getFecha_creacion()
	{
		return $this->fecha_creacion;
	}

	public function setEstado($value)
	{
		if ($value == '1' || $value == '0') {
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

	public function setTipo_usuario($value)
	{
		if ($this->validateId($value)) {
			$this->tipo_usuario = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getTipo_usuario()
	{
		return $this->tipo_usuario;
	}

	public function setClave($value)
	{
		if ($this->validatePassword($value)) {
			$this->clave = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getClave()
	{
		return $this->clave;
	}

	public function getRuta()
	{
		return $this->ruta;
	}

	//Métodos para manejar la sesión del usuario
	public function checkAlias()
	{
		$sql = 'SELECT id_usuario FROM usuarios WHERE alias = ?';
		$params = array($this->alias);
		$data = Conexion::getRow($sql, $params);
		if ($data) {
			$this->id = $data['id_usuario'];
			return true;
		} else {
			return false;
		}
	}

	public function checkPassword()
	{
		$sql = 'SELECT clave_usuario FROM usuarios WHERE id_usuario = ?';
		$params = array($this->id);
		$data = Conexion::getRow($sql, $params);
		if (password_verify($this->clave, $data['clave_usuario'])) {
			return true;
		} else {
			return false;
		}
	}

	public function changePassword()
	{
		$hash = password_hash($this->clave, PASSWORD_DEFAULT);
		$sql = 'UPDATE usuarios SET clave = ? WHERE id_usuario = ?';
		$params = array($hash, $this->id);
		return Conexion::executeRow($sql, $params);
	}

	//Metodos para manejar el CRUD
	public function readUsuarios()
	{
		$sql = 'SELECT id_usuario, foto_usuario, nombre_usuario, apellido_usuario, alias, estado_usuario  FROM usuarios ORDER BY Apellido_usuario';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function readTipoUsuario()
	{
		$sql = 'SELECT id_Tipousuario, tipo, descripcion FROM tipousuario';
		$params = array(null);
		return Conexion::getRows($sql, $params);
	}

	public function searchUsuarios($value)
	{
		$sql = 'SELECT id_usuario, Nombre, Apellido, Nombre_Usuario, Correo FROM usuarios WHERE apellidos_usuario LIKE ? OR nombres_usuario LIKE ? ORDER BY apellidos_usuario';
		$params = array("%$value%", "%$value%");
		return Conexion::getRows($sql, $params);
	}

	public function createUsuario()
	{
		$hash = password_hash($this->clave, PASSWORD_DEFAULT);
		$sql = 'INSERT INTO usuarios(nombre_usuario, apellido_usuario, alias, foto_usuario, estado_usuario, id_Tipousuario, clave_usuario) VALUES(?, ?, ?, ?, ?, ?, ?)';
		$params = array($this->nombres, $this->apellidos, $this->alias, $this->foto, $this->estado, $this->tipo_usuario, $hash);
		return Conexion::executeRow($sql, $params);
	}

	public function getUsuario()
	{
		$sql = 'SELECT id_usuario, Nombre, Apellido, Nombre_Usuario, Correo FROM usuarios WHERE id_usuario = ?';
		$params = array($this->id);
		return Conexion::getRow($sql, $params);
	}

	public function updateUsuario()
	{
		$sql = 'UPDATE usuarios SET Nombre = ?, Apellido = ?, Nombre_Usuario = ?, Correo = ? WHERE id_usuario = ?';
		$params = array($this->nombres, $this->apellidos, $this->nombre_usuario, $this->correo, $this->id);
		return Conexion::executeRow($sql, $params);
	}

	public function deleteUsuario()
	{
		$sql = 'DELETE FROM usuarios WHERE id_usuario = ?';
		$params = array($this->id);
		return Conexion::executeRow($sql, $params);
	}
}
?>

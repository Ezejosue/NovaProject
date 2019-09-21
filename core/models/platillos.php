<?php
class Platillos extends Validator
{
	// Declaración de propiedades segun los campos necesarios para el crud
	private $id = null;
	private $nombre = null;
	private $imagen = null;
	private $precio = null;
	private $id_categoria = null;
	private $id_receta = null;
	private $estado = null;
	private $ruta = '../../resources/img/platillos/';

	// Métodos para sobrecarga de propiedades de el metodo platillos
	// Aqui se declara la funcion para que puede detectar el id con el cual vamos a trabajar
	public function setId($value)
	{
		if ($this->validateId($value)) {
			$this->id = $value;
			return true;
		} else {
			return false;
		}
	}
  	//aqui obtiene el id atraves de la funcion get
	public function getId()
	{
		return $this->id;
	}
	//se declara la funcion para el nombre 
	public function setNombre($value)
	{
		if($this->validateAlphanumeric($value, 1, 50)) {
			$this->nombre = $value;
			return true;
		} else {
			return false;
		}
	}
     //aqui se obtiene el nombre atraves de la funcion ger
	public function getNombre()
	{
		return $this->nombre;
	}

	public function setImagen($file, $name)
	{//aqui se declara la funcion set para la imagen
		if ($this->validateImageFile($file, $this->ruta, $name, 500, 500)) {
			$this->imagen = $this->getImageName();
			return true;
		} else {
			return false;
		}
	}

	//aqui es donde se declara la funcion para el estado
	public function setEstado($value)
	{
		if ($value == 0 || $value == 1) {
			$this->estado = $value;
			return true;
		} else {
			return false;
		}
	}
     //aqui es donde capta el estado 
	public function getEstado()
	{
		return $this->estado;
	}


	public function getImagen()
	{
		return $this->imagen;
	}
 //se declara la funcion get para obtener la ruta de la imagen
	public function getRuta()
	{
		return $this->ruta;
	}
    //se declara la funcion para el precio
	public function setPrecio($value)
	{
		if ($value) {//aqui es donde se hace la validacion del precio a ingresar
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
   //se obtiene el metodo get para el precio 
	public function getPrecio()
	{
		return $this->precio;
	}
	//se la funcion para la llave de cagoria mandandola a llamar por su id
	public function setCategoria($value)
	{
		if($this->validateId($value)){
			$this->id_categoria=$value;
			return true;	
		}else{
			return false;
		}
	}
	public function getCategoria()
	{
		//aqui es donde hace el get de categorias y se otiene el id
		return $this->id_categoria;
	}

	public function setReceta($value)
	{//aqui es donde se declara la funcion para la receta
		if($this->validateId($value)){
			$this->id_receta= $value;
			return true;
		}else{
			return false;
		}

	}//se hace la funcion para el get receta y trae su id
	public function getReceta()
	{
		return $this->id_receta;
	}


	// Metodos para el manejo del SCRUD
	//Se declara la funcion para poder crear platillos en el crud
	public function createPlatillo()
    {
        $sql = 'INSERT INTO platillos(nombre_platillo, precio, id_receta, id_categoria, estado, imagen) VALUES (?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre, $this->precio, $this->id_receta, $this->id_categoria, $this->estado, $this->imagen);
        return Conexion::executeRow($sql, $params);
    }
   //se declara la funcion para el getplatillo y que devuelva los datos traendolos por su id
    public function getPlatillo()
    {
        $sql = 'SELECT id_platillo, nombre_platillo, imagen, precio, estado, id_receta, id_categoria FROM platillos WHERE id_platillo = ? LIMIT 1';
        $params = array($this ->id);
        return Conexion::getRow($sql, $params);
    }
    public function readPlatillo()
    {//aqui es donde se hace la funcion para leer lo que hay en platillo
        $sql = 'SELECT id_platillo, nombre_platillo, precio, receta.nombre_receta, categorias.nombre_categoria, imagen, platillos.estado From platillos INNER JOIN categorias USING (id_categoria) INNER JOIN receta USING (id_receta) ORDER BY nombre_platillo';
        $params = array(null);
        return Conexion::getRows($sql, $params);
    }


    public function readCategoria()
    {//se hace el readCategoria para traer el id desde la tabla categoria
        $sql = 'SELECT id_categoria, nombre_categoria FROM categorias';
        $params = array(null);
        return Conexion::getRows($sql, $params);
	}
	
	public function readReceta()
    { //se hace el readReceta para que pueda traer el id desde otra tabla
        $sql = 'SELECT id_receta, nombre_receta FROM receta';
        $params = array(null);
        return Conexion::getRows($sql, $params);
    }

    public function updatePlatillo()
    {  //se hace la funcion para poder actualizar el platillo 
        $sql = 'UPDATE platillos SET nombre_platillo = ?, precio = ?, id_categoria = ?, id_receta = ?, estado = ?, imagen =? WHERE id_platillo = ?';
        $params = array($this->nombre, $this->precio, $this->id_categoria, $this->id_receta, $this->estado,$this->estado,  $this->id);
        return Conexion::executeRow($sql, $params);
    }

    public function deletePlatillo()
    {//se hace la funcion para poder eliminar el platillo atraves de su id
        $sql = 'DELETE FROM platillos WHERE id_platillo = ?';
        $params = array($this->id);
        return Conexion::executeRow($sql, $params);
	}

	public function grafica_ventas_platillo()
	{//funcion para mostrar las mayores ventas por platillo
		$sql = 'SELECT SUM(cantidad) as cantidad, nombre_platillo, precio*SUM(cantidad) as subtotal
		from platillos INNER JOIN detalle_pedido USING (id_platillo) 
		where platillos.estado = 1 GROUP BY nombre_platillo ORDER BY subtotal DESC LIMIT 5';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function grafica_ventas_platillo_menor()
	{//funcion para mostrar las menores ventas por platillo
		$sql = 'SELECT SUM(cantidad) as cantidad, nombre_platillo, precio*SUM(cantidad) as subtotal
		from platillos INNER JOIN detalle_pedido USING (id_platillo) 
		where platillos.estado = 1 GROUP BY nombre_platillo ORDER BY subtotal ASC LIMIT 5';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}
	
	public function grafica_platillos_caros()
	{//funcion para traer la consulta de platillos más caros
		$sql = 'SELECT nombre_platillo, precio FROM platillos ORDER BY precio DESC LIMIT 5';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function grafica_platillos_baratos()
	{//funcion para traer la consulta de platillos más baratos
		$sql = 'SELECT nombre_platillo, precio FROM platillos ORDER BY precio ASC LIMIT 5';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function platillos_categoria()
	{//funcion para traer la consulta de platillos más baratos
		$sql = 'SELECT nombre_categoria, id_platillo, nombre_platillo FROM platillos INNER JOIN categorias USING(id_categoria) ORDER BY nombre_categoria LIMIT 15';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}


	public function platillos_vendidos()
	{//funcion para traer la consulta de platillos más baratos
		$sql = 'SELECT SUM(cantidad) as Vendidos, nombre_platillo, precio*SUM(cantidad) as Ganancia 
		from detalle_pedido 
		INNER JOIN platillos USING(id_platillo) GROUP by nombre_platillo LIMIT 10';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

	public function platillos_vendidos_categoria()
	{//funcion para traer la consulta de platillos más baratos
		$sql = 'SELECT SUM(cantidad) as cant, nombre_platillo, nombre_categoria, precio*SUM(cantidad) as Ganancia 
		from detalle_pedido 
		INNER JOIN platillos USING(id_platillo) 
		INNER JOIN categorias USING(id_categoria) GROUP BY nombre_platillo';
		$params = array(null);
		return conexion::getRows($sql, $params);
	}

}
?>
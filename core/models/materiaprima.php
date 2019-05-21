<?php
class MateriaPrima extends Validator
{
 //Empezamos declarando en materia prima
 private $id = null;
 private $nombre= null;
 private $imagen= null;
 private $descripcion=  null;
 private $categoria= null;
 private $receta=null;
 private $ruta = '../../resources/img/categorias/';

 //Metodos que ayudan a la sobrecaega de propiedades

 public function setId($value)
 {
     if ($this->validateId($value)){
         $this->id =$value;
         return true;
     } else{
         return false;
     }
 }

 public function getId()
 {
     return $this->id;
 }

 public function getId()
 {
     return $this->id;
 }

 public function setNombre($value)
 {
     if($this->validateAlphanumeric($value, 1, 50)){
         $this->nombre = $value;
         return true;
     }else{
         return false;
     }
 }
 public function getNombre()
 {
     return $this->nombre;
 }
public function setImagen()
{
    return $this->imagen;
}

public function setDescripcion($value)
{
    if($this->validateAlphanumeric($value,1,200)){
       $this->descripcion = $value;
       return true;
    }else{
        return false;
    }
}
public function getDescripion()
{
    return $this->descripcion;
}
public function setCategoria($value)
{
    if($this->validateId($value)){
       $this->categoria = $value;
       return true;
    }else{
        return false;
    }
}
public function getCategoria($value)
{
    return $this->categoria;
}

public function getRuta()
{
    return $this->ruta;
}
//Metodos para el manejo del CRUD DE MATERIA PRIMA este metodo lleva dos llaves primaria (medida, categoria)

public function readMateriaPrimaCategoriaMedida()
{
    $sql ='SELECT ' nombre_categoria, 
}
public function readMateriaPrima()
{
    $sql='SELECT idMateria, nombre_materia FROM materiasprimas INNER JOIN categorias USING(id_categoria)' 
}
public function readCategorias()
{
    $sql = 'SELECT idMateria, nombre_materia, descripcion, id_categoria, id_receta FROM materiasprimas';
    $params =array(null);
    return Database::getRows($sql, $params);
}
public function createMateriaPrima()
{
    $sql ='INSERT INTO materiasprimas(nombre_materia,foto,descripcion, id_categoria)VALUE(?,?,?,?)';
    $params =array($this->nombre, $this->descripion, $this->foto, $this->categorias);
    return Databases::executeRow($sql, $params);
}
public function getMateriaPrima()
{

}
public function updateMateriaPrima()
{
    $sql ='UPDATE materiasprimas SET nombre_materia =?,foto = ?,  descripcion = ?, id_categoria= ? WHERE idMateria = ? ';
    $params =array($this->nombre, $this->foto, $this->descripcion, $this->categoria, $this->id);
    return Databases::execute($sql, $params);
}
public function deleteMateriaPrima()
{
    $sql = 'DELETE FROM materiasprimas WHERE idMateria = ?';
    $params = array($this->id);
    return Databases::executesRow($sql, $params);
}
    
}
?>
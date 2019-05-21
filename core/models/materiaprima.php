<?php
class MateriaPrima extends Validator
{
 //Empezamos declarando en materia prima
 private $id = null;
 private $nombre= null;
 private $imagen= null;
 private $descripcion=  null;
 private $categoria= null;
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
public function getRuta()
{
    return $this->ruta;
}
public function setDescripcion($value)
{
    if($value){
        if ($this->validateAlphanumeric($value,1,200)){
            $this->descripcion = $value;
            return true;
        }else{
            return false;
        }
    }else{
        $this->descripcion = null;
        return true;
    }
}
/////
}
}
<?php
/*
    Clase para validar todos los campos de entrada.
*/
class Validator
{
	private $imageError = null;
	private $imageName = null;

	//función que obtiene el nombre de la imagen
	public function getImageName()
	{
		return $this->imageName;
	}
	//función para obtener el error al momento de subir una imagen incorrecta
	public function getImageError()
	{
		switch ($this->imageError) {
			case 1:
				$error = 'El tipo de la imagen debe ser gif, jpg o png';
				break;
			case 2:
				$error = 'La dimensión de la imagen es incorrecta';
				break;
			case 3:
				$error = 'El tamaño de la imagen debe ser menor a 2MB';
				break;
			case 4:
				$error = 'El archivo de la imagen no existe';
				break;
			default:
				$error = 'Ocurrió un problema con la imagen';
		}
		//la función retorna el error con su respectivo mensaje
		return $error;
	}

	public function validateForm($fields)
	{
		foreach ($fields as $index => $value) {
			$value = trim($value);
			$fields[$index] = $value;
		}
		return $fields;
	}

	//validación para que el id sea mayor a 1.
	public function validateId($value)
	{
		if (filter_var($value, FILTER_VALIDATE_INT, array('min_range' => 1))) {
			return true;
		} else {
			return false;
		}
	}

	//validación para que el logueo sea 0 o 1.
	public function validateLogueo($value)
	{
		if (preg_match('/^[0-1]{1}$/', $value)) {
			return true;
		} else {
			return false;
		}
	}

	public function validateImageFile($file, $path, $name, $maxWidth, $maxHeigth)
	{
		if ($file) {
			//Se comprueba si el archivo tiene un mañana menor o igual a 2MB
	     	if ($file['size'] <= 2097152) {
		    	list($width, $height, $type) = getimagesize($file['tmp_name']);
				if ($width <= $maxWidth && $height <= $maxHeigth) {
					//Se verifica si la imagen cumple con alguno de los formatos: 1 - GIF, 2 - JPG y 3 - PNG
					if ($type == 1 || $type == 2 || $type == 3) {
						//Se comprueba si el archivo tiene un nombre, sino se le asigna uno
						if ($name) {
							if (file_exists($path.$name)) {
								$this->imageName = $name;
								return true;
							} else {
								$this->imageError = 4;
								return false;
							}
						} else {
							$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
							$this->imageName = uniqid().'.'.$extension;
							return true;
						}
					} else {
						$this->imageError = 1;
						return false;
					}
				} else {
					$this->imageError = 2;
					return false;
				}
	     	} else {
				$this->imageError = 3;
				return false;
	     	}
		} else {
			if (file_exists($path.$name)) {
				$this->imageName = $name;
				return true;
			} else {
				$this->imageError = 4;
				return false;
			}
		}
	}

	//se validan direcciones de correo electrónico con la sintaxis de RFC 822, con la excepción de no admitir el plegamiento de comentarios y espacios en blanco.
	public function validateEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}

	//validación que permite ingresar solamente letras.
	public function validateAlphabetic($value, $minimum, $maximum)
	{
		if (preg_match('/^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{'.$minimum.','.$maximum.'}$/', $value)) {
			return true;
		} else {
			return false;
		}
	}

	//validación que permite ingresar solamente números.
	public function validateCorrelativo($value)
	{
		if (preg_match('/^[0-9]{8}$/', $value)) {
			return true;
		} else {
			return false;
		}
	}

	//validación que permite ingresar solamente letras y números.
	public function validateAlphanumeric($value, $minimum, $maximum)
	{
		if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\.\,\;]{'.$minimum.','.$maximum.'}$/', $value)) {
			return true;
		} else {
			return false;
		}
	}

	//validación para el DUI que permite ingresar números del 0 al 9 sin espacios en blanco y permitiendo el guión.
	public function validateDui($value)
	{
		if (preg_match('/^[0-9]{8}+(-)+[0-9]$/', $value)) {
			return true;
		} else {
			return false;
		}
	}

	//validación para el teléfono que permite números del 0 al 9, ingresando 4 números con un guión y los otro 4 números restantes.
	public function validateTelefono($value)
	{
		if (preg_match('/^[0-9]{4}+(-)+[0-9]{4}$/', $value)) {
			return true;
		} else {
			return false;
		}
	}

	//validación para el género que permite solo las letras M y F (M: masculino, F: femenino)
	public function validateGenero($value)
	{
		if (preg_match('/^[MF]$/', $value)) {
			return true;
		} else {
			return false;
		}
	}

	//validación para los datos de tipo money que permite números del 0 al 9 y dos decimales
	public function validateMoney($value)
	{
		if (preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $value)) {
			return true;
		} else {
			return false;
		}
	}

	public function validateDate($value)
	{
		if (!preg_match("/^(0?[1-9]|[12][0-9]|3[01])\/\.- \/\.- \d{2}$/", $value)) {
			return true;
		} else {
			return false;
		}
	}

	//validación para la fecha que no permite ingresar fechas mayores al año 1952 y 2001, para mayores de 18 años y personas que no tengan 100 años
	public function validateFecha($value)
	{
		//validación para mayores de 18 años
		$fecha = strtotime(date("01-01-2002"));
		//validación para que la fecha mínima sea 1952 y que la edad no pueda ser más de 100 años
		$fmax = strtotime(date("01-01-1952"));
		$value = strtotime($value);

		if ($fecha > $value && $value > $fmax) {
			return true;
		} else {
			return false;
		}
	}

	
	public function validatePassword($value)
	{
		$error;
		if (strlen($value) > 7 && strlen($value) < 25) {
			if (preg_match('#[0-9]+#', $value)) {
				if (preg_match('#[a-z]+#', $value)) {
					if (preg_match('#[A-Z]+#', $value)) {
						if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&]{8,12}$/", $value)) {
							return array(true, '');
						}
						$error = 'Contraseña: debe introducir al menos un signo y una longitud entre 8 a 25 caracteres';
						return array(false, $error);
					}
					$error = 'Contraseña: debe introducir al menos una letra mayúscula';
					return array(false, $error);
				}
				$error = 'Contraseña: debe introducir al menos una letra minúscula';
				return array(false, $error);
			}
			$error = 'Contraseña: debe introducir al menos un numero entre 0-9';
			return array(false, $error);
		}
		$error = 'Contraseña: su contraseña no cumple con el formato de una mayúscula, una minúscula, un numero y un caracter especial';
		return array(false, $error);
	}

	//validación para las imágenes en donde no aceptan valores nulos.
	public function saveFile($file, $path, $name)
    {
		if (file_exists($path)) {
			if (move_uploaded_file($file['tmp_name'], $path.$name)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
  	}

	//validación para eliminar una imagen en donde la imagen debe de existir para ser eliminada  
	public function deleteFile($path, $name)
    {
		if (file_exists($path)) {
			if (unlink($path.$name)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
?>

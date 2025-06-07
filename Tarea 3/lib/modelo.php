<?php

/*
Identificación
Nombre
Apellido
Fecha de nacimiento
Foto del personaje
Profesión o Rol en el Mundo Barbie (Se debe elegir de una lista de profesiones)
Nivel de experiencia (Principiante, Intermedio, Avanzado)
*/

/*
Nombre de la profesión (Ejemplo: Veterinaria, Piloto, Diseñadora de Moda, Científica, Chef, etc.)
Categoría (Ciencia, Arte, Deporte, Entretenimiento, etc.)
Salario mensual estimado en dólares ($USD)
*/

class Personaje {
    public $idx = '';
    public $identificacion = '';
    public $nombre = '';
    public $apellido = '';
    public $fecha_nacimiento = '';
    public $foto = '';
    public $profesion = '';
    public $nivel_experiencia = 0;

    public function edad() {
        if (empty($this->fecha_nacimiento)) {
            return 0;
        }
        $fecha_nacimiento = strtotime($this->fecha_nacimiento);
        $fecha_actuarl = time();
        $edad = date('Y', $fecha_actuarl) - date('Y', $fecha_nacimiento);
        if (date('md', $fecha_actuarl) < date('md', $fecha_nacimiento)) {
            $edad--;
        }
        return $edad;
    }

   public function __construct($data = []){

    if(is_object($data)){
        $data = (array)$data;   
    }

    foreach ($data as $key => $value) {
        if (property_exists($this, $key)) {
            $this->$key = $value;
        }
    }
   }
}

class Profesion {
    public $idx = '';
    public $codigo = '';
    public $nombre = '';
    public $categoria = '';
    public $salario = 0;

    public function __construct($data = []){

        if(is_object($data)){
            $data = (array)$data;   
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function __toString() {
        return "{$this->nombre} - Salario: {$this->salario}";
    }

}

?>
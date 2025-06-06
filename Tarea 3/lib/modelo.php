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
    public $id;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $foto;
    public $profesion;
    public $nivel_experiencia;

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
    public $codigo;
    public $nombre;
    public $categoria;
    public $salario;

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

?>
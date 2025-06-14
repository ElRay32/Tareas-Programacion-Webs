<?php

/*
Nombre
Apellido
Cédula
Edad
Motivo de la visita (ejemplo: limpieza, caries, dolor, chequeo)
Fecha y hora (esto debe llenarse automáticamente desde el servidor)
*/

class Visita{
    public $idx = '';
    public $cedula ='';
    public $nombre = '';
    public $apellido ='';
    public $edad = 0;
    public $motivo ='';
    public $fecha_visita = '';

    public function __construct($data = [])
    {
        if(is_object($data)){
            $data = (array)$data;
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }
}

class motivos{

    public static function tipos_de_motivos() : array {
        return array(
            'limpieza' => 'Limpieza',
            'caries' => 'Caries',
            'dolor' => 'Dolor',
            'chequeo' => 'Chequeo'
        );
    }
}

?>
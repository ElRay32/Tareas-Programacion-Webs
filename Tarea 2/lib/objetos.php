<?php

/*

Obras

Campo	Descripción
Código	Código único (alfanumérico)
foto_url	URL o ruta local de una imagen representativa
tipo	Tipo de obra: Serie, Película u Otro
nombre	Nombre del contenido
descripción	Descripción breve
país	País de origen
autor	Autor o creador principal


Registro de Personajes

Campo	Descripción
cédula	Identificador único del personaje
foto_url	Imagen del personaje
nombre	Nombre del personaje
apellido	Apellido del personaje
fecha_nacimiento	Fecha de nacimiento
sexo	Masculino o Femenino
habilidades	Lista de habilidades separadas por comas
comida_favorita	Texto libre
*/

class obra{
    public $codigo;
    public $foto_url;
    public $tipo;
    public $genero;
    public $nombre;
    public $descripcion;
    public $pais;
    public $fecha_estreno;
    public $autor;

    public $personajes = array();
}

class personaje{
    public $cedula;
    public $foto_url;
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $sexo;
    public $actor;
    public $habilidades;
}

class datos{
    public static function tipos_de_obras(): array
    {
        return array( 
            'Serie' => 'Serie',
            'Película' => 'Película',
            'Otro' => 'Otro'
        );
    }
}

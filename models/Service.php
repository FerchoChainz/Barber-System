<?php

namespace Model;

class Service extends ActiveRecord{
    // DB
    protected static $table = 'servicios';
    protected static $DBcols = ['id', 'nombre','precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}
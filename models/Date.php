<?php  

namespace Model;

class Date extends ActiveRecord {

    // BD
    protected static $table = 'citas';
    protected static $DBcols = ['id','fecha','hora','usuarioId'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? null;
    }

}
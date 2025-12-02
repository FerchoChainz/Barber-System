<?php  

namespace Model;

class DateServices extends ActiveRecord{
    // DB
    protected static $table = 'citasServicios';
    protected static $DBcols = ['id','servicioId','citaId'];

    public $id;
    public $servicioId;
    public $citaId;

    public function __construct($args =[])
    {
        $this->id = $args['id'] ?? null;
        $this->servicioId = $args['servicioId'] ?? '';
        $this->citaId = $args['citaId'] ?? '';
    }
}
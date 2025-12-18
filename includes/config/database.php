<?php 

$db = mysqli_connect($_ENV['DB_HOST'], 
$_ENV['DB_USER'],
$_ENV['DB_PSWD'],
$_ENV['DB_NAME']
);

$db->set_charset('utf8');

if(!$db){
    echo 'Error al intentar la conexion de la base de datos';
    echo 'erno de depuracion: ' . mysqli_connect_errno();
    echo 'error de depuracion: ' . mysqli_connect_error();
}
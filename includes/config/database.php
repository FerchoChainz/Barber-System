<?php 

$db = mysqli_connect('localhost', 'root', '' , '');

if(!$db){
    echo 'Error al intentar la conexion de la base de datos';
    echo 'erno de depuracion: ' . mysqli_connect_errno();
    echo 'error de depuracion: ' . mysqli_connect_error();
}
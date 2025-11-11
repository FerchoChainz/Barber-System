<?php  

function debbuger($var):string{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit;
}

function s($html){
    $s = htmlspecialchars($html);
    return $s;
}
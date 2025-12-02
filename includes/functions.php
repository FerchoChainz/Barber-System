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

// Check if user is auth 
function isAuth(){
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}
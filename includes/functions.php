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

function isLast(string $actual, string $next):bool {
    if($actual !== $next){
        return true;
    }
    
    return false;
}

// Check if user is auth 
function isAuth(){
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function isAdmin(){
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}



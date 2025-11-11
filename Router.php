<?php 

namespace MVC;

class Router{

    public $GETroutes = [];
    public $POSTroutes = [];

    public function get($url,$fn){
        $this->GETroutes[$url] = $fn;
    }
    
    public function post($url, $fn){
        $this->POSTroutes[$url] = $fn;
    }

    public function checkRoutes(){

        session_start();

        $auth = $_SESSION['login'] ?? null;



        // protected routes array
        $protected_routes =  ['/admin', '/property/create','/property/update','/property/delete',
        '/seller/create', '/seller/update', '/seller/delete',
        '/blog/create'
    ];
        
        $actualURL = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];
        

        if($method === 'GET'){
            $fn = $this->GETroutes[$actualURL] ?? null;
        } else {
            $fn = $this->POSTroutes[$actualURL] ?? null;
        }

        // protect routes
        if(in_array($actualURL, $protected_routes) && !$auth){
            header('Location: /');
        }

        if($fn){
            // URL exist and had a function associated
            call_user_func($fn, $this);
        } else{
            echo 'ERROR 404';
        }
    }


    // Show the views 
    public function render($view ,$data = []){

        foreach($data as $key => $value){
            $$key = $value; // Variable of variable
        }
        
        ob_start(); // Saving objects in memory 


        include __DIR__ . "/views/$view.php";
        $content = ob_get_clean(); //cleaning memory 
        include __DIR__ . '/views/layout.php';
    }
}


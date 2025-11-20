<?php

namespace Model;

class User extends ActiveRecord{
    // Data base
    protected static $table = 'usuarios';
    protected static $DBcols = ['id', 'nombre', 'apellido' , 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    // Error logs in login
    public function validateNewAccount(){
        if(!$this->nombre){
            self::$errors['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$errors['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->email){
            self::$errors['error'][] = 'El email es obligatorio';
        }
        if(!$this->telefono){
            self::$errors['error'][] = 'El telefono es obligatorio';
        }

        if(strlen($this->password) < 8){
            self::$errors['error'][] = 'El password debe tener al menos 8 caracteres';
        }
        return self::$errors;
    }

    public function validateLogin(){
        if(!$this->email){
            self::$errors['error'][] = 'El email es obligatorio';
        }

        if(!$this->password){
            self::$errors['error'][] = 'El password es obligatorio';
        }

        return self::$errors;
    }

    public function validateEmail(){
        if(!$this->email){
            self::$errors['error'][] = 'El email es obligatorio';
        }
        
        return self::$errors;
    }

    public function userExist(){
    $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$errors['error'][] = 'El usuario ya esta registrado';
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password,PASSWORD_BCRYPT);
    }


    public function createToken(){
        $this->token = uniqid();
    }


    public function checkPasswordAndVerify(string $password)  { // <- Acepta la contraseña simple
        
        $resultado = password_verify($password, $this->password); 

        if(!$resultado || !$this->confirmado){
            self::$errors['error'][] = 'Password incorrecto o tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }

    public function validateNewPassword(){
        if(!$this->password){
            self::$errors['error'][] = 'El password es obligatorio';
        }

        if(strlen($this->password) < 8) {
            self::$errors['error'][] = 'El password debe tener al menos 8 caracteres';
        }

        return self::$errors;
    }

}
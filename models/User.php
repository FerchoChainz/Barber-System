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
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
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
}
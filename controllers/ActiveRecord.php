<?php 
namespace Model;

class ActiveRecord{


    // DATABASE
    protected static $db;

    //identify columns to the object 
    protected static $DBcols = [];

    protected static $table = '';

    // log errors 
    protected static $errors = [];


    // Define connection to db 
    public static function setDB($database)
    {
        self::$db = $database;
    }

    

    public function saveUpdate()
    {
        if (!is_null($this->id)) {
            // update register if exist 
            $this->update();
        } else {
            // create new register
            $this->saveData();
        }
    }

    public function update()
    {
        $atributes = $this->sanitizeData();

        // this join atributes and values
        $values = [];

        foreach ($atributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = " UPDATE " . static::$table  . " SET ";
        $query .= join(', ', $values);
        // join convert the array values into like a sql query sentence
        // we have the key and value y plain string separated by ','
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $result = self::$db->query($query);

        if ($result) {
            header('Location: /admin?result=2');
        }

        return $result;
    }

    public function saveData()
    {
        // Sanitize data
        $atributes = $this->sanitizeData();

        // Takes an array and make plain text with a separator, in this case ', ' to separate every key
        // $string = join(', ',array_values($atributes));

        // Insert DB
        $query = "INSERT INTO " . static::$table . " (";
        $query .= join(', ', array_keys($atributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributes));
        $query .= "')";

        // debbuger($query);


        $result = self::$db->query($query);
        if ($result) {
            // Redirection
            header('location: /admin?result=1');
        }
        // debbuger($result)
    }

    // delete register
    public function delete()
    {
        $query = " DELETE FROM " . static::$table  . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $result = self::$db->query($query);

        if($result){
            $this->deleteImage();
            header('Location: /admin?result=3');
        }
    }

    // identify and join atributes of DB
    public function atributes()
    {
        $atributes = [];
        foreach (static::$DBcols as $column) {
            if ($column == 'id') continue;
            $atributes[$column] = $this->$column;
        }

        return $atributes;
    }

    // sanitize every atribute
    public function sanitizeData()
    {
        $atributes = $this->atributes();
        $sanitized = [];

        foreach ($atributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }

        return $sanitized;
    }

    // validation 
    public static function getErrors()
    {
        return static::$errors;
    }
    
    public function validate()
    {
        static::$errors =[];
        return static::$errors;
    }


    public function setImage($image){
        
        // delete previous image
        if (!is_null($this->id)) {
            $this->deleteImage();
        }

        // asign the name image to the image atribute
        if ($image) {
            $this->image = $image;
        }
    }

    // delete the file
    public function deleteImage(){
        $exist = file_exists(DIR_IMAGES . $this->image);

            if ($exist) {
                unlink(DIR_IMAGES . $this->image);
            }
    }


    // list all properties
    // in this function had a query, this return an assoc array
    public static function all()
    {
        $query = "SELECT * FROM " . static::$table;

        // take this query in assoc array form to the method consult
        $resutl = self::consultSQL($query);

        return $resutl;
    }


    // Get determinated number of registers  
    public static function get($cant){
        $query = "SELECT * FROM " . static::$table . " LIMIT " . $cant;


        // take this query in assoc array form to the method consult
        $resutl = self::consultSQL($query);

        return $resutl;
    }

    // search a register by ID
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$table  . " WHERE id = $id ";

        // re-use the methods to convert arrays to objects
        $result = self::consultSQL($query);


        return (array_shift($result));
    }


    // HERE CONVERT ARRAYS TO OBJECTS
    public static function consultSQL($query)
    {
        // consult bd
        $result = self::$db->query($query);

        // iterate results
        // this a assoc array, but we created a new method to convert arrays to objects
        $array = [];
        while ($register = $result->fetch_assoc()) {
            $array[] = static::createObjects($register);
        }

        // clear memory 
        $result->free();


        // return results
        // return an array full of all the objects converted
        return $array;
    }


    // In activeRecord you cant use arrays, you must have to use objects
    // this method convert array in objects
    protected static function createObjects($register)
    {
        $object = new static;

        // this code check and map the data from arrays to objects
        foreach ($register as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }


    // sync the object in memory with the changes made by user admin in update
    public function sync($args = [])
    {

        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}


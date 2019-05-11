<?php

class DatabaseObject {

    public $tmp_path;
    public $uploadDir = "images";
    public $imagePlaceholder = "http://placehold.it/400x400";

    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
    );

    public static function find_all()
    {
        return static::find_by_query("SELECT * FROM " . static::$db_table . "");
    }

    public static function find_by_id($id)
    {
        global $database;

        $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id=$id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_by_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instantiation($row);
        }

        return $the_object_array;
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    public function properties()
    {
        $properties = array();

        foreach (static::$db_table_fields as $db_field_values) {
            if (property_exists($this, $db_field_values)) {
                $properties[$db_field_values] = $this->$db_field_values;
            }
        }

        return $properties;
    }

    protected function cleanProperties()
    {
        global $database;
        $cleanProperties = array();

        foreach ($this->properties() as $key => $value) {
            $cleanProperties[$key] = $database->escape_string($value);
        }

        return $cleanProperties;
    }

    public static function VERIFY_USER($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function instantiation($the_record)
    {
        $calling_class = get_called_class();
        $the_object = new $calling_class;

        foreach ($the_record as $the_attribute => $value) {
            if($the_object ->has_the_attribute($the_attribute)) {
                $the_object ->$the_attribute = $value;
            }
        }

        return $the_object ;
    }
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $database;
        $properties = $this->properties();

        $sql = "INSERT INTO " . static::$db_table . "(" .  implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES ('" .  implode("','", array_values($properties))    ."')";

        if ($database->query($sql)) {
            $this->id = $database->insertUserID();
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $database;
        $properties = $this->properties();
        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= " . $database->escape_string($this->id);

        $database->query($sql);

        return ($database->connection->affected_rows == 1) ? true : false;
    }

    public function delete()
    {
        global $database;

        $sql = "DELETE FROM " . static::$db_table . " ";
        $sql .= "WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);
        return ($database->connection->affected_rows == 1) ? true : false;
    }

    public function setFile($file)
    {
        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }
}
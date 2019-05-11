<?php

require_once("init.php");


class User extends DatabaseObject
{
    protected static $db_table = "users";
    protected static $db_table_fields = array(
        'username',
        'password',
        'first_name',
        'last_name',
        'user_image'
    );

    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    public $user_image;

    public $tmp_path;
    public $uploadDir = "images";
    public $imagePlaceholder = "http://placehold.it/400x400";



    public function imagePathAndPlaceholder()
    {
        return empty($this->user_image) ? $this->imagePlaceholder : $this->uploadDir.DS.$this->user_image;
    }

    public static function VERIFY_USER($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


    public function saveUserData()
    {
            if (empty($this->user_image) || empty($this->tmp_path)) {
                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->uploadDir . DS . $this->user_image;

            if (file_exists($target_path)) {
                $this->errors[] = "The file {$this->user_image} already exists.";
                return false;
            }

            if (move_uploaded_file($this->tmp_path, $target_path)) {
                unset($this->tmp_path);
                return true;
            } else {
                $this->errors[] = "The file directory probably doesn't have permission.";
                return false;
            }
    }
}

$user = new User();
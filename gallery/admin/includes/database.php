<?php

require_once("config.php");

class Database {

    private $connection;

    function __construct() {

        $this->open_db_connection();
    }

    public function open_db_connection() {

        $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if(mysqli_connect_errno()) {
            die("db connection failed " . mysqli_error());
        }

    }

    public function query($sql) {

        $result = mysqli_query($this->connection, $sql);

        if(!$results) {
            die("Query failed.");
        }

        return $result;
    }
}

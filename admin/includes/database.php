<?php

require_once 'config.php';

class Database {

    public $connection;

    function __construct() {
        $this->open_db_connection();
    }

    public function open_db_connection() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->connection->connect_errno) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        $result = $this->connection->query($sql)
                /***************************************************/
                /*                N A P O M E N A                  */
                /***************************************************/
                /* mysqli_error VS mysqli_connect_error            */
                /* - mysqli_error() - greska u QUERY-ju            */
                /* - mysqli_connect_error() - greska u KONEKCIJI   */
                /***************************************************/
                or die("<i>Query from query() method failed:</i> <pre>" . $this->connection->error) ."</pre>";
            return $result;
    }

    public function escape_string($string) {
        $trimed_string = trim($string);
        $escaped_string = $this->connection->real_escape_string($trimed_string);
        return $escaped_string;
    }

    public function the_insert_id() {
        return $this->connection->insert_id;
//        return mysqli_insert_id($this->connection); Isto je sto i red iznad
    }

}

$database = new Database();
?>
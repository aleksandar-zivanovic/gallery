<?php

require_once 'config.php';

class Database {

    public function connection() {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->mysqli->connect_errno) {
            return die("Database connection failed: " . $this->connection()->connect_error);
        } else {
            return $this->mysqli;
        }
    }

    public function query($sql) {
        $result = $this->connection()->query($sql)
                or die("Queri Failed :" . $this->connection()->error);
        return $result;
    }

    public function escape_string($string) {
        $escaped_string = $this->connection()->real_escape_string($string);
        return $escaped_string;
    }

    public function the_insert_id() {
        return $this->connection()->insert_id;
    }

}

$database = new Database();


echo "<div>";
echo "<h3 style='color:white;'>Database 2</h3>";
echo "</div>";
?>
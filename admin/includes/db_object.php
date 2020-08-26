<?php

class Db_object {

    protected static $db_table = "users";
    public $errors = [];
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
    );

    // This is passing $_FILES['uploaded_file'] as an argument
    public function set_file($file) {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            return true;
        }
    }

    public static function find_all() {
        return static::find_by_query("SELECT * FROM " . static::$db_table);
    }

    public static function find_by_id($id) {
        $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = {$id}");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    /*     * ********
     * moje metod find_by_query(). za njega ne trebaju metodi koje je Edwin koristio,
     * tako da se dobija cistiji i pregledniji kod. Takodje, ovaj kod je vise OOP od njegovog

      //    public static function find_by_query($sql) {
      //        global $database;
      //        $this_query = $database->query($sql);
      //
      //        $the_object_array = [];
      //
      //        while ($row = $this_query->fetch_array(MYSQLI_ASSOC)) {
      ////      while ($row = $this_query->fetch_assoc()) { // isto kao i prvi red. fetch_array(MYSQLI_ASSOC) = fetch_assoc()
      //            $objekt = new static;
      //
      //            foreach ($row as $key => $value) {
      //                $objekt->$key = $value;
      //            }
      //            $the_object_array[] = $objekt;
      //        }
      //
      //        return $the_object_array;
      //    }
     * ******** */

    public static function find_by_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();

        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }

        return $the_object_array;
    }

    public static function instantiation($the_record) {
        $calling_class = get_called_class();

        /* rucno upisivanje pramatara i vrednosti zamenjeno automatskim (kroz foreachpetlju)
          $the_object = new $calling_class;
          while ($row = mysqli_fetch_array($this_query)) {
          $the_object->id = $the_record['id'];
          $the_object->username = $the_record['username'];
          $the_object->password = $the_record['password'];
          $the_object->first_name = $the_record['first_name'];
          $the_object->last_name = $the_record['last_name'];
          $the_object_array[] = $the_object;
          }
          return $the_object_array;
         */

        $the_object = new $calling_class;  // isto se postize i sa: $the_object = new static;

        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute) {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    public function properties() {
        $properties = [];

        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_properties() {
        global $database;
        $clean_properties = [];
        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        global $database;
        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(", ", array_keys($properties)) . ") ";
        $sql .= "VALUES('" . implode("', '", array_values($properties)) . "')";

//        $sql = "INSERT INTO users(username, password, first_name, last_name) ";
//        $sql .= "VALUES ('{$database->escape_string($this->username)}', ";
//        $sql .= "'{$database->escape_string($this->password)}', ";
//        $sql .= "'{$database->escape_string($this->first_name)}', ";
//        $sql .= "'{$database->escape_string($this->last_name)}')";

        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update() {
        global $database;
        $properties = $this->clean_properties();
        $properties_pairs = [];

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id = " . $database->escape_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1 ? true : false);
    }

    public function delete() {
        global $database;

        $sql = "DELETE FROM " . static::$db_table . " WHERE id = " . $database->escape_string($this->id);

        $database->query($sql);

        return $database->connection->affected_rows == 1 ? TRUE : FALSE;
    }

}

?>
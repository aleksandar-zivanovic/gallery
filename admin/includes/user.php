<?php

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $tmp_path;
    public $upload_directory = "images";
    public $image_placeholder = "https://via.placeholder.com/400x400&text=user_image";

    public function user_image_path() {
        return $this->upload_directory . DS . $this->user_image;
    }

    public function upload_photo() {
        if (!empty($this->errors)) {
            return false;
        }

        if (empty($this->user_image || empty($this->tmp_path))) {
            $this->errors[] = "the file was not available";
            return false;
        }

        $target_path = SITE_ROOT . DS . "admin" . DS . $this->user_image_path();

        if (file_exists($target_path)) {
            $this->errors[] = "The file $this->user_image already exists";
            return false;
        }

        if (move_uploaded_file($this->tmp_path, $target_path)) {
            unset($this->tmp_path);
            return true;
        } else {
            $this->errors[] = "The file directory doesn't have permissions";
            return false;
        }
    }

    public function image_path_and_placeholder() {
        return empty($this->user_image) ? $this->image_placeholder : $this->user_image_path();
    }

    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' AND password = '{$password}'";

        $the_result_array = self::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public function delete_user() {
        global $database;
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . "admin" . DS . $this->user_image_path();
            if (file_exists($target_path)) {
                $sql = "SELECT * FROM photos WHERE filename = '{$this->user_image}'";
                $result = $database->query($sql);
                if (mysqli_num_rows($result) < 1) {
                    unlink($target_path);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function ajax_save_user_image($user_image, $user_id) {
        global $database;

        $this->user_image = $user_image;
        $this->id = $user_id;

        $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' WHERE id = {$this->id}";
        $update_image = $database->query($sql);

        echo $this->image_path_and_placeholder();
    }

}

?>
<?php

class Comment extends Db_object {

    protected static $db_table = "comments";
    protected static $db_table_fields = array('id', 'photo_id', 'author', 'body');
    public $id;
    public $photo_id;
    public $author;
    public $body;

    public static function create_comment($photo_id, $author, $body) {
        if (!empty($photo_id) && !empty($author) && !empty($body)) {

            $comment = new Comment();

            $comment->photo_id = (int) $photo_id;
            $comment->author = $author;
            $comment->body = $body;
            return $comment;
        } else {
            return false;
        }
    }

    public static function find_the_comments($photo_id = 0) {
        global $database;
        $sql = "SELECT * FROM " . self::$db_table . " WHERE photo_id = " . $database->escape_string($photo_id);
        $sql .= " ORDER BY id DESC";

        return self::find_by_query($sql);
    }

    
    public static function my_query($id) {
        global $database;
        $sql = "SELECT * FROM comments WHERE photo_id = " . $id;
        $this_query = $database->query($sql);

        $the_object_array = array();
        
        while ($row = $this_query->fetch_array(MYSQLI_ASSOC)) {
//      while ($row = $this_query->fetch_assoc()) { // isto kao i prvi red. fetch_array(MYSQLI_ASSOC) = fetch_assoc()
            $komentar_objekt = new Comment;
            
            foreach ($row as $key => $value) {
                $komentar_objekt->$key = $value;
            }
            $the_object_array[] = $komentar_objekt;
        }

        return $the_object_array;
    }

}

// END of Comments Class
?>
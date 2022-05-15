<?php

require_once '../../controllers/DBController.php';

class Comment
{
    protected $db;
    public $comment_id;
    public $user_id;
    public $topic_id;
    public $post_id;
    public $comment_score;
    public $comment_date;
    public $comment_data;

    public function getComments(){
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $query = "SELECT * FROM comments";
            return $this->db->select($query);
        } else {
            echo "Error Connecting to the database";
            return false;
        }
    }

    public function getUsername($user_id){
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $query = 'SELECT username FROM users WHERE user_id = '. $user_id .'';
            $username =  $this->db->select($query);
            return $username[0]['username'];
        } else {
            echo "Error Connecting to the database";
            return false;
        }
    }
}
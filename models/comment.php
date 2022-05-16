<?php

require_once '../../controllers/DBController.php';

class Comment
{
    protected $db;
    public $comment_id;
    public $user_id;
    public $topic_id;
    public $post_id;
    public $comment_date;
    public $comment_data;
    public $comment_score;
    public $counter; // counts data
    public $word_score; // keyword score in comment

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

    public function setComments($comment){
        $this->db = new DBController;
        
    }

    public function commentsRank($comment_data){
        $this->db = new DBController;
        if ($this->db->openConnection()) {       
            $comment_array = explode(' ', $comment_data);
            foreach($comment_array as $word){
                $query = 'SELECT keyword_score FROM keywords WHERE keyword_name = '. $word .' ';
                if($this->db->select($query)){
                    $word_score += $this->db->select($query);
                    $counter++;
                }
            }
            $comment_score = $word_score / $counter;
            return $comment_score;
        } else {
            echo "Error Connecting to the database";
            return false;
        }
    }

}
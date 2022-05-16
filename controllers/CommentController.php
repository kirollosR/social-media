<?php
//extends comment file
require_once '../../models/comment.php';
require_once '../../controllers/DBController.php';

//create Comment_Controller
class commentController{
    protected $db;
//1. Open connection
//2. Run query
//3. Close connection

    public function addComment(Comment $comment){
        //database connection
        $this->db = new DBController;

        if($this->db->openConnection()){
            //query to be added in database
            $query="insert into comments (comment_id,user_id,topic_id,post_id,comment_score,comment_data) values ('',$comment->user_id,$comment->topic_id,$comment->post_id,$comment->comment_score,'$comment->comment_data')";
            return $this->db->insert($query);
        }
        else{
            echo "Error in DataBase connection";
            return false;
        }
    }

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
    
    public function deleteComment($comment_id){
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query = "delete from comments where comment_id = $comment_id";
            return $this->db->delete($query);
        }
        else {
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function updateComment($comment_id,$comment_data){

        $this->db = new DBController;
         
        if($this->db->openConnection()){
            $query="update comment 
             set comment_data='$comment_data' 
             where comment_id=$comment_id ";
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

?>
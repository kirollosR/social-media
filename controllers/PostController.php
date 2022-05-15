<?php
require_once '../../models/post.php';
require_once '../../controllers/DBController.php';


class PostController
{
    protected $db;
    private $score = 0;
    private $count = 0;
    private $avg = 0;
    private $postScore = 0;
//    protected $vars;

    //1. Open connection
    //2. Run query
    //3. Close connection
    public function AddPost(post $post)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            settype($post->user_id,'integer');
            settype($post->topic_id,'integer');
            $query="insert into posts (user_id, topic_id, post_score, post_data, post_likes)
                    values ($post->user_id , $post->topic_id , $post->post_score , '$post->post_data' , $post->post_likes )";
            return $this->db->insert($query);
        }
        else {
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function getAllPosts() {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="select post_id, username, post_score, post_data, post_likes, topic_name, user_profile
                    from posts
                    INNER JOIN users
                    ON posts.user_id = users.user_id
                    INNER JOIN topics
                    ON topics.topic_id = posts.topic_id";
            return $this->db->select($query);
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function getAllPostsByUserId($user)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="select post_id, username, post_score, post_data, post_likes, topic_name
                    from posts
                    INNER JOIN users
                    ON posts.user_id = users.user_id
                    AND posts.user_id = $user->user_id
                    INNER JOIN topics
                    ON topics.topic_id = posts.topic_id";
            return $this->db->select($query);
        }
        else
        {
            echo "Error in Database Connection";
            return false; 
        }
    }

//    public function DeletePost(post $post)
//    {
//        $this->db=new DBController;
//        if($this->db->openConnection())
//        {
//            $query="insert into posts values ( '' , $post->topic_id , $post->post_score , $post->user_id , $post->post_id , '$post->post_data' , $post->post_likes )";
//           return $this->db->delete($query);
//        }
//        else {
//            echo "Error in DataBase connection";
//            return false;
//        }
//    }

    //*************************
    //***POST RANK FUNCTIONS***
    //*************************

//        public function getAllCommentsScore($post_id) {
//        $this->db = new DBController;
//
//        if($this->db->openConnection()){
//            $query = "SELECT comment_score
//                      FROM comments";
//            return $this->db->select($query);
//        }else{
//            echo "Error in DataBase connection";
//            return false;
//        }
//    }
//
//    public function postScore($post_id) {
//        $commentsScore = $this->getAllCommentsScore($post_id);
//
//        foreach($commentsScore as $comment) {
//            $score += $comment;
//            $count++;
//        }
//        $avg = $score / $count;
//        return $avg;
//
//        //TODO: update in database code
//    }
//
//    public function postRank($post_id) {
//        $postScore = $this->postScore($post_id);
//
//        if($postScore > 0 && $postScore <= 2) {
//            echo "Very Negative";
//        }elseif($postScore > 2 && $postScore <= 4) {
//            echo "Negative";
//        }elseif($postScore > 4 && $postScore <= 6) {
//            echo "Neutral";
//        }elseif($postScore > 6 && $postScore <= 8) {
//            echo "Positive";
//        }else{
//            echo "Very Positive";
//        }
//    }

}

?>
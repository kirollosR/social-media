<?php
require_once '../../models/post.php';
require_once '../../controllers/DBController.php';


class PostController
{
    protected $db;
    private $score = 0;
//    private $count = 0;
//    private $avg = 5;
//    private $postScore = 0;
    private $postScoreArray;
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

    public function getAllPostsByUserId(user $user)
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

    public function DeletePost($post_id)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query = "DELETE from posts where post_id = $post_id";
            return $this->db->delete($query);
        }
        else {
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function getPost($post_id) {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="select post_id, username, post_score, post_data, post_likes, topic_name
                    from posts
                    INNER JOIN users
                    ON posts.user_id = users.user_id
                    AND posts.post_id = $post_id
                    INNER JOIN topics
                    ON topics.topic_id = posts.topic_id";
            return $this->db->select($query);
        }
        else {
            echo "Error in DataBase connection";
            return false;
        }
    }

    //*************************
    //***POST RANK FUNCTIONS***
    //*************************

        public function getAllCommentsScore($post_id) {
        $this->db = new DBController;

        if($this->db->openConnection()){
            $query = "SELECT comment_score
                      FROM comments
                      WHERE post_id = $post_id";
            return $this->db->select($query);
        }else{
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function postScore($post_id) {
        $commentsScore = $this->getAllCommentsScore($post_id);
        $count = 0;
        $postScore = 0;

        foreach($commentsScore as $comment) {
            $postScore += $comment['comment_score'];
            $count++;
        }
        if($count == 0){
            $postScore = 5;
            return $postScore;
        }else {
            $avg = $postScore / $count;
            $this->db=new DBController;
            if($this->db->openConnection())
            {
                $query="update posts set post_score = $avg where post_id = $post_id";
                $this->db->update($query);
                return $avg;
            }
            else {
                echo "Error in DataBase connection";
                return false;
            }
        }


        //TODO: update in database code
    }

    public function updatePostScore($post_id) {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="update posts set post_score = $this->postScore($post_id) where post_id = $post_id";
            return $this->db->update($query);
        }
        else {
            echo "Error in DataBase connection";
            return false;
        }
    }

//    public function getCommentsNum($post_id){
//        $this->db=new DBController;
//        if($this->db->openConnection())
//        {
//            $query="select count(comment_id) from comments
//                    where post_id = $post_id AND NOT comment_score = 0";
//            if($this->db->select($query)){
//                $commentNumArray = $this->db->select($query);
//                $commentScore = $commentNumArray[0]['keyword_score'];
//            }
//            return $commentScore;
//        }
//        else
//        {
//            echo "Error in Database Connection";
//            return false;
//        }
//    }
//
//    public function getPostScore($post_id) {
//        $this->db=new DBController;
//        if($this->db->openConnection())
//        {
//            $query="select post_score from posts
//                    where post_id = $post_id";
//            if($this->db->select($query)){
//                $postScoreArray = $this->db->select($query);
//                $postScore = $postScoreArray[0]['keyword_score'];
//            }
//            return $postScore;
//        }
//        else
//        {
//            echo "Error in Database Connection";
//            return false;
//        }
//    }
//
//    public function updatePostScore($post_id, $comment_score) {
//        $this->db=new DBController;
//
//        $postScore = ($comment_score + $this->getPostScore($post_id)) / ($this->getCommentsNum($post_id));
//        if($this->db->openConnection())
//        {
//            $query="update posts set post_score = $postScore where post_id = $post_id";
//            return $this->db->update($query);
//        }
//        else {
//            echo "Error in DataBase connection";
//            return false;
//        }
//    }

    public function postRank($post_id) {
        $postScore = $this->postScore($post_id);

        if($postScore > 0 && $postScore <= 2) {
            return "Very Negative";
        }elseif($postScore > 2 && $postScore <= 4) {
            return "Negative";
        }elseif($postScore > 4 && $postScore <= 6) {
            return "Neutral";
        }elseif($postScore > 6 && $postScore <= 8) {
            return "Positive";
        }else{
            return "Very Positive";
        }
    }

}

?>
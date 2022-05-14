<?php
require_once '../../models/topic.php';
require_once '../../controllers/DBController.php';



class TopicController
{
    protected $db;
//    protected $vars;

    //1. Open connection
    //2. Run query
    //3. Close connection

    public function addTopic(topic $topic)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="insert into topics values ( '' , '$topic->topic_name', $topic->user_id )";
            return $this->db->insert($query);
        }
        else {
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function getAllTopics()
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="select * from topics";
            return $this->db->select($query);
        }
        else
        {
            echo "Error in Database Connection";
            return false; 
        }
    }

    public function deleteTopic($id)
    {
         $this->db=new DBController;
         if($this->db->openConnection())
         {
            $query="delete from topics where topic_id = $id";
            return $this->db->delete($query);
         }
         else
         {
            echo "Error in Database Connection";
            return false; 
         }
    }

}   
?> 
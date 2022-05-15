<?php
require_once '../../controllers/DBController.php';


class SystemController
{
    protected $db;
    //1. Open connection
    //2. Run query
    //3. Close connection
    public function getNumberOfUsers()
    {
        //object from the database controller
        $this->db = new DBController;
        // open connection to DB
        if($this->db->openConnection())
        //if  connection is done 
          {
            $query= "select count(user_id) as count from users ";
            $result =$this->db->select($query);
           return $result;
              $this->db->closeConnection();
            }
          else{

            echo "Error in DataBase connection";
            return false;
                }
    }

    public function getNumberOfPosts()
    {
        $this->db = new DBController;
        if($this->db->openConnection())
     
         {   $query= "select count(post_id) as NumberOfPosts from posts ";
            $result =$this->db->select($query);
            
           return $result;
              $this->db->closeConnection();
 
            }
        else{
            echo "Error in DataBase connection";
            return false;
        }
    }


    public function getNumberOfGoodPosts()
    {
        $this->db = new DBController;
        if($this->db->openConnection())
     
         {   $query= "select count(post_id) as NumberOfGoodPosts from posts
                        where post_score > 6";
            $result =$this->db->select($query);
            
           return $result;
              $this->db->closeConnection();
 
            }
        else{
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function getNumberOfBadPosts()
    {
        $this->db = new DBController;
        if($this->db->openConnection())
     
         {   $query= "select count(post_id) as NumberOfBadPosts from posts 
                          where post_score < 6 ";
            $result =$this->db->select($query);
            
           return $result;
              $this->db->closeConnection();
 
            }
        else{
            echo "Error in DataBase connection";
            return false;
        }
    }
}


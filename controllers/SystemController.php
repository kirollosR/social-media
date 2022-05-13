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
           // $query= "select * from users ";
          //  $query_run=mysqli_query(  $this->db->connection, $query);
            //result 

            $result =$this->db->select($query);
            
           return $result;
        
              // print_r( $result);
              $this->db->closeConnection();

            }
        else{

            echo "Error in DataBase connection";
            return false;
        }
    }

    public function getNumberOfPosts()
    {
       
    }
}


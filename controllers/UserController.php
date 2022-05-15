<?php
require_once '../../models/user.php';
require_once '../../controllers/DBController.php';


class userController
{
    protected $db;
//    protected $vars;

    //1. Open connection
    //2. Run query
    //3. Close connection

    public function updateStatus(user $user)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="update users set user_status = '$user->user_status'  where user_id = $user->user_id";
           return $this->db->update($query);
        }
        else {
            echo "Error in DataBase connection";
            return false;
        }
    }
} 

?> 
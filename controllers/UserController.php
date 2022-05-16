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

    public function updateData(user $user) {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="update users set username = '$user->username', user_firstname = '$user->user_firstname',
                                     user_lastname = '$user->user_lastname', user_email = '$user->user_email',
                                     password = '$user->password'
                    where user_id = $user->user_id";
            return $this->db->update($query);
        }
        else {
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function getUserData($user_id) {
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $query = "SELECT * FROM users WHERE user_id = '$user_id'";
            return $this->db->select($query);
        } else {
            echo "Error Connecting to the database";
            return false;
        }
    }

    public function checkUsername($username,$user_id) {
        $this->db = new DBController;

        if($this->db->openConnection()){
            $query = "SELECT username FROM users
                      WHERE username='$username' AND NOT user_id = $user_id";
            $result = $this->db->select($query);
            if(count($result)!=0){
                return "That username is taken. Try another.";
            }else{
                return "";
            }
        }else{
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function checkEmail($email,$user_id) {
        $this->db = new DBController;

        if($this->db->openConnection()){
            $query = "SELECT username FROM users
                      WHERE user_email = '$email' AND NOT user_id = $user_id";
            $result = $this->db->select($query);
            if(count($result) != 0){
                return "This email is already in use. Please use another one.";
            }else{
                return "";
            }
        }else{
            echo "Error in DataBase connection";
            return false;
        }
    }
} 

?> 
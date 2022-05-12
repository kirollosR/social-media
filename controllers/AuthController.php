<?php
require_once '../../models/user.php';
require_once '../../controllers/DBController.php';
require_once '../models/vars.php';

class AuthController
{
    protected $db;

    //1. Open connection
    //2. Run query
    //3. Close connection
    public function login(user $user){
        //object from the database controller
        $this->db = new DBController;

        if($this->db->openConnection()){ // open connection to DB
            $query=
                "select * from users 
                 where user_email = '$user->user_email' and password = '$user->password'";

            $result = $this->db->select($query);

            if($result === false){
                echo "Error in query";
                $this->db->closeConnection();
                return false;
            }else{
                if(count($result)==0){
                    session_start(); //create a session 3ashan fe kol el pages yeb2a be nafs el data beta3to
                    $_SESSION['errorMsg'] = "You have entered wrong email or password";
                    $this->db->closeConnection();
                    return false;
                }else{
                    session_start();
                    $_SESSION['user_id'] = $result[0]["user_id"];
                    $_SESSION['user_firstname'] = $result[0]["user_firstname"];
                    $_SESSION['user_lastname'] = $result[0]["user_lastname"];
                    $_SESSION['user_email'] = $result[0]["user_email"];
                    $_SESSION['username'] = $result[0]["username"];
                    $_SESSION['gender_id'] = $result[0]["gender_id"];
                    $_SESSION['role_id'] = $result[0]["role_id"];
                    $_SESSION['user_profile'] = $result[0]["user_profile"];
                    $_SESSION['user_status'] = $result[0]["user_status"];
                    $this->db->closeConnection();
                    return true;
                }
            }
        }else{
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function register (user $user)
    {
        $this->db = new DBController;

        if ($this->db->openConnection()) {
            $query =
                "INSERT INTO `users`(`user_firstname`, `user_lastname`, `user_email`, `username`, `password`, `gender_id`, `role_id`, `user_profile`)
                 VALUES ($'user->user_firstname','$user->user_lastname','$user->user_email','$user->username','$user->password',$user->gender_id,$user,'[value-8]')";

            $result = $this->db->insert($query);
            if ($result != false) {
                session_start();

                $_SESSION['userId'] = $result;
                $_SESSION['userName'] = $user->name;
                $_SESSION['userRole'] = 2;

                $this->db->closeConnection();
                return true;
            } else {
                $_SESSION["errorMsg"] = "Something went wrong.. Try again";
                $this->db->closeConnection();
                return false;
            }
        } else {
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function isAuthenticated($roleId){
        if(!isset($_SESSION["userRole"])){  //authentication
            return false;
        }else if($_SESSION["userRole"]!= $roleId) { //authorization
            return false;
        }else{
            return true;
        }
    }
}
<?php
require_once '../../models/user.php';
require_once '../../controllers/DBController.php';
require_once '../../models/vars.php';


class AuthController
{
    protected $db;
    protected $vars;

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
                    $_SESSION['password'] = $result[0]["password"];
                    $this->db->closeConnection();
                    return true;
                }
            }
        }else{
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function getGenders(){
        $this->db = new DBController;

        if($this->db->openConnection()){
            $query = "SELECT * FROM gender";
            return $this->db->select($query);
        }else{
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function register (user $user)
    {
        $this->db = new DBController;
        $this->vars = new vars;

        if ($this->db->openConnection()) {
            $query =
                "INSERT INTO `users`(`user_firstname`, `user_lastname`, `user_email`, `username`, `password`, `gender_id`, `role_id`)
                 VALUES ('$user->user_firstname','$user->user_lastname','$user->user_email','$user->username','$user->password',$user->gender_id,1)";

            $result = $this->db->insert($query);
            if ($result != false) {
                session_start();

                $_SESSION['user_id'] = $result;
                $_SESSION['user_firstname'] = $user->user_firstname;
                $_SESSION['user_lastname'] = $user->user_lastname;
                $_SESSION['user_email'] = $user->user_email;
                $_SESSION['username'] = $user->username;
                $_SESSION['gender_id'] = $user->gender_id;
                $_SESSION['role_id'] = $this->vars->user;
                $_SESSION['user_profile'] = "";

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

    public function checkPassword($pwd) {
        if (strlen($pwd) < 8) {
            $errors = "Password is too short!";
            return $errors;
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $errors = "Password must include at least one number!";
            return $errors;
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $errors = "Password must include at least one letter!";
            return $errors;
        }

        return "";
    }

    public function checkUsername($username) {
        $this->db = new DBController;

        if($this->db->openConnection()){
            $query = "SELECT username FROM users
                      WHERE username='$username'";
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

    public function checkEmail($email) {
        $this->db = new DBController;

        if($this->db->openConnection()){
            $query = "SELECT username FROM users
                      WHERE user_email = '$email'";
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

    public function isAuthenticated($role_id){
        if(!isset($_SESSION["role_id"])){  //authentication
            return false;
        }else if($_SESSION["role_id"]!= $role_id) { //authorization
            return false;
        }else{
            return true;
        }
    }
}
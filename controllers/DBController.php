<?php

class DBController
{
    public $dbHost = "localhost";
    public $dbUser = "root";
    public $dbPassword = "";
    public $dbName = "social_media";
    public $connection;

    public function openConnection(){
        $this->connection = new mysqli($this->dbHost,$this->dbUser,$this->dbPassword,$this->dbName);
        if($this->connection->connect_error){
            echo "Connection error: " . $this->connection->connect_error;
            return false;
        }else{
            return true;
        }
    }

    public function closeConnection(){
        if($this->connection){
            $this->connection->close();
        }else{
            echo "Connection is not opened";
        }
    }

    public function select($query){
        $result = $this->connection->query($query);
        if(!$result){
            echo "Error: " . mysqli_error($this->connection);
            return false;
        }else{
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function insert($query){
        $result = $this->connection->query($query);
        if(!$result){
            echo "Error: " . mysqli_error($this->connection);
            return false;
        }else{
            //this to return id of data inserted
            return $this->connection->insert_id;
        }
    }

    public function delete($query){
        $result = $this->connection->query($query);
        if(!$result){
            echo "Error: " . mysqli_error($this->connection);
            return false;
        }else{
            //this to return id of data inserted
            return $result;
        }
    }
}
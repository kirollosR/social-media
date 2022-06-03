<?php
require_once '../../models/keyword.php';
require_once '../../controllers/DBController.php';



class keywordController
{
    protected $db;
//    protected $vars;

    //1. Open connection
    //2. Run query
    //3. Close connection

    public function addKeyword(Keyword $keyword)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            settype($keyword->user_id,'integer');
            $query="insert into keywords values ( '' , '$keyword->keyword_name' , $keyword->keyword_score , $keyword->user_id )";
           return $this->db->insert($query);
        }
        else {
            echo "Error in DataBase connection";
            return false;
        }
    }

    public function getAllKeywords()
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="select * from keywords";
            return $this->db->select($query);
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function deleteKeyword($keyword_id)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="delete from keywords where keyword_id = $keyword_id";
            return $this->db->delete($query);
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function updateKeyword($keyword_id,$keyword_name,$keyword_score){
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="update keywords set keyword_name = '$keyword_name' , keyword_score=$keyword_score
                    where keyword_id = $keyword_id";
            return $this->db->update($query);
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }

    public function getKeyword($keyword_id) {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="select * from keywords where keyword_id = $keyword_id";
            return $this->db->select($query);
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }
}   
?> 
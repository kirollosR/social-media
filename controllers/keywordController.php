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
}   
?> 
<?php

require_once '../../controllers/DBController.php';

class Comment
{
    protected $db;
    public $comment_id;
    public $user_id;
    public $topic_id;
    public $post_id;
    public $comment_date;
    public $comment_data;
    public $comment_score;
    public $counter; // counts data
}
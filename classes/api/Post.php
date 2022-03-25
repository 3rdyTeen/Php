<?php
class Post{
    private $conn;

    public $id;
    public $user_id;
    public $user_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAllPost(){
        $query="SELECT * FROM post p inner join users u ON p.user_id=u.id Order by p.created_at desc";
        $stmt = $this->conn->prepare($query);
	    $stmt->execute();
	    return $stmt;
    }

}
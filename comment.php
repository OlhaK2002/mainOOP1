<?php

session_start();

include 'database.php';
include 'class_htmlCode.php';
$db = new DB;
$db->Connect();

class Comment{
    protected $text;
    protected $parent_id;
    protected $authorid;
    protected $db;
    public function __construct($db, $text, $parent_id, $author_id)
    {
        $this->db = $db;
        $this->text = $text;
        $this->parent_id = $parent_id;
        $this->authorid = $author_id;
    }
}

$comment = new Comment($db, "{$_POST['text']}", "{$_POST['parent_id']}", "{$_SESSION['user_id']}");


class intoDB extends Comment
{
    protected $sql;
    protected $db;
    protected $count = 0;

    public function __construct($db, $text, $parent_id, $author_id)
    {
        parent::__construct($db, $text, $parent_id, $author_id);
    }

    public function into()
    {
        if($this->text!=""&&$this->authorid!=""&&$this->count<1)
        {
            $this->sql = $this->db->getConnect()->prepare("INSERT INTO `comments` (`authorid`,`text`, `parent_id`) VALUES ( :authorid, :text, :parent_id)");
            $this->sql->bindParam(':authorid', $this->authorid, PDO::PARAM_STR);
            $this->sql->bindParam(':text', $this->text, PDO::PARAM_STR);
            $this->sql->bindParam(':parent_id', $this->parent_id, PDO::PARAM_INT);
            $this->sql->execute();
            $this->count++;
        }
        return true;
    }

    public function evidenceDB()
    {
        if($this->into())
        {
            $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `comments` WHERE `text`=:text and `parent_id`=:parent_id");
            $this->sql->bindParam(':text', $this->text, PDO::PARAM_STR);
            $this->sql->bindParam(':parent_id', $this->parent_id, PDO::PARAM_INT);
            $this->sql->execute();
            return $this->sql;
        }
    }
}

$intoDB = new intoDB($db, "{$_POST['text']}", "{$_POST['parent_id']}", "{$_SESSION['user_id']}");


class Result extends intoDB

{
    protected $array;
    protected $id;
    protected $sql;
    protected $db;
    protected $array1;

    public function __construct($db,$text, $parent_id, $author_id)
    {
        parent::__construct($db,$text, $parent_id, $author_id);
    }

    public function replyComment()
    {
        if($this->evidenceDB())
        {
           $this->array = $this->evidenceDB()->FETCH(PDO::FETCH_ASSOC);
           $this->id = $this->array['id'];
           $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` INNER JOIN `comments` WHERE registor.user_id=comments.authorid AND comments.id=:id");
           $this->sql->bindParam(':id', $this->id, PDO::PARAM_STR);
           $this->sql->execute();
           $this->array1 = $this->sql->FETCH(PDO::FETCH_ASSOC);
            echo '<span style = "font-style: italic">'.$this->array1['login'].'</span>'. '&nbsp' .'<span style="font-style: italic; color: lightseagreen">'." (".$this->array1['data'].") ".'</span>'.'</br>' .$this->array1['text'].'<div class="accordion" id="accordionExample">';
            $reply = new Reply($this->array1['id']);
            echo $reply->replyComment();
            echo '</div><ul><li><div id="comment'.$this->array1['id'].'"></div></li></ul>';

        }
    }
}

$result = new Result($db,"{$_POST['text']}", "{$_POST['parent_id']}", "{$_SESSION['user_id']}");
echo $result->replyComment();







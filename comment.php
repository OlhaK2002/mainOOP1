<?php

session_start();

include 'database.php';
$db = new DB;
$db->Connect();

class Comment{
    protected $text;
    protected $parent_id;
    protected $authorid;
    public function __construct($text, $parent_id, $author_id)
    {
        $this->text = $text;
        $this->parent_id = $parent_id;
        $this->authorid = $author_id;
    }
}

$comment = new Comment("{$_POST['text']}", "{$_POST['parent_id']}", "{$_SESSION['user_id']}");

class intoDB extends Comment
{
    protected $sql;
    protected $comment;
    protected $db;
    protected $count = 0;

    public function __construct($comment, $db)
    {
        $this->comment = $comment;
        $this->db = $db;
    }

    public function into()
    {
        if($this->comment->text!=""&&$this->comment->authorid!=""&&$this->count<1)
        {
            $this->sql = $this->db->getConnect()->prepare("INSERT INTO `comments` (`authorid`,`text`, `parent_id`) VALUES ( :authorid, :text, :parent_id)");
            $this->sql->bindParam(':authorid', $this->comment->authorid, PDO::PARAM_STR);
            $this->sql->bindParam(':text', $this->comment->text, PDO::PARAM_STR);
            $this->sql->bindParam(':parent_id', $this->comment->parent_id, PDO::PARAM_INT);
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
            $this->sql->bindParam(':text', $this->comment->text, PDO::PARAM_STR);
            $this->sql->bindParam(':parent_id', $this->comment->parent_id, PDO::PARAM_INT);
            $this->sql->execute();
            return $this->sql;
        }
    }
}

$intoDB = new intoDB($comment, $db);


class Result extends intoDB

{
    protected $array;
    protected $id;
    protected $sql;
    protected $intoDB;
    protected $db;
    protected $array1;

    public function __construct($intoDB, $db)
    {
        $this->intoDB = $intoDB;
        $this->db = $db;
    }

    public function replyComment()
    {
        if($this->intoDB->evidenceDB())
        {
           $this->array = $this->intoDB->evidenceDB()->FETCH(PDO::FETCH_ASSOC);
           $this->id = $this->array['id'];
           $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` INNER JOIN `comments` WHERE registor.user_id=comments.authorid AND comments.id=:id");
           $this->sql->bindParam(':id', $this->id, PDO::PARAM_STR);
           $this->sql->execute();
           $this->array1 = $this->sql->FETCH(PDO::FETCH_ASSOC);
            return
                '<span style = "font-style: italic">'.$this->array1['login'].'</span>'. '&nbsp' .'<span style="font-style: italic; color: lightseagreen">'." (".$this->array1['data'].") ".'</span>'.'</br>' .$this->array1['text'].'<div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="heading'.$this->array1['id'].'">
                    <h2 class="mb-0">
                     <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" aria-expanded="false" data-target="#collapse_'.$this->array1['id'].'" aria-controls="collapse_'.$this->array1['id'].'">
                Ответить
                    </button>
                    </h2>
                </div>
                <div id="collapse_'.$this->array1['id'].'" class="collapse" aria-labelledby="heading'.$this->array1['id'].'" data-parent="#accordionExample">
                    <div class="card-body">
                          <textarea required name="text" id="text_id'.$this->array1['id'].'" class="form-control"></textarea></br>
                          <input type="hidden" id="parent_id'.$this->array1['id'].'" class="parent_id" name="parent_id" value="'.$this->array1['id'].'">
                          <button id="'.$this->array1['id'].'" type="submit" class="btn btn-light">Отправить</button>
                           
                    </div>
                </div>
            </div><ul><li><div id="comment'.$this->array1['id'].'"></div></li></ul>';

        }
    }
}

$result = new Result($intoDB, $db);
echo $result->replyComment();







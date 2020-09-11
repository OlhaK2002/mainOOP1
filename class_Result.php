<?php
include 'class_Reply.php';
class Result extends IntoDB

{
    protected $array;
    protected $id;
    protected $sql;
    protected $db;
    protected $array1;

    public function replyComment()
    {
        if($this->text!=""&&$this->authorid!="")

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
}
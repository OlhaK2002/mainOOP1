<?php
include 'class_Reply.php';

class Comments
{
    protected $db;
    protected $sql;
    protected $result;
    protected $value0;
    protected $sql0;
    protected $array;
    protected $index;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getComments($array)
    {
        $this->array = $array;
        $this->index = $this->array['id'];
        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` INNER JOIN `comments` WHERE registor.user_id=comments.authorid AND comments.id=:id");
        $this->sql->bindParam(':id', $this->index, PDO::PARAM_STR);
        $this->sql->execute();

        $this->array = $this->sql->FETCH(PDO::FETCH_ASSOC);
        echo '<span style = "font-style: italic">' . $this->array['login'] . '</span>' . '&nbsp' . '<span style="font-style: italic; color: lightseagreen">' . " (" . $this->array['data'] . ") " . '</span>' . '</br>' . '&nbsp' . '&nbsp' . $this->array["text"];
        $this->index = $this->array['id'];

        $sql1 = $this->db->getConnect()->prepare("SELECT * FROM `comments` WHERE `parent_id`=:value");
        $sql1->bindParam(':value', $this->index, PDO::PARAM_INT);
        $sql1->execute();

        if($_SESSION["login"]!="" and $_SESSION["password"]!=""){
            $reply = new Reply($this->index);
            echo $reply->replyComment();
            echo '</div><ul><li><div id="comment' . $this->index . '"></div></li></ul>';
        }

        $this->result = $sql1->rowCount();

        if ($this->result > 0) {

            while ($this->array = $sql1->FETCH(PDO::FETCH_ASSOC))
            {
                echo '<ul>';
                $this->getComments($this->array);
                echo '</ul>';
            }
        }

    }

    public function firstComments()
    {
        $this->value0=0;
        $this->sql0 = $this->db->getConnect()->prepare("SELECT * FROM `comments` WHERE `parent_id`=:value");
        $this->sql0->bindParam(':value', $this->value0, PDO::PARAM_INT);
        $this->sql0->execute();

        while ($this->array = $this->sql0->FETCH(PDO::FETCH_ASSOC))
        {
            echo '<ul>';
            $this->getComments($this->array);
            echo '</ul>';
        }
        echo '<ul><li><div id="comment0"></div></li></ul>';
    }
}

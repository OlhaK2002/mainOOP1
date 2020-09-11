<?php
session_start();
include 'class_htmlCode.php';
include 'database.php';
$db = new DB;
$db->Connect();

class Comments
{
    protected $db;
    protected $sql;
    protected $result;
    protected $value0;
    protected $sql0;
    protected $sql1;
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
        echo '<span style = "font-style: italic">'.$this->array['login'] . '</span>' . '&nbsp' . '<span style="font-style: italic; color: lightseagreen">' . " (" . $this->array['data'] . ") " . '</span>' . '</br>' . '&nbsp' . '&nbsp' . $this->array["text"];
        $this->index = $this->array['id'];
        $this->sql1 = $this->db->getConnect()->prepare("SELECT * FROM `comments` WHERE `parent_id`=:value");
        $this->sql1->bindParam(':value', $this->index, PDO::PARAM_INT);
        $this->sql1->execute();
        if($_SESSION["login"]!="" and $_SESSION["password"]!=""){
            $reply = new Reply($this->index);
            echo $reply->replyComment();
            echo '</div><ul><li><div id="comment' . $this->index . '"></div></li></ul>';
        }
        $this->result = $this->sql1->rowCount();
        if ($this->result > 0) {
            while ($this->array = $this->sql1->FETCH(PDO::FETCH_ASSOC))
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

$htmlCode = new htmlCode();
echo $htmlCode->beginCode();

if($_SESSION["login"]=="" and $_SESSION["password"]=="")echo '<li><a href="signin.php">Авторизация</a></li>';
if($_SESSION["login"]=="" and $_SESSION["password"]=="")echo '<li><a href="registration.php">Регистрация</a></li>';
if($_SESSION["login"]!="" and $_SESSION["password"]!="")echo '<li><a href="exit.php">Выход</a></li>';

echo $htmlCode->mainCode();

if(!($_SESSION["login"]!="" and $_SESSION["password"]!="")) {
    echo 'Для того чтобы оставить свой отзыв - '.'<a href="signin.php">войдите</a>'.' или '.'<a href="registration.php">зарегистрируйтеся</a>';
}

else{
    echo ' <textarea required name="text" id="text_id0" class="form-control" placeholder="Введите Ваш комментарий..."></textarea>
           <input type="hidden" id="parent_id0" class="parent" name="parent_id" value="0">
           <button id="0" type="submit" class="btn btn-light">Отправить</button>';
}
$comments = new Comments($db);
$comments->firstComments();
echo $htmlCode->endCode();




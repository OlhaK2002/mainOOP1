<?php
class IntoDB extends Comment
{
    protected $sql;
    protected $db;

    public function into()
    {
        if($this->text!=""&&$this->authorid!="")
        {
            $this->sql = $this->db->getConnect()->prepare("INSERT INTO `comments` (`authorid`,`text`, `parent_id`) VALUES ( :authorid, :text, :parent_id)");
            $this->sql->bindParam(':authorid', $this->authorid, PDO::PARAM_STR);
            $this->sql->bindParam(':text', $this->text, PDO::PARAM_STR);
            $this->sql->bindParam(':parent_id', $this->parent_id, PDO::PARAM_INT);
            $this->sql->execute();
        }

    }
    public function evidenceDB()
    {
        if($this->text!=""&&$this->authorid!="") {

                $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `comments` WHERE `text`=:text and `parent_id`=:parent_id");
                $this->sql->bindParam(':text', $this->text, PDO::PARAM_STR);
                $this->sql->bindParam(':parent_id', $this->parent_id, PDO::PARAM_INT);
                $this->sql->execute();
                return $this->sql;

        }
    }
}
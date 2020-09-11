<?php
class ProcedureDB extends VerificationR
{
    protected $password_hash;
    protected $db;
    public function __construct($db,$name, $surname, $email, $login, $password1, $password2, $password_hash)
    {
        parent::__construct($db, $name, $surname, $email, $login, $password1, $password2);
        $this->password_hash = $password_hash;
    }
    public function intoDB()
    {

        if(($this->evidenceEmail())&&($this->evidenceLogin())&&($this->evidencePasswords())&&($this->evidencePassword())&&($this->evidencePassword1()))
        {
            $this->sql= $this->db->getConnect()->prepare("INSERT INTO `registor`(`name`,`surname`,`email`,`login`,`password1`) VALUES (:name, :surname, :email, :login, :password)");
            $this->sql->bindParam(':name', $this->name, PDO::PARAM_STR);
            $this->sql->bindParam(':surname', $this->surname, PDO::PARAM_STR);
            $this->sql->bindParam(':email', $this->email, PDO::PARAM_STR);
            $this->sql->bindParam(':login', $this->login, PDO::PARAM_STR);
            $this->sql->bindParam(':password', $this->password_hash, PDO::PARAM_STR);
            $this->sql->execute();
            return true;
        }
        else return false;
    }

    public function evidenceDB()
    {

        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `name`= :name and `surname`=:surname and `email`=:email and `login`=:login and `password1`=:password ");
        $this->sql->bindParam(':name', $this->name, PDO::PARAM_STR);
        $this->sql->bindParam(':surname', $this->surname, PDO::PARAM_STR);
        $this->sql->bindParam(':email', $this->email, PDO::PARAM_STR);
        $this->sql->bindParam(':login', $this->login, PDO::PARAM_STR);
        $this->sql->bindParam(':password', $this->password_hash, PDO::PARAM_STR);
        $this->sql->execute();
        return $this->sql;

    }

}
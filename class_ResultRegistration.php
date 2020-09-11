<?php
class ResultR extends ProcedureDB
{
    private $array;

    public function getResult()
    {
        if($this->intoDB())
        {
            $this->array = $this->evidenceDB()->FETCH(PDO::FETCH_ASSOC);
            $_SESSION["login"] = $this->login;
            $_SESSION["password"] = $this->password_hash;
            $_SESSION["user_id"] = $this->array['user_id'];
            $_SESSION['error']="";
            $_SESSION['error_email']="";
            $_SESSION['error_login']="";
            $_SESSION['error_passwords']="";
            $_SESSION['error_password']="";
            $_SESSION['error_password1']="";
            header("Location: index.php");
        }
        else header("Location: registration.php");
    }
}
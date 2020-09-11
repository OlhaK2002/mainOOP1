<?php
class ResultA extends VerificationA
{
    public function valuePassword()
    {
        if($this->Evidence()){
            $_SESSION["login"] = $this->login;
            $_SESSION["password"] = $this->array['password1'];
            $_SESSION['error']="";
            $_SESSION['error_email']="";
            $_SESSION['error_login']="";
            $_SESSION['error_passwords']="";
            $_SESSION['error_password']="";
            $_SESSION['error_password1']="";
            $_SESSION['user_id'] = $this->array['user_id'];
            header("Location: index.php");
        }
        else {$_SESSION['error']="Неверно указан логин или пароль";
            header("Location: signin.php");
        }
    }

}

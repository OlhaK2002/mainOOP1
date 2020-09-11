<?php

session_start();

include 'database.php';
$db = new DB;
$db->Connect();


class Authorization
{
    protected $login;
    protected $password;
    protected $db;

    public function __construct($db,$login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $this->db = $db;
    }
}

$authorization = new Authorization($db, "{$_POST['login1']}", "{$_POST['password2']}");

class Verification extends Authorization
{
    protected $db;
    protected $sql;
    protected $array;
    protected $hash;
    protected $password_verification;

    public function __construct($db,$login, $password)
    {
        parent::__construct($db,$login, $password);
    }

    public function Evidence()
    {
        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `login`= :login LIMIT 1");
        $this->sql->bindParam(':login',$this->login,PDO::PARAM_INT);
        $this->sql->execute();
        $this->array = $this->sql->FETCH(PDO::FETCH_ASSOC);
        $this->hash=$this->array['password1'];
        $this->password_verification = password_verify($this->password,$this->hash);
        return $this->password_verification;

    }

}

$verification = new Verification($db,"{$_POST['login1']}", "{$_POST['password2']}");

class Result extends Verification
{
  public function __construct($db,$login, $password)
  {
      parent::__construct($db,$login, $password);
  }

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


$result = new Result($db,"{$_POST['login1']}", "{$_POST['password2']}");
$result->valuePassword();



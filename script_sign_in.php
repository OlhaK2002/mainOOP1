<?php

session_start();

include 'database.php';
$db = new DB;
$db->Connect();


class Authorization
{
    protected $login;
    protected $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getLogin()
    {
        return $this->login;
    }
    public function getPassword()
    {
        return $this->password;
    }

}

$authorization = new Authorization("{$_POST['login1']}", "{$_POST['password2']}");

class Verification extends Authorization
{
    protected $db;
    protected $authorization;
    protected $sql;
    protected $array;
    protected $hash;
    protected $password_verification;

    public function __construct($db, $authorization)
    {
        $this->db = $db;
        $this->authorization = $authorization;
    }

    public function Evidence()
    {
        $this->db->Connect();
        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `login`= :login LIMIT 1");
        $this->sql->bindParam(':login',$this->authorization->getLogin(),PDO::PARAM_INT);
        $this->sql->execute();
        $this->array = $this->sql->FETCH(PDO::FETCH_ASSOC);
        $this->hash=$this->array['password1'];
        $this->password_verification = password_verify($this->authorization->getPassword(),$this->hash);
        return $this->password_verification;
    }

}

$verification = new Verification($db, $authorization);
$verification->Evidence();

class Result extends Verification
{
    private $verification;
    public function __construct($verification)
    {
        $this->verification = $verification;
    }
    public function valuePassword()
    {
        if($this->verification->password_verification){
            $_SESSION["login"] = $this->verification->authorization->getLogin();
            $_SESSION["password"] = $this->verification->array['password1'];
            $_SESSION['error']="";
            $_SESSION['user_id'] = $this->verification->array['user_id'];
            header("Location: index.php");
        }
        else {$_SESSION['error']="Неверно указан логин или пароль"; header("Location: signin.php");}
    }

}

$result = new Result($verification);
$result->valuePassword();



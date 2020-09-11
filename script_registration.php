<?php

session_start();

include 'database.php';
$db = new DB;
$db->Connect();

class Registration
{
    protected $name;
    protected $surname;
    protected $email;
    protected $login;
    protected $password1;
    protected $password2;
    protected $db;

    public function __construct($db, $name, $surname, $email, $login, $password1, $password2)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->login = $login;
        $this->password1 = $password1;
        $this->password2 = $password2;
        $this->db = $db;

    }
}

$registration = new Registration($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}");

class Verification extends Registration
{
    protected $sql;
    protected $count_0=0;
    protected $count_A=0;
    protected $count_b=0;
    public function __construct($db,$name, $surname, $email, $login, $password1, $password2)
    {
        parent::__construct($db,$name, $surname, $email, $login, $password1, $password2);

    }

    public function evidenceEmail()
    {

        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `email`= :email");
        $this->sql->bindParam(':email',$this->email,PDO::PARAM_STR);
        $this->sql->execute();
        if($this->sql->rowCount()>=1){$_SESSION['error_email'] = "Ваша почта уже используется другим пользователем";return false;}
        else {return true;}
    }

    public function evidenceLogin()
    {
        $this->db->Connect();
        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `login`= :login");
        $this->sql->bindParam(':login',$this->login,PDO::PARAM_STR);
        $this->sql->execute();
        if($this->sql->rowCount()>=1){$_SESSION['error_login'] = "Ваш логин уже используется другим пользователем";return false;}
        else {return true;}
    }

    public function evidencePasswords()
    {
        if($this->password1!=$this->password2){$_SESSION['error_passwords'] = "Пароли не совпадают";return false;}
        else {return true;}
    }

    public function evidencePassword()
    {
        if(strlen($this->password1)<6) {$_SESSION['error_password'] = "Пароль должен быть не меньше шести символов";return false;}
        else {return true;}
    }

    public function evidencePassword1()
    {

        for($i=0;$i<strlen($this->password1);$i++) {
            if ($this->password1[$i] >= 'A' && $this->password1[$i] <= 'Z') $this->count_A++;
            if ($this->password1[$i] >= 'a' && $this->password1[$i] <= 'z') $this->count_b++;
            if ($this->password1[$i] >= '0' && $this->password1[$i] <= '9') $this->count_0++;
        }
        if(!($this->count_A>0 && $this->count_b>0 && $this->count_0 >0)) {
                $_SESSION['error_password1']="Пароль должен содержать цифры, а также символы верхнего и нижнего регистра";
                return false;
        }
        else return true;
    }

}

$verification = new Verification($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}");
$verification->evidenceEmail();
$verification->evidenceLogin();
$verification->evidencePasswords();
$verification->evidencePassword();
$verification->evidencePassword1();

class hashPassword extends Verification
{
    protected $password;
    public function __construct($db, $name, $surname, $email, $login, $password1, $password2)
    {
        parent::__construct($db, $name, $surname, $email, $login, $password1, $password2);
    }

    public function hash()
    {
        $this->password = password_hash($this->password1, PASSWORD_DEFAULT);
        return $this->password;
    }
}

$password_hash = new hashPassword ($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}");


class procedureDB extends Verification
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

$procedureDB = new procedureDB($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}", $password_hash->hash());


class Result1 extends procedureDB
{
    private $array;

    public function __construct($db,$name, $surname, $email, $login, $password1, $password2, $password_hash)
    {
        parent::__construct($db,$name, $surname, $email, $login, $password1, $password2, $password_hash);
    }
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
$result = new Result1($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}", $password_hash->hash());;
$result->getResult();






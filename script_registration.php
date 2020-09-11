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

    public function __construct($name, $surname, $email, $login, $password1, $password2)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->login = $login;
        $this->password1 = $password1;
        $this->password2 = $password2;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function getPassword1()
    {
        return $this->password1;
    }
    public function getPassword2()
    {
        return $this->password2;
    }

}
$_POST['Password1'];$_POST['Password2'];

$registration = new Registration("{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}");


class Verification extends Registration
{

    protected $db;
    protected $registration;
    protected $sql;
    protected $count_0=0;
    protected $count_A=0;
    protected $count_b=0;

    public function __construct($db, $registration)
    {
        $this->db = $db;
        $this->registration = $registration;
    }

    public function evidenceEmail()
    {
        $this->db->Connect();
        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `email`= :email");
        $this->sql->bindParam(':email',$this->registration->getEmail(),PDO::PARAM_STR);
        $this->sql->execute();
        if($this->sql->rowCount()>=1){$_SESSION['error_email'] = "Ваша почта уже используется другим пользователем";return false;}
        else {return true;}
    }

    public function evidenceLogin()
    {
        $this->db->Connect();
        $this->sql = $this->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `login`= :login");
        $this->sql->bindParam(':login',$this->registration->getLogin(),PDO::PARAM_STR);
        $this->sql->execute();
        if($this->sql->rowCount()>=1){$_SESSION['error_login'] = "Ваш логин уже используется другим пользователем";return false;}
        else {return true;}
    }

    public function evidencePasswords()
    {
        if($this->registration->getPassword1()!=$this->registration->getPassword2()){$_SESSION['error_passwords'] = "Пароли не совпадают";return false;}
        else {return true;}
    }

    public function evidencePassword()
    {
        if(strlen($this->registration->getPassword1())<6) {$_SESSION['error_password'] = "Пароль должен быть не меньше шести символов";return false;}
        else {return true;}
    }

    public function evidencePassword1()
    {

        for($i=0;$i<strlen($this->registration->getPassword1());$i++) {
            if ($this->registration->getPassword1()[$i] >= 'A' && $this->registration->getPassword1()[$i] <= 'Z') $this->count_A++;
            if ($this->registration->getPassword1()[$i] >= 'a' && $this->registration->getPassword1()[$i] <= 'z') $this->count_b++;
            if ($this->registration->getPassword1()[$i] >= '0' && $this->registration->getPassword1()[$i] <= '9') $this->count_0++;
        }
        if(!($this->count_A>0 && $this->count_b>0 && $this->count_0 >0)) {
                $_SESSION['error_password1']="Пароль должен содержать цифры, а также символы верхнего и нижнего регистра";
                return false;
        }
        else return true;
    }

}

$verification = new Verification($db, $registration);
$verification->evidenceEmail();
$verification->evidenceLogin();
$verification->evidencePasswords();
$verification->evidencePassword();
$verification->evidencePassword1();

class hashPassword extends Verification
{
    protected $password;
    protected $verification;

    public function __construct($verification)
    {
        $this->verification = $verification;
    }

    public function hash()
    {
        $this->password = password_hash($this->verification->registration->getPassword1(), PASSWORD_DEFAULT);
        return $this->password;
    }
}

$password_hash = new hashPassword($verification);

class procedureDB extends Verification
{
    protected $verification;
    protected $password;
    public function __construct($verification, $password_hash)
    {
        $this->verification = $verification;
        $this->password = $password_hash;
        //echo $password_hash;
    }
    public function intoDB()
    {
        if(($this->verification->evidenceEmail())&&($this->verification->evidenceLogin())&&($this->verification->evidencePasswords())&&($this->verification->evidencePassword())&&($this->verification->evidencePassword1()))
        {
            $this->sql= $this->verification->db->getConnect()->prepare("INSERT INTO `registor`(`name`,`surname`,`email`,`login`,`password1`) VALUES (:name, :surname, :email, :login, :password)");
            $this->sql->bindParam(':name', $this->verification->registration->getName(), PDO::PARAM_STR);
            $this->sql->bindParam(':surname', $this->verification->registration->getSurname(), PDO::PARAM_STR);
            $this->sql->bindParam(':email', $this->verification->registration->getEmail(), PDO::PARAM_STR);
            $this->sql->bindParam(':login', $this->verification->registration->getLogin(), PDO::PARAM_STR);
            $this->sql->bindParam(':password', $this->password, PDO::PARAM_STR);
            $this->sql->execute();
            return true;
        }
        else return false;
    }

    public function evidenceDB()
    {

            $this->sql = $this->verification->db->getConnect()->prepare("SELECT * FROM `registor` WHERE `name`= :name and `surname`=:surname and `email`=:email and `login`=:login and `password1`=:password ");
            $this->sql->bindParam(':name', $this->verification->registration->getName(), PDO::PARAM_STR);
            $this->sql->bindParam(':surname', $this->verification->registration->getSurname(), PDO::PARAM_STR);
            $this->sql->bindParam(':email', $this->verification->registration->getEmail(), PDO::PARAM_STR);
            $this->sql->bindParam(':login', $this->verification->registration->getLogin(), PDO::PARAM_STR);
            $this->sql->bindParam(':password', $this->password, PDO::PARAM_STR);
            $this->sql->execute();
            return $this->sql;

    }

}

$procedureDB = new procedureDB($verification, $password_hash->hash());


class Result1 extends procedureDB
{
    private $procedure;
    private $array;
    public function __construct($procedure)
    {
        $this->procedure = $procedure;
    }
    public function getResult()
    {
        if($this->procedure->intoDB())
        {
            $this->array = $this->procedure->evidenceDB()->FETCH(PDO::FETCH_ASSOC);
            $_SESSION["login"] = $this->procedure->verification->registration->getLogin();
            $_SESSION["password"] = $this->procedure->password;
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
$result = new Result1($procedureDB);
$result->getResult();




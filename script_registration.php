<?php

session_start();
$count_A=0;$count_a=0;$count_0=0;

$error = 0;
$_SESSION['error_email']="";
$_SESSION['error_login']="";
$_SESSION['error_passwords']="";
$_SESSION['error_password']="";
$_SESSION['error_password1']="";

global $link;
include 'database.php';

$name = $_POST['Name'];
$surname = $_POST['Surname'];
$email = $_POST['Email'];
$login = $_POST['Login'];
$password1 = $_POST['Password1'];
$password2 = $_POST['Password2'];

$sql1 = $link->query("SELECT * FROM `registor` WHERE `email`= '$email'");

if($sql1->rowCount()>=1){
    $error++;
    $_SESSION['error_email'] = "Ваша почта уже используется другим пользователем";

}

$sql2 = $link->query("SELECT * FROM `registor` WHERE `login`= '$login'");

if($sql2->rowCount()>=1){
    $error++;
    $_SESSION['error_login'] = "Ваш логин уже используется другим пользователем";
}

if($password1!=$password2){
    $error++;
    $_SESSION['error_passwords'] = "Пароли не совпадают";

}

if(strlen($password1)<6) {
    $error++;
    $_SESSION['error_password'] = "Пароль должен быть не меньше шести символов";

}

for($i=0;$i<strlen($password1);$i++)
{
    if($password1[$i]>='A'&& $password1[$i]<='Z')$count_A++;
    if($password1[$i]>='a'&& $password1[$i]<='z')$count_a++;
    if($password1[$i]>='0'&& $password1[$i]<='9')$count_0++;

}


if(!($count_A>0 && $count_a>0 && $count_0 >0)) {
    $error++;
    $_SESSION['error_password1']="Пароль должен содержать цифры, а также символы верхнего и нижнего регистра";
}

if($error>0){header("Location: registration.php");}
else {
    $password = password_hash($password1, PASSWORD_DEFAULT);

    $sql= $link->prepare("INSERT INTO `registor`(`name`,`surname`,`email`,`login`,`password1`) VALUES (:name, :surname, :email, :login, :password)");
    $sql->bindParam(':name', $name);
    $sql->bindParam(':surname', $surname);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':login', $login);
    $sql->bindParam(':password', $password);

    $sql->execute();

    if (!($link->query("SELECT * FROM `registor` WHERE `name`= '$name' and `surname`='$surname' and `email`='$email' and `login`='$login' and `password1`='$password'")))
    {
        echo "Что-то пошло не так( Попробуйте зарегистрироваться заново!";
    }
    else {
        //echo "Регистрация успешно выполнена!";
        $_SESSION["login"] = $login;
        $_SESSION["password1"] = $password;
        $_SESSION['error_email']="";
        $_SESSION['error_login']="";
        $_SESSION['error_passwords']="";
        $_SESSION['error_password']="";
        $_SESSION['error_password1']="";
        header("Location: index.php");
    }

}

<?php

session_start();

include 'database.php';
$link = new PDO(PDO_DB, PDO_LOG, PDO_PAS);

$_SESSION['error']="";

$login = $_POST['login1'];
$password = $_POST['password2'];

$sql = $link->prepare("SELECT * FROM `registor` WHERE `login`= :login LIMIT 1");
$sql->bindParam(':login',$login,PDO::PARAM_INT);
$sql->execute();

$arr = $sql->FETCH(PDO::FETCH_ASSOC);

$hash=$arr['password1'];
$password3= password_verify($password,$hash);

if($password3){
    $_SESSION["login"] = $login;
    $_SESSION["password1"] = $arr['password1'];
    $_SESSION["email"]=$arr['email'];
    $_SESSION['error']="";
    $_SESSION['user_id'] = $arr['user_id'];
    $_SESSION['error_email']="";
    $_SESSION['error_login']="";
    $_SESSION['error_passwords']="";
    $_SESSION['error_password']="";
    $_SESSION['error_password1']="";
    header("Location: index.php");
}
else {
    $_SESSION['error']="Неверно указан логин или пароль";
    header("Location: signin.php");
}




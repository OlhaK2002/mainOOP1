<?php
session_start();

$_SESSION['error']="";

global $link;
include 'database.php';

$login = $_POST['login1'];

$password = $_POST['password2'];

$sql = $link->query("SELECT * FROM `registor` WHERE `login`= '$login' LIMIT 1");

$arr = $sql->FETCH(PDO::FETCH_ASSOC);

$hash=$arr['password1'];
$password3= password_verify($password,$hash);

if($password3){
    $_SESSION["login"] = $login;
    $_SESSION["password1"] = $arr['password1'];
    $_SESSION['error']="";
    header("Location: index.php");

}
else {
    $_SESSION['error']="Неверно указан логин или пароль";
    header("Location: signin.php");
}

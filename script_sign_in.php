<?php
session_start();
$link = mysqli_connect("127.0.0.1", "root", "root", "guest_book");

$login = $_POST['login1'];
$password = $_POST['password2'];
$sql= mysqli_query($link,"SELECT * FROM `registor` WHERE `login`= '$login' LIMIT 1");
$arr = mysqli_fetch_assoc($sql);
$hash=$arr['password1'];
//echo $password;
//echo $hash;
$password3= password_verify($password,$hash);
if($password3){
    //echo 'Авторизация успешно выполнена!';
    $_SESSION["login"] = $login;
    $_SESSION["password1"] = $arr['password1'];
    //echo '<a href="index.php">Перейдите на главную страницу<a>';
    header("Location: index.php");

}
else {echo 'Неверно указан логин или пароль';}




mysqli_close($link);
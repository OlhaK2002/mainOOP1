<?php
    session_start();

    $_SESSION['error']="";

    $link = mysqli_connect("127.0.0.1", "root", "root", "guest_book");

    $login = $_POST['login1'];

    $password = $_POST['password2'];

    $sql= mysqli_query($link,"SELECT * FROM `registor` WHERE `login`= '$login' LIMIT 1");

    $arr = mysqli_fetch_assoc($sql);

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




mysqli_close($link);
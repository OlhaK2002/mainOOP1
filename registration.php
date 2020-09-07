<?php
session_start();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>registration</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</head>
<body>
<header>
    <span id="title1">Гостевая книга</span>
    <div class="menu">
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="signin.php">Авторизация</a></li>
                <li><a href="registration.php">Регистрация</a></li>
            </ul>
        </nav>
    </div>
</header>
<hr>
<?php
echo '<ul>';
if($_SESSION['error_email']!=""){echo '<li><span style="color: red">'.$_SESSION['error_email'].'</span></li><br/>';}
if($_SESSION['error_login']!=""){echo '<li><span style="color: red">'.$_SESSION['error_login'].'</span></li><br/>';}
if($_SESSION['error_passwords']!=""){echo '<li><span style="color: red">'.$_SESSION['error_passwords'].'</span></li><br/>';}
if($_SESSION['error_password']!=""){echo '<li><span style="color: red">'.$_SESSION['error_password'].'</span></li><br/>';}
if($_SESSION['error_password1']!=""){echo '<li><span style="color: red">'.$_SESSION['error_password1'].'</span></li><br/>';}
echo '</ul>';



?>
<div class="field">
    <span id="title2">Регистрация:</span><br/>
    <form method="post" action="script_registration.php">
        <span>Имя: </span><br/>
        <input required type="text" name="Name"/><br/><br/>
        <span>Фамилия: </span><br/>
        <input required type="text" name="Surname"/><br/><br/>
        <span>Почта: </span><br/>
        <input required type="email" name="Email"/><br/><br/>
        <span>Логин: </span><br/>
        <input required type="text" name="Login" /><br/><br/>
        <span>Пароль: </span><br/>
        <input required type="password" name="Password1" /><br/><br/>
        <span>Подтверждение пароля:</span><br/>
        <input required type="password" name="Password2" /><br/><br/>
        <button type="submit" name="Button_s" class="btn btn-light" >Зарегистрироваться</button>

    </form>
</div>
</body>
</html>


<?php
session_start();

?>

<!DOCTYPE HTML>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Sign up</title>
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
if($_SESSION['error']!=""){echo '<li><span style="color: red">'.$_SESSION['error'].'</span></li><br/>';}
echo '</ul>';
?>
<div class="field">
    <span id="title2">Авторизация:</span><br/>
    <form method="post" action="script_sign_in.php">
        <span>Логин: </span><br/>
        <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required type="text" name="login1"><br/><br/>
        <span>Пароль: </span><br/>
        <input class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required type="password" name="password2"><br/><br/>
        <button type="submit" class="btn btn-light">Войти</button>
    </form>
</div>
</body>
</html>

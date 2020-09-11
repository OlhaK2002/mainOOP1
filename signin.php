<?php
session_start();
include 'class_htmlCode.php';
$htmlCode = new htmlCode();
echo $htmlCode->beginCode();

echo '<li><a href="signin.php">Авторизация</a></li><li><a href="registration.php">Регистрация</a></li>';

echo $htmlCode->mainCode();

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

<?php
echo $htmlCode->endCode();

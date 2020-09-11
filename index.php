<?php
session_start();

include 'class_HtmlCode.php';
include 'class_Database.php';
include 'class_Comments.php';

    $db = new DB;
    $db->Connect();

    $htmlCode = new HtmlCode();
    echo $htmlCode->beginCode();

    if($_SESSION["login"]=="" and $_SESSION["password"]=="")echo '<li><a href="signin.php">Авторизация</a></li>';
    if($_SESSION["login"]=="" and $_SESSION["password"]=="")echo '<li><a href="registration.php">Регистрация</a></li>';
    if($_SESSION["login"]!="" and $_SESSION["password"]!="")echo '<li><a href="exit.php">Выход</a></li>';

    echo $htmlCode->mainCode();

    if(!($_SESSION["login"]!="" and $_SESSION["password"]!="")) {
        echo 'Для того чтобы оставить свой отзыв - '.'<a href="signin.php">войдите</a>'.' или '.'<a href="registration.php">зарегистрируйтеся</a>';
    }

    else {echo ' <textarea required name="text" id="text_id0" class="form-control" placeholder="Введите Ваш комментарий..."></textarea>
                 <input type="hidden" id="parent_id0" class="parent" name="parent_id" value="0">
                 <button id="0" type="submit" class="btn btn-light">Отправить</button>';
    }

    $comments = new Comments($db);
    $comments->firstComments();
    echo $htmlCode->endCode();




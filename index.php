<?php

session_start();

function getComment($arr)
{
    $link = mysqli_connect("127.0.0.1", "root", "root", "guest_book");


    echo '<span style = "font-style: italic">'.$arr['author'] .'</span>'. '&nbsp' .'<span style="font-style: italic; color: lightseagreen">'. " (".$arr['data'] . ") ".'</span>'.'</br>' . '&nbsp' . '&nbsp' ;
    echo $arr["text"];

    $k=$arr['id'];
    $sql = mysqli_query($link, "SELECT * FROM `comments` WHERE `parent_id`= $k");

    if($_SESSION["login"]!="" and $_SESSION["password1"]!="") {

       echo ' 
         <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="heading' . $k . '">
                    <h2 class="mb-0">
                     <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" aria-expanded="false" data-target="#collapse_' . $k . '" aria-controls="collapse_' . $k . '">
                      Ответить
                    </button>
                    </h2>
                </div>
                <div id="collapse_' . $k . '" class="collapse" aria-labelledby="heading' . $k . '" data-parent="#accordionExample">
                    <div class="card-body">
                          <textarea required name="text" id="text_id' . $k . '" class="form-control"></textarea></br>
                          <input type="hidden" id="parent_id' . $k . '" class="parent_id" name="parent_id" value="' . $k . '">
                          <button id="' . $k . '" type="submit" class="btn btn-light">Отправить</button>
                         
                    </div>
                </div>
                </div><ul><li><div id="comment' . $k . '"></div></li></ul>';}

    $result = mysqli_num_rows($sql);
    if($result>0)
    {
        while($arr = mysqli_fetch_assoc($sql)) {
            echo '<ul>';
            getComment($arr);
            echo '</ul>';
        }
    }
}
?>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Guest book</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="reply.js"></script>
</head>
<body>
<header>
    <span id="title1">Гостевая книга</span>
    <div class="menu">
        <nav>
            <ul>
                <li><a href="/">Главная</a></li>
                <?php if($_SESSION["login"]=="" and $_SESSION["password1"]=="")echo '<li><a href="signin.php">Авторизация</a></li>'?>
                <?php if($_SESSION["login"]=="" and $_SESSION["password1"]=="")echo '<li><a href="registration.php">Регистрация</a></li>'?>
                <?php if($_SESSION["login"]!="" and $_SESSION["password1"]!="")echo '<li><a href="exit.php">Выход</a></li>';?>

            </ul>
        </nav>
    </div>
</header>
<hr>
<?php

//global $k;

if(!($_SESSION["login"]!="" and $_SESSION["password1"]!="")) {
    echo 'Для того чтобы оставить свой отзыв - '.'<a href="signin.php">войдите</a>'.' или '.'<a href="registration.php">зарегистрируйтеся</a>';
}
else{
    echo '        
                    <textarea required name="text" id="text_id0" class="form-control" placeholder="Введите Ваш комментарий..."></textarea>
                    <input type="hidden" id="parent_id0" class="parent" name="parent_id" value="0">
                    <button id="0" type="submit" class="btn btn-light">Отправить</button>
                  
          ';}

    $link = mysqli_connect("127.0.0.1", "root", "root", "guest_book");

    $sql = mysqli_query($link, "SELECT * FROM `comments` WHERE `parent_id`=0");

    while($arr = mysqli_fetch_assoc($sql))
    {
        echo '<ul>';
        getComment($arr);
        echo '</ul>';
    }

     echo '<ul><li><div id="comment0"></div></li></ul>';

?>

</body>
</html>

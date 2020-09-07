<?php
session_start();

$link = 'constant';
include 'database.php';

$author=$_SESSION["login"];
$text=$_POST["text"];
$parent_id=$_POST["parent_id"];

if($text!="") {

    $sql = $link->prepare("INSERT INTO `comments` (`author`, `text`, `parent_id`) VALUES (:author, :text, :parent_id)");
    $sql->bindParam(':author', $author, PDO::PARAM_STR);
    $sql->bindParam(':text', $text, PDO::PARAM_STR);
    $sql->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
    $sql->execute();

    $sql2 = $link->prepare("SELECT * FROM `comments` WHERE `author`=:author and `text`=:text and `parent_id`=:parent_id");
    $sql2->bindParam(':author', $author, PDO::PARAM_STR);
    $sql2->bindParam(':text', $text, PDO::PARAM_STR);
    $sql2->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
    $sql2->execute();

    if($sql2)
    {
        $arr1 = $sql2->FETCH(PDO::FETCH_ASSOC);

        echo '<span style = "font-style: italic">'.$author.'</span>'. '&nbsp' .'<span style="font-style: italic; color: lightseagreen">'." (".$arr1['data'].") ".'</span>'.'</br>' .$text.'<div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="heading'.$arr1['id'].'">
                    <h2 class="mb-0">
                     <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" aria-expanded="false" data-target="#collapse_'.$arr1['id'].'" aria-controls="collapse_'.$arr1['id'].'">
                Ответить
                    </button>
                    </h2>
                </div>
                <div id="collapse_'.$arr1['id'].'" class="collapse" aria-labelledby="heading'.$arr1['id'].'" data-parent="#accordionExample">
                    <div class="card-body">
                          <textarea required name="text" id="text_id'.$arr1['id'].'" class="form-control"></textarea></br>
                          <input type="hidden" id="parent_id'.$arr1['id'].'" class="parent_id" name="parent_id" value="'.$arr1['id'].'">
                          <button id="'.$arr1['id'].'" type="submit" class="btn btn-light">Отправить</button>
                           
                    </div>
                </div>
            </div><ul><li><div id="comment'.$arr1['id'].'"></div></li></ul>';
    }


}




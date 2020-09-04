<?php
session_start();

$link= mysqli_connect("127.0.0.1", "root", "root", "guest_book");

$author=$_SESSION["login"];
$text=$_POST["text"];
$parent_id=$_POST["parent_id"];

if($text!="") {
    $sql = ("INSERT INTO `comments` (`author`, `text`, `parent_id`) VALUES ('$author', '$text', '$parent_id') ");
    if(mysqli_query($link, $sql)){
        $sql2 = mysqli_query($link, ("SELECT * FROM `comments` WHERE `author`='$author' and `text`='$text' and `parent_id`='$parent_id'"));
        //echo $author.$text.$parent_id;
        $arr1 = mysqli_fetch_assoc($sql2);
        //echo $result_id=$arr1['id'];
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



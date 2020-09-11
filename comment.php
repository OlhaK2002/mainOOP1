<?php

session_start();

include 'class_Database.php';
include 'class_HtmlCode.php';
include 'class_Comment.php';
include 'class_IntoDB.php';
include 'class_Result.php';

$db = new DB;
$db->Connect();

$comment = new Comment($db, "{$_POST['text']}", "{$_POST['parent_id']}", "{$_SESSION['user_id']}");

$intoDB = new IntoDB($db, "{$_POST['text']}", "{$_POST['parent_id']}", "{$_SESSION['user_id']}");
$intoDB->into();

$result = new Result($db,"{$_POST['text']}", "{$_POST['parent_id']}", "{$_SESSION['user_id']}");
echo $result->replyComment();







<?php

session_start();

include 'class_Database.php';
include 'class_Authorization.php';
include 'class_VerificationAuthorization.php';
include 'class_ResultAuthorization.php';

$db = new DB;
$db->Connect();

$authorization = new Authorization($db, "{$_POST['login1']}", "{$_POST['password2']}");

$verification = new VerificationA($db,"{$_POST['login1']}", "{$_POST['password2']}");

$result = new ResultA($db,"{$_POST['login1']}", "{$_POST['password2']}");
$result->valuePassword();



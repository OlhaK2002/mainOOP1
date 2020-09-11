<?php

session_start();

include 'class_Database.php';
include 'class_Registration.php';
include 'class_VerificationRegistration.php';
include 'class_HashPassword.php';
include 'class_ProcedureDB.php';
include 'class_ResultRegistration.php';

$db = new DB;
$db->Connect();

$registration = new Registration($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}");

$verification = new VerificationR($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}");
$verification->evidenceEmail();
$verification->evidenceLogin();
$verification->evidencePasswords();
$verification->evidencePassword();
$verification->evidencePassword1();

$password_hash = new HashPassword ($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}");

$procedureDB = new ProcedureDB($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}", $password_hash->hash());

$result = new ResultR($db,"{$_POST['Name']}","{$_POST['Surname']}","{$_POST['Email']}","{$_POST['Login']}","{$_POST['Password1']}","{$_POST['Password2']}", $password_hash->hash());;
$result->getResult();






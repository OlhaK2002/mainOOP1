<?php
session_start();
$_SESSION["login"] = "";
$_SESSION["password"] = "";
header("Location: \index.php");

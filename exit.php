<?php
session_start();
$_SESSION["login"] = "";
$_SESSION["password1"] = "";
header("Location: \index.php");
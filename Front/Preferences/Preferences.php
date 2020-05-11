<?php

session_start(); 
if (isset($_SESSION["username"]))
{
require "Preferences.html";
if (isset($_POST['buton']))
{
$name = $_SESSION["username"];
$password = $_POST['password'] ?? '';
$continent = $_POST['continent'] ?? '';
$status = $_POST['status'] ?? '';
$salt = 'ProiectWeb2020';
if ($password != '')
    $pass = sha1($password.$salt);
else
    $pass = '';


$con = mysqli_connect('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
if (!$con)
	die(mysqli_connect_error());

if ($continent != '')
{
$sql = "update users SET Continent = '$continent' where Username = '$name'";
$interogare = mysqli_query($con,$sql);
}
if ($status != '')
{
$sql = "update users SET Status = '$status' where Username = '$name'";
$interogare = mysqli_query($con,$sql);
}
if ($pass != '')
{
$sql = "update users SET Password = '$pass' where Username = '$name'";
$interogare = mysqli_query($con,$sql);
}
header("Location: ../User/User.php");
mysqli_close($con);
}
}
else
    {    header("Location: ../Login/Login.php");
    exit;}
?> 












<?php
session_start(); 
unset ($_SESSION["FirstVisit"]);
if (!isset($_SESSION['FirstVisit2'])) {
    $_SESSION['FirstVisit2'] = 1;
    $_SESSION['error2'] = 0;
    }

require 'Register.html';

if (isset($_POST['buton']))
{

$name = $_POST['uname'] ?? '';
$password = $_POST['password'] ?? '';
$continent = $_POST['continent'] ?? '';
$status = $_POST['status'] ?? '';
$salt = 'ProiectWeb2020'; 
$pass = sha1($password.$salt); 
						
$con = mysqli_connect('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
if (!$con)
	die(mysqli_connect_error());

$sql = "SELECT username FROM users WHERE username = '$name'";
$interogare = mysqli_query($con,$sql);

if($interogare->num_rows == 0)
{
	$sql = "insert into users (Username, Password, Continent, Status) VALUES ('$name', '$pass','$continent','$status')";
	$interogare = mysqli_query($con,$sql);
    unset ($_SESSION["FirstVisit2"]);
    header("Location: ../Login/Login.php");
}
else
{
    $_SESSION['error2'] = 1;
    header("Location: Register.php");
}   

mysqli_close($con);
}

?> 












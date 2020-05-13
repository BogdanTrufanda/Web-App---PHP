<?php

session_start(); 
if (isset($_SESSION["username"]))
{
    
require "Preferences.html";
if (isset($_POST['buton']))
{
$name = $_SESSION["username"];
$password = $_POST['uname'] ?? '';
$passwords = $_POST['unames'] ?? '';
$continent = $_POST['continent'] ?? '';
$status = $_POST['status'] ?? '';
$salt = 'ProiectWeb2020';
if ($password != '')
    $pass = sha1($password.$salt);
else
    $pass = '';
if ($passwords != '')
    $passs = sha1($passwords.$salt);
else
    $passs = '';


$con = mysqli_connect('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
if (!$con)
	die(mysqli_connect_error());

if ($continent != '')
{
$sql = "update users SET Continent = '$continent' where username = '$name'";
$interogare = mysqli_query($con,$sql);
}
if ($status != '')
{
$sql = "update users SET Status = '$status' where username = '$name'";
$interogare = mysqli_query($con,$sql);
}
if ($pass != '')
{    
 if ($passs != '')
 {
     if (strcmp($pass,$passs) == 0)
     {
         
         $sql = "SELECT password FROM users WHERE username = '$name'";
         $interogare = mysqli_query($con,$sql);  
             
        if (mysqli_num_rows($interogare) > 0) 
        {
            while($row = mysqli_fetch_assoc($interogare))
            {
                $parolapref = $row["password"];
            }
        }   
        if (strcmp($parolapref,$pass) == 0)
        {
        $_SESSION['preferror'] = 1;
         header("Location: Preferences.php");
        }
         else
         {
            $sql = "update users SET Password = '$pass' where username = '$name'";
        $interogare = mysqli_query($con,$sql);
                     mysqli_close($con);
          header("Location: ../User/User.php");
         }

     }
     else
     {
         $_SESSION['preferror'] = 1;
         header("Location: Preferences.php");
     }
 }
}

}
}
else
    {    header("Location: ../Login/Login.php");
    exit;}
?> 












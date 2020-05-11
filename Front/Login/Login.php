<?php

session_start(); 
unset ($_SESSION["FirstVisit2"]);

if (!isset($_SESSION['FirstVisit'])) {
    $_SESSION['FirstVisit'] = 1;
    $_SESSION['error'] = 0;
    }

if (isset($_SESSION["username"]))
{session_unset(); 
}


require 'login.html';

if (isset($_POST['buton']))
{

$name = $_POST['uname'] ?? '';
$password = $_POST['password'] ?? '';
$salt = 'ProiectWeb2020'; 
$pass = sha1($password.$salt); 

						
$con = mysqli_connect('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
if (!$con)
	die(mysqli_connect_error());

$sql = "SELECT username FROM users WHERE username = '$name'";
$interogare = mysqli_query($con,$sql);

if($interogare->num_rows == 0)
{
    $_SESSION['error'] = 1;
    header("Location: Login.php");
}
else
{
$sql = "SELECT password FROM users WHERE username = '$name'";
$interogare = mysqli_query($con,$sql);  


    
if (mysqli_num_rows($interogare) > 0) 
{
    while($row = mysqli_fetch_assoc($interogare))
    {
        $parola = $row["password"];
    }
}   

if (strcmp($parola,$pass) != 0)
{
    $_SESSION['error'] = 1;
    header("Location: Login.php");
}
else
{
        unset ($_SESSION["FirstVisit"]);
        $_SESSION["username"] = $name;
      header("Location: ../Recommendation/Recommendation.html");
      exit;
}

}   

mysqli_close($con);
}

?> 












<?php
  session_start();
if (isset($_SESSION["username"]))
{
    require 'Recommendation.html';
}
else
    {    
    header("Location: ../Login/Login.php");
    exit;
    }
?>


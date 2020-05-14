<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if (isset($_SESSION["username"]))
{
    require 'Limit.html';
}
else
{    
    header("Location: ../Login/Login.php");
    exit;
}
?>
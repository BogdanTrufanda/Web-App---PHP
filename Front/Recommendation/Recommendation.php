<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
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


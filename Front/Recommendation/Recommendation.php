<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

session_start();
if (isset($_SESSION["username"]))
{
    require 'Recommendation.html';

    $con = new mysqli('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');

    $name = $_SESSION["username"];
    $stmt = $con->prepare("SELECT id, continent, status FROM users WHERE username = ?");
    $stmt->bind_param('s', $name); 

    $stmt->execute();

    $result = $stmt->get_result();


    while ($col = $result->fetch_assoc())
    {
        $_SESSION['ID'] = $col['id']; 
        $_SESSION['regiune'] = $col['continent']; 
        $_SESSION['status'] = $col['status'];     
    }  
}
else
{    
    exit(header("Location: ../../index.php"));
    exit;
}
?>


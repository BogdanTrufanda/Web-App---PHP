<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

session_start();
if (isset($_SESSION["username"]))
{
    $name = $_SESSION["username"];
    
    $con = mysqli_connect('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
    if (!$con)
        die(mysqli_connect_error());

    $sql = "SELECT username, continent, status, table_score, bus_score, church_score, traffic_score, internet_score, job_score 
    FROM users 
    JOIN scores
    ON users.id = scores.user_id WHERE username = '$name'";
    
    $interogare = mysqli_query($con,$sql);
    $row_cnt = mysqli_num_rows($interogare);
    
    if ($row_cnt)
    {

        while ($col = $interogare->fetch_assoc()){
            $user = $col['username'];
            $region = $col['continent'];
            $status = $col['status'];
            $file = "./ChurchManners/".$region.".txt";
            $document = file_get_contents($file);
            $lines = explode("\n", $document);            
        }
    }

    $_SESSION["manners"] = $lines;
    $_SESSION["topic"] = "Church";
    $_SESSION["quiz"] = "church_score";
    
    if(isset($_POST["quizdiff"]))
    {
        $difficulty = $_POST["quizdiff"];
        $_SESSION["quizdiff"] = $difficulty;
        exit(header("Location: ../Quiz/test.php"));
    }
    
    require "Manners.html";
}
else
{    
    exit(header("Location: ../../index.php"));
}

?>
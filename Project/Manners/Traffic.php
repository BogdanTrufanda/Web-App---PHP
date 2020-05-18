<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
if (isset($_SESSION["username"]))
{
    $name = $_SESSION["username"];

    $region = $_SESSION['regiune'];
    $file = "./TrafficManners/".$region.".txt";
    $document = file_get_contents($file);
    $lines = explode("\n", $document);            

    $_SESSION["manners"] = $lines;
    $_SESSION["topic"] = "Traffic";
    $_SESSION["quiz"] = "traffic_score";

    if(isset($_GET["quizdiff"]))
    {

        $difficulty = $_GET["quizdiff"];
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
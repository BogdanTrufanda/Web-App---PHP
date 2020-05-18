<?php

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
<?php

session_start();
if (isset($_SESSION["username"]))
{
    $name = $_SESSION["username"];

    $region = $_SESSION['regiune'];
    $file = "./TableManners/".$region.".txt";
    $document = file_get_contents($file);
    $lines = explode("\n", $document); 

    $_SESSION["manners"] = $lines;
    $_SESSION["topic"] = "Table";
    $_SESSION["quiz"] = "table_score";

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
    exit(header("Location: ../Login/Login.php"));
}

?>
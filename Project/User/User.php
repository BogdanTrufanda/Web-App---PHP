<?php
session_start();
if (isset($_SESSION["username"]))
{
    $name = $_SESSION["username"];
    $con = new mysqli('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
    if ($con -> connect_errno) 
    {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
    }

    $stmt = $con->prepare('SELECT table_score, bus_score, church_score, traffic_score, internet_score, job_score 
FROM scores WHERE user_id = ?');
    $stmt->bind_param('s', $_SESSION['ID']); 

    $stmt->execute();

    $result = $stmt->get_result();
    while ($col = $result->fetch_assoc())
    {
        $table_score = $col['table_score'];
        $bus_score = $col['bus_score'];
        $church_score = $col['church_score'];
        $traffic_score = $col['traffic_score'];
        $internet_score = $col['internet_score'];
        $job_score = $col['job_score'];
    }

    $user = $_SESSION["username"];
    $region =  $_SESSION['regiune'];
    $status = $_SESSION['status'];

    require 'User.html';
    mysqli_close($con); 
}
else
{    
    exit(header("Location: ../../index.php"));
    exit;
}
?>


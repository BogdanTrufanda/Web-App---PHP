<?php
session_start();
if (isset($_SESSION["username"]))
{
    $con = new mysqli('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
    if ($con -> connect_errno) 
    {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
    }

    $stmt = $con->prepare('SELECT username, table_score, bus_score, church_score, traffic_score, internet_score, job_score 
FROM users 
JOIN scores
ON users.id = scores.user_id');

    $stmt->execute();
    $result = $stmt->get_result();

    while ($col = $result->fetch_assoc())
    {
        $tablescorearray[$col['username']] = $col['table_score'];
        $busscorearray[$col['username']] = $col['bus_score'];
        $churchscorearray[$col['username']] = $col['church_score'];
        $trafficscorearray[$col['username']] = $col['traffic_score'];
        $internetscorearray[$col['username']] = $col['internet_score'];
        $jobscorearray[$col['username']] = $col['job_score'];
    }
    arsort($tablescorearray);
    arsort($busscorearray);
    arsort($churchscorearray);
    arsort($trafficscorearray);
    arsort($internetscorearray);
    arsort($jobscorearray);

    $_SESSION["table"] = array_slice($tablescorearray, 0, 5, true);
    $_SESSION["bus"] = array_slice($busscorearray, 0, 5, true);
    $_SESSION["church"] = array_slice($churchscorearray, 0, 5, true);
    $_SESSION["traffic"] = array_slice($trafficscorearray, 0, 5, true);
    $_SESSION["internet"] = array_slice($internetscorearray, 0, 5, true);
    $_SESSION["job"] = array_slice($jobscorearray, 0, 5, true);


    require "Rankings.html";
    mysqli_close($con);
}
else
{
    exit(header("Location: ../../index.php"));
}
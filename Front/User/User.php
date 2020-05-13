<?php
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
while ($col = $interogare->fetch_assoc())
{
$user = $col['username'];
$region = $col['continent'];
$status = $col['status'];
$table_score = $col['table_score'];
$bus_score = $col['bus_score'];
$church_score = $col['church_score'];
$traffic_score = $col['traffic_score'];
$internet_score = $col['internet_score'];
$job_score = $col['job_score'];
}

}
    require 'User.html';
    mysqli_close($con); 
}
else
    {    
    header("Location: ../Login/Login.php");
    exit;
    }
?>


<?php
session_start(); 
require 'Register.html';

if (isset($_POST['buton']))
{

    $name = $_POST['uname'] ?? '';
    $password = $_POST['password'] ?? '';
    $continent = $_POST['continent'] ?? '';
    $status = $_POST['status'] ?? '';
    $salt = 'ProiectWeb2020'; 
    $pass = sha1($password.$salt); 

    $con = new mysqli('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
    if ($mysqli -> connect_errno) 
    {
        echo "Failed to connect to MySQL: " . $con -> connect_error;
        exit();
    }

    $stmt = $con->prepare('SELECT username FROM users WHERE username = ?');
    $stmt->bind_param('s', $name); 

    $stmt->execute();

    $result = $stmt->get_result();


    if($result->num_rows == 0)
    {



        $stmt = $con->prepare('insert into users (Username, Password, Continent, Status) VALUES (?,?,?,?)');
        $stmt->bind_param('ssss', $name, $pass, $continent, $status); 

        $stmt->execute();

        $stmt = $con->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->bind_param('s', $name); 

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
        }

        $sql = "insert into scores (user_id, table_score, bus_score, church_score, traffic_score, internet_score, job_score) VALUES ('$id', 0, 0, 0, 0, 0, 0)";
        $interogare = mysqli_query($con,$sql);

        exit(header("Location: ../../index.php"));
    }
    else
    {
        $_SESSION['errorregister'] = 1;
        exit(header('Location: '.$_SERVER['PHP_SELF']));
    }   

    mysqli_close($con);
}

?> 












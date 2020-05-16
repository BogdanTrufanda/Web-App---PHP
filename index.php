<?php

session_start(); 

if (isset($_SESSION["username"]))
{
    $_SESSION = array();
    session_destroy();
}

require 'Front\Login\login.html';

if (isset($_POST['buton']))
{

    $name = $_POST['uname'] ?? '';
    $password = $_POST['password'] ?? '';
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
        $_SESSION['errorlogin'] = 1;
        exit(header('Location: '.$_SERVER['PHP_SELF']));
    }
    else
    {
        $stmt = $con->prepare('SELECT password FROM users WHERE username = ?');
        $stmt->bind_param('s', $name);

        $stmt->execute();

        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) 
        {

            while ($row = $result->fetch_assoc()) {
                $parola = $row["password"];
            }
        }   

        if (strcmp($parola,$pass) != 0)
        {
            $_SESSION['errorlogin'] = 1;
            exit(header('Location: '.$_SERVER['PHP_SELF']));
        }
        else
        {
            $_SESSION["username"] = $name;
            exit(header("Location: Front/Recommendation/Recommendation.php"));
        }

    }   

    mysqli_close($con);
}

?> 












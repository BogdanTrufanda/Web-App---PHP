<?php

session_start(); 
if (isset($_SESSION["username"]))
{

    require "Preferences.html";
    if (isset($_POST['buton']))
    {
        $name = $_SESSION["username"];
        $password = $_POST['uname'] ?? '';
        $passwords = $_POST['unames'] ?? '';
        $continent = $_POST['continent'] ?? '';
        $status = $_POST['status'] ?? '';
        $salt = 'ProiectWeb2020';
        if ($password != '')
            $pass = sha1($password.$salt);
        else
            $pass = '';
        if ($passwords != '')
            $passs = sha1($passwords.$salt);
        else
            $passs = '';

        $con = new mysqli('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
        if ($con -> connect_errno) 
        {
            echo "Failed to connect to MySQL: " . $con -> connect_error;
            exit();
        }
        if ($continent != '')
        {
            $_SESSION['regiune'] = $continent; 
            $stmt = $con->prepare("update users SET continent = '$continent' where username = ?");
            $stmt->bind_param('s', $name); 
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if ($status != '')
        {
            $_SESSION['status'] = $status;
            $stmt = $con->prepare("update users SET status = '$status' where username = ?");
            $stmt->bind_param('s', $name); 
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if ($pass != '')
        {    
            if ($passs != '')
            {
                if (strcmp($pass,$passs) == 0)
                {
                    $stmt = $con->prepare('SELECT password FROM users WHERE username = ?');
                    $stmt->bind_param('s', $name); 

                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($col = $result->fetch_assoc())
                    {
                        $parolapref = $row["password"];

                    }
                    if (strcmp($parolapref,$pass) == 0)
                    {
                        $_SESSION['preferror'] = 1;
                        exit(header('Location: '.$_SERVER['PHP_SELF']));
                    }
                    else
                    {

                        $stmt = $con->prepare("update users SET password = '$pass' where username = ?");
                        $stmt->bind_param('s', $name); 
                        $stmt->execute();
                        $result = $stmt->get_result();
                        mysqli_close($con);
                    }
                }
                else
                {
                    $_SESSION['preferror'] = 1;
                    exit(header('Location: '.$_SERVER['PHP_SELF']));
                }
            }
        }
        exit(header("Location: ../User/User.php"));
    }
}
else
{    
    exit(header("Location: ../../index.php"));
}
?> 












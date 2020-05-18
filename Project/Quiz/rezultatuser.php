<?php
session_start();

if (isset($_SESSION["username"]))
{
    if (isset($_SESSION['userinput']))
    { 
        $contor = 0;
        $punctaj = 0;
        $correct = $_SESSION["answerstring"];
        $stringuser = $_SESSION['userinput'];
        for ($i = 0; $i <= 14; $i++) {
            if (intval($stringuser[$i]) == intval($correct[$i]))
                if (intval($stringuser[$i]) == 1)
                {
                    $contor ++;
                }

        }
        $difficulty = $_SESSION['quizdiff'];
        if(strcmp($difficulty, 'Quiz Lvl 1') == 0){
            {
                $_SESSION["punctetotal"] = 50;
                $punctaj = 10 * $contor;
            }
        }
        if(strcmp($difficulty, 'Quiz Lvl 2') == 0){
            {$punctaj = 50 * $contor;
             $_SESSION["punctetotal"] = 250;
            }
        }
        if(strcmp($difficulty, 'Quiz Lvl 3') == 0){
            {$punctaj = 100 * $contor;
             $_SESSION["punctetotal"] = 500;
            }
        }
        $name = $_SESSION["username"];
        
        $con = new mysqli('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
        if ($con -> connect_errno) 
        {
            echo "Failed to connect to MySQL: " . $con -> connect_error;
            exit();
        }

        $stmt = $con->prepare('SELECT id from users WHERE username = ?');
        $stmt->bind_param('s', $name); 

        $stmt->execute();
        $result = $stmt->get_result();
        while ($col = $result->fetch_assoc())
        {
            $id = $col['id'];

        }
        $topic = $_SESSION['quiz'];


        $stmt = $con->prepare("update scores SET $topic = $topic + '$punctaj' where user_id = ?");
        $stmt->bind_param('s', $id); 

        $stmt->execute();

        $cookie_topic = $_SESSION["topic"];
        $cookiename = $cookie_topic . $name; 

        if(strcmp($difficulty, 'Quiz Lvl 1') == 0){
            if(!isset($_COOKIE[$cookiename])) 
            {
                $cookiename = $cookiename . "1";
                setcookie($cookiename, 1, time() + (60), "/"); 
                setcookie("time_cookie", round(microtime(true) * 1000) + 60000, time() + (60), "/"); 
            }
        }
        $_SESSION['puncte'] = $punctaj;
        require "Rezultatuser.html";
        unset($_SESSION["answerstring"]);
        unset($_SESSION["userinput"]);
        mysqli_close($con);

    }
    else
    {
        exit(header("Location: test.php"));
    }
}
else
{    
    exit(header("Location: ../../index.php"));
}



?>
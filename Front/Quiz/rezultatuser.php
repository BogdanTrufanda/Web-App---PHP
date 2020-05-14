<?php
  session_start();

if (isset($_SESSION["username"]))
{
    if (isset($_SESSION['userinput']))
    {   $contor = 0;
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
            $punctaj = 10 * $contor;
        }
        if(strcmp($difficulty, 'Quiz Lvl 2') == 0){
            $punctaj = 50 * $contor;
        }
        if(strcmp($difficulty, 'Quiz Lvl 3') == 0){
            $punctaj = 100 * $contor;
        }
     $name = $_SESSION["username"];
     $con = mysqli_connect('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
        if (!$con)
            die(mysqli_connect_error());
     
     
     
     $sql = "SELECT user_id, table_score, bus_score, church_score, traffic_score, internet_score, job_score 
            FROM users 
            JOIN scores
            ON users.id = scores.user_id WHERE username = '$name'";
            $interogare = mysqli_query($con,$sql);
     $row_cnt = mysqli_num_rows($interogare);
    if ($row_cnt) 
    {
    while ($col = $interogare->fetch_assoc())
    {
    $id = $col['user_id'];
    $table_score = $col['table_score'];
    $bus_score = $col['bus_score'];
    $church_score = $col['church_score'];
    $traffic_score = $col['traffic_score'];
    $internet_score = $col['internet_score'];
    $job_score = $col['job_score'];
    }
    }
     
     $topic = $_SESSION['quiz'];
     $sql = "update scores SET $topic = $topic + '$punctaj'  where user_id = '$id'";
     $interogare = mysqli_query($con,$sql);
     $cookic = $_SESSION["topic"];
     $cookiename = $cookic . $name; 
            if(strcmp($difficulty, 'Quiz Lvl 1') == 0){
            if(!isset($_COOKIE[$cookiename])) 
            {
                $cookiename = $cookiename . "1"; 
                echo $cookiename;
            setcookie($cookiename, 1, time() + (900), "/"); 
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
        header("Location: test.php");
    }
}
else
{    
    header("Location: ../Login/Login.php");
    exit;
}



?>
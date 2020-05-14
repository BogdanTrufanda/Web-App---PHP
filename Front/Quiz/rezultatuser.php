<?php
  session_start();

if (isset($_SESSION["username"]))
{
    if (isset($_SESSION['userinput']))
    {   $contor = 0;
        $punctaj = 0;
        $correct = $_SESSION["answerstring"];
        $stringuser = $_SESSION['userinput'];
                echo "<br>";
        for ($i = 0; $i <= 14; $i++) {
            echo intval($stringuser[$i]). " ". intval($correct[$i]). " ";
            if (intval($stringuser[$i]) == intval($correct[$i]))
                if (intval($stringuser[$i]) == 1)
                {echo "Y";
                 $contor ++;
                }
                
            echo "<br>";
        }
        echo "<br>";
        echo $contor;
                echo "<br>";
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
        // $punctaj = 10 * $contor;
        echo "USERUL A OBTINUT ".$punctaj. " PUNCTE!!";
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
          echo "<br>";
        echo $id;
            echo $table_score."<br>";
        echo $bus_score."<br>";
        echo $church_score."<br>";
        echo $traffic_score."<br>";
        echo $internet_score."<br>";
        echo $job_score."<br>";
    }
        
     // aici e hardcodat cu internet_score pt ca inca nu e facut conexiunea intre recomandari si quizuri
     $sql = "update scores SET internet_score = internet_score + '$punctaj'  where user_id = '$id'";
     $interogare = mysqli_query($con,$sql);
     
     
     
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
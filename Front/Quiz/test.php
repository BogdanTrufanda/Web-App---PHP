<?php
  session_start();

if (isset($_SESSION["username"]))
{

    if(isset($_COOKIE[$_SESSION['topic']]))
    {require 'limit.php';
    }
    else
    {
    {
    if (!isset($_SESSION["answerstring"]))
    {        
    $name = $_SESSION["username"];
    $con = mysqli_connect('eu-cdbr-west-03.cleardb.net','bb3b9afcbd4373','baf1fc8d','heroku_dd67cd94965d526');
    if (!$con)
        die(mysqli_connect_error());

    $sql = "SELECT continent, status FROM users WHERE username = '$name'";
    $interogare = mysqli_query($con,$sql);


    $row_cnt = mysqli_num_rows($interogare);
    if ($row_cnt) {
        
        while ($col = $interogare->fetch_assoc()){
            $region = $col['continent'];
            $status = $col['status'];
            $difficulty = $_SESSION['quizdiff'];
            //echo $difficulty;
            if(strcmp($difficulty, 'Quiz Lvl 1') == 0){
                $file = "./Quizuri1/".$_SESSION['topic']."/".$region.".txt";
            }
            if(strcmp($difficulty, 'Quiz Lvl 2') == 0){
                $file = "./Quizuri2/".$_SESSION['topic']."/".$region.".txt";
            }
            if(strcmp($difficulty, 'Quiz Lvl 3') == 0){
                $file = "./Quizuri3/".$_SESSION['topic']."/".$region.".txt";
            }
            $document = file_get_contents($file);
            $lines = explode("\n", $document);            
        }
    }

    //identifying lines containing questions in file
    $question_lines = array();
    for($i = 0; $i <= 38; $i = $i+5){
        array_push($question_lines, $i);
    }
    //shuffling and randomly selecting 5 out of 8 questions
    shuffle($question_lines);
    $selected_questions_indexes = array_rand(array_flip($question_lines), 5);
    // print_r($selected_questions_indexes);


    //generating array of arrays, each array containing the question
    //and the 3 answers associated with it
    $questions_and_answers = array();
    foreach ($selected_questions_indexes as $index){
        $array_to_shuffle = array($lines[$index+1], $lines[$index+2], $lines[$index+3]);
        shuffle($array_to_shuffle);
        $array_to_push = array();
        array_push($array_to_push, $lines[$index], $array_to_shuffle[0], $array_to_shuffle[1], $array_to_shuffle[2]);
        array_push($questions_and_answers, $array_to_push);
        $array_to_shuffle = array();
        $array_to_push = array();
    }
    //print_r($questions_and_answers);

    $generated_answer_string = "";
    foreach ($questions_and_answers as $question){
        $generated_answer_string .= $question[1][3];
        $generated_answer_string .= $question[2][3];
        $generated_answer_string .= $question[3][3];
    }

    $_SESSION["questionsanswers"] = $questions_and_answers;
    $_SESSION["answerstring"] = $generated_answer_string;
    require "Quiz.html";
    }
    else
    {
    if (isset($_POST["buton"]))
    {
        if (isset($_POST['q1']) && isset($_POST['q2']) && isset($_POST['q3']) && isset($_POST['q4']) && isset($_POST['q5']))
        {
        $stringuser = "";
        $stringuser = $stringuser . $_POST['q1'] . $_POST['q2'] . $_POST['q3'] . $_POST['q4'] . $_POST['q5'];
        $_SESSION['userinput'] = $stringuser;
        header("Location: rezultatuser.php");    
        }
        else
        {
            require "Quiz.html";
        }
    }
        else
        {
            unset($_SESSION["answerstring"]);
            header('Location: '.$_SERVER['PHP_SELF']);
            die;
        }
    }
    }
}
}

else
{    
    header("Location: ../Login/Login.php");
    exit;
}

?>
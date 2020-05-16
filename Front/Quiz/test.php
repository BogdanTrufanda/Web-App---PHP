<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

session_start();

if (isset($_SESSION["username"]))
{

    $topic = $_SESSION["topic"];
    $name = $_SESSION["username"];
    $tmp = $topic . $name;

    if(strcmp($_SESSION['quizdiff'], 'Quiz Lvl 1') == 0)
    {
        $difficulty = 1;
        $tmp = $topic . $name . $difficulty;
    }
    if(isset($_COOKIE[$tmp]))
    {
        require 'limit.php';
    }
    else
    {
        {
            if (!isset($_SESSION["answerstring"]))
            {        
                $name = $_SESSION["username"];

                $region = $_SESSION['regiune'];
                $status = $_SESSION['status'];
                $difficulty = $_SESSION['quizdiff'];
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

                $question_lines = array();
                for($i = 0; $i <= 38; $i = $i+5)
                {
                    array_push($question_lines, $i);
                }
                shuffle($question_lines);
                $selected_questions_indexes = array_rand(array_flip($question_lines), 5);
                $questions_and_answers = array();

                foreach ($selected_questions_indexes as $index)
                {
                    $array_to_shuffle = array($lines[$index+1], $lines[$index+2], $lines[$index+3]);
                    shuffle($array_to_shuffle);
                    $array_to_push = array();
                    array_push($array_to_push, $lines[$index], $array_to_shuffle[0], $array_to_shuffle[1], $array_to_shuffle[2]);
                    array_push($questions_and_answers, $array_to_push);
                    $array_to_shuffle = array();
                    $array_to_push = array();
                }

                $generated_answer_string = "";
                foreach ($questions_and_answers as $question)
                {
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
                        exit(header("Location: rezultatuser.php"));    
                    }
                    else
                    {
                        require "Quiz.html";
                    }
                }
                else
                {
                    unset($_SESSION["answerstring"]);
                    exit(header('Location: '.$_SERVER['PHP_SELF']));
                }
            }
        }
    }
}

else
{    
    exit(header("Location: ../../index.php"));
}

?>
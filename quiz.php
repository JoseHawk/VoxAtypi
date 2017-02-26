<?php session_start();

    if($_SESSION['question_number']==0){
        $_SESSION['question_number']++;
    }

    if(!isset($_SESSION['question_number'])){
        $_SESSION['question_number'] = 1;
        $_SESSION['correct_answers'] = 0;
    }
    
    include 'includes/db.php';
    
    $diff = $_GET['diff'];
    $button_a = 'class="answer-a"';
    $button_b = 'class="answer-b"';
    $button_c = 'class="answer-c"';
    $button_d = 'class="answer-d"';

    if($diff == "easy"){
        $sel_sql = "SELECT * FROM quiz WHERE question_id = '$_SESSION[question_number]'";
    }else if($diff == "hard"){
        $sel_sql = "SELECT * FROM quiz WHERE question_id = '$_SESSION[question_number]'";
    }else{
        header('Location: index.php');
    }
    
    $run_sql = mysqli_query($conn, $sel_sql);
    $array = mysqli_fetch_array($run_sql);
    
    //If there is not more questions
    if(empty($array)){
        
        if($_SESSION['correct_answers'] >= (($_SESSION['question_number']-1)/2)){
            header('Location: win.php');
        }else{
            header('Location: loose.php');
        }
        header( "refresh:0;url=index.php" );
    }

    // If there was a post
    if(isset($_POST['submit'])){
        
        $_SESSION['question_number']++;
        $button_a = 'class="answer-a" disabled';
        $button_b = 'class="answer-b" disabled';
        $button_c = 'class="answer-c" disabled';
        $button_d = 'class="answer-d" disabled';
        
        if ($_POST['submit'] == $array['correct_answer']){
            $_SESSION['correct_answers']++;
        }
        
        switch($_POST['submit']){
            
            case 'a':
                if($array['correct_answer'] == 'a'){
                    $button_a = 'class="correct-a" disabled';
                }else{
                    $button_a = 'class="wrong-a" disabled';
                }
                break;
            case 'b':
                if($array['correct_answer'] == 'b'){
                    $button_b = 'class="correct-b" disabled';
                }else{
                    $button_b = 'class="wrong-b" disabled';
                }
                break;
            case 'c':
                 if($array['correct_answer'] == 'c'){
                    $button_c = 'class="correct-c" disabled';
                }else{
                    $button_c = 'class="wrong-c" disabled';
                }
                break;
            case 'd':
                 if($array['correct_answer'] == 'd'){
                    $button_d = 'class="correct-d" disabled';
                }else{
                    $button_d = 'class="wrong-d" disabled';
                }
                break;
        }
        
        header( "refresh:3;url=quiz.php?diff=$diff" );
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>VoxAtypi</title>
        
        <meta name="viewport" content="width=device.width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, miminum-scale=1.0">
		
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="quiz.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            
            <!-- Top elements -->
            <div class="row">
                <div class="col-md-4">
                    <div class="points">
                        <div class="center-text">
                            <?php echo $_SESSION['correct_answers']; ?>
                        </div>
                    </div>  
                </div>
                <div class="col-md-8">
                    <div class="question-number">
                        <div class="center-text">
                            <p> QUESTION <?php echo $array['question_id']; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Center elements -->
            <div class="row">
                <div class="question">
                    <?php echo $array['question_text']; ?>
                </div>
            </div>
            <div class="row">
                <div class="impact">
                    <img class="impact-img" src="img/<?php echo $diff.'/'.$array['question_id']; ?>.png">
                </div>
            </div>
            
            <!-- Bottom elements -->
            <div class="row">
                <div class="question-answers">
                    
                    <form class="form-horizontal" action="quiz.php?diff=easy" method="POST" role="form">
                        <div class="row">
                            <div class="col-sm-6">
                                <button <?php echo $button_a; ?> type="submit" name="submit" id="submit" value="a"><?php echo $array['answer_a']; ?></button>
                            </div>
                            <div class="col-sm-6">
                                <button <?php echo $button_b; ?> type="submit" name="submit" id="submit" value="b"><?php echo $array['answer_b']; ?></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button <?php echo $button_c; ?> type="submit" name="submit" id="submit" value="c"><?php echo $array['answer_c']; ?></button>
                            </div>
                            <div class="col-sm-6">
                                <button <?php echo $button_d; ?> type="submit" name="submit" id="submit" value="d"><?php echo $array['answer_d']; ?></button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </body>
</html>
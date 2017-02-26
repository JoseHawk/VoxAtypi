<?php session_start();

    $_SESSION['question_number']=0;
    $_SESSION['correct_answers']=0;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>VoxAtypi</title>
        
        <meta name="viewport" content="width=device.width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, miminum-scale=1.0">
		
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="index.css">
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 center-elements-left">
                    <a href="quiz.php?diff=easy"><img class="buttons" src="img/questions-gen-v2.png"></a>
                </div>
                <div class="col-md-6 center-elements-right">
                    <a href="quiz.php?diff=hard"><img class="buttons" src="img/questions-tech-v2.png"></a>
                </div>
            </div>
        </div>
    </body>
</html>

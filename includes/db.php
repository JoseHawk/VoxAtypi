<?php
    $server = 'localhost';
    $user = 'root';
    $password = 'admin';
    $db = 'VoxAtypi';

    $conn = mysqli_connect($server, $user, $password, $db);

    if(!$conn){
            die("Connection failed: ".mysqli_connect_error());
    }
?>
<?php
    session_start();
    include "../PHP/dbConnect.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM likes where post_id = '$id' & user_email = '{$_SESSION['userEmail']}'";
    $result = $connect->query($sql);
    if(mysqli_num_rows($result) == 0){
        $sql = "INSERT INTO likes (post_id, user_email) VALUES ('$id', '{$_SESSION['userEmail']}');";
        $connect->query($sql);
    }
    else{
        $sql = "DELETE FROM likes WHERE post_id = '$id' & user_email = '{$_SESSION['userEmail']}'";
        $connect->query($sql);

    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit; 
?>
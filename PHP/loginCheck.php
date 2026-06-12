<?php
    session_start();
    include "dbConnect.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    echo $email;
    echo $password;

    $sql = "SELECT password FROM user_ WHERE user_email='$email'";
    $result = $connect->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password'])){
            $_SESSION['userEmail'] = $email;
            unset($_SESSION['epError']);
            header("Location: ../Pages/dashboard.php");
            exit(); 
        } 
        else{
            $_SESSION['epError']= "Wrong Eamil or Password";
            header("Location: ../index.php");
            exit(); 
        }
    }
    else {
        $_SESSION['epError']= "Wrong Eamil or Password";
        header("Location: ../index.php");
        exit(); 
    }
   
?>
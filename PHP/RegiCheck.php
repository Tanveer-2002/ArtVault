<?php
    session_start();
    include "dbConnect.php";

    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_passowrd = $_POST["confirm_password"];
    $register_as = $_POST["register_as"];

    $_SESSION['email'] = $email;
    $_SESSION['password']= $password;
    $_SESSION['conPassword']= $confirm_passowrd;
    $_SESSION['type'] = $register_as;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['emailError']= "Invalid email";
        unset($_SESSION['passError']);
        unset($_SESSION['conPassError']);
        header("Location: ../Pages/Registration.php");
        exit(); 
    }
    
    $sql = "SELECT user_email FROM user_ WHERE user_email='$email'";
    $result = $connect->query($sql);
    
    if($result->num_rows > 0){
            $_SESSION['emailError']= "Account exist on this email";
            header("Location: ../Pages/Registration.php");
            unset($_SESSION['passError']);
            unset($_SESSION['conPassError']);
            exit();
    }

    if(strlen($password)< 6){
        $_SESSION['passError'] = 1;
        unset( $_SESSION['emailError']);
        unset($_SESSION['conPassError']);
        header("Location: ../Pages/Registration.php");
        exit();
    }

    if($password != $confirm_passowrd){
        $_SESSION['conPassError'] = 1;
        unset( $_SESSION['emailError']);
        unset($_SESSION['passError']);
        header("Location: ../Pages/Registration.php");
        exit(); 
    }
    
    $_SESSION['userEmail'] = $email;
    unset( $_SESSION['emailError']);
    unset($_SESSION['passError']);
    unset($_SESSION['conPassError']);
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    unset($_SESSION['conPassword']);
    unset($_SESSION['type']);
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $about_me="Not set";
    $full_name="Not set";
    $profile_img = "../Images/profileImages/defaultProfileImage.jpg";
    $user_name="Not set";

    $sql = "INSERT INTO user_ (user_email, password, user_name, profile_img_path, is_artist, full_name, about_me)
            VALUES
            ('$email','$hashed_password','$user_name', '$profile_img', '$register_as', '$full_name', '$about_me');"; 
    $connect->query($sql);

   

    header("Location: ../Pages/dashboard.php");
    exit(); 
?>
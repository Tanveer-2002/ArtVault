<?php
    session_start();
    include "dbConnect.php";
    $targetFolder = "../Images/postImages/";

    $title       = $_POST['artTitle'];
    $description = $_POST['artDescription'];
    $medium      = $_POST['artMedium'];
    $height      = $_POST['artHeight'];
    $width       = $_POST['artWidth'];
    $date        = $_POST['artDate'];
    $category    = $_POST['artCategory'];

    $cleanTitle = strtolower(trim($title));
    $cleanTitle = str_replace(" ", "-", $cleanTitle);
    $cleanTitle = preg_replace('/[^A-Za-z0-9\-]/', '', $cleanTitle);

    $extension = pathinfo($_FILES['artworkImage']['name'], PATHINFO_EXTENSION);
    $uniqueId = uniqid(); 

    // 4. Combine them into the final clean, non-duplicable filename
    $fileName = $cleanTitle . "_" . $uniqueId . "." . $extension;
    $targetFilePath = $targetFolder . $fileName;

    // Move the uploaded image to the images folder
    if (move_uploaded_file($_FILES['artworkImage']['tmp_name'], $targetFilePath)) {
     
        // Your query string matching your database columns exactly
        $sql= "INSERT INTO post (post_name, post_details, post_catagory, medium, height, width, post_img_path, user_email, created_at) 
        VALUES ('$title', '$description', '$category', '$medium', $height, $width, '$targetFilePath', '{$_SESSION['userEmail']}', '$date')";
        $connect->query($sql);
         
        header("Location: ../Pages/dashboard.php");
        exit(); 
        

    } else {
        echo "Error processing file upload.";
    }
?>
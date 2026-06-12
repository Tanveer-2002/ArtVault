<?php
session_start();
include "../PHP/dbConnect.php";

$userEmail = $_SESSION['userEmail'];

$query = "SELECT * FROM user_ WHERE user_email='$userEmail'";
$result = $connect->query($query);
$user = $result->fetch_assoc();

if(isset($_POST['update'])){

    $fullName = $_POST['full_name'];
    $userName = $_POST['user_name'];
    $email = $_POST['user_email'];
    $aboutMe = $_POST['about_me'];

    // Keep old image by default
    $profilePath = $user['profile_img_path'];

    // Upload new image if selected
    if(!empty($_FILES['profile_image']['name'])){

        $fileName = time() . "_" . $_FILES['profile_image']['name'];

        $targetPath = "../Images/ProfileImages/" . $fileName;

        if(move_uploaded_file(
            $_FILES['profile_image']['tmp_name'],
            $targetPath
        )){
            $profilePath = $targetPath;
        }
    }

    $updateQuery = "
    UPDATE user_
    SET
        full_name='$fullName',
        user_name='$userName',
        user_email='$email',
        about_me='$aboutMe',
        profile_img_path='$profilePath'
    WHERE user_email='$userEmail'
    ";

    if($connect->query($updateQuery)){
        $_SESSION['userEmail'] = $email;

        echo "
        <script>
            alert('Profile Updated Successfully');
            window.location.href='MyProfile.php';
        </script>";
    }
    else{
        echo $connect->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/EditProfile.css">
    <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
</head>
    <body>
        <nav>
            <div id="navBGimg"></div>
            <div id="navContent">
                <div id="search">
                    <div id="searchBox">
                        <input type="text" placeholder="Search Artworks and Artists...">
                        <div id="searchIcon" onclick="window.location.href='searchList.html'"></div>
                    </div>
                </div>
                <div id="profileInfo" onclick="window.location.href='MyProfile.html'">
                    <div id="profilePhoto"></div>
                    <div id="proInfo">
                        <span id="userName">M. Afnan</span>
                        <span id="userType">viwer</span>
                    </div>
                </div>
            </div>

        </nav>

        <main>
           <div id="sideBar">
              <div id="SBtitle">
                    <span>ART Valut</span>
                </div>
                <div id="SBcontent">
                    <div class="navOp"id ="dashboard" onclick="window.location.href='dashboard.php'">
                        <div class="opIcon" id="dashboardIcon"></div>
                        <div  class="opName" id="dashboardTitle">Dashboard</div>
                    </div>
                    <div class="navOp"id ="artgallery" onclick="window.location.href='artGallery.php'">
                        <div class="opIcon" id="artgalleryIcon"></div>
                        <div  class="opName" id="artgalleryTitle">Art Gallery</div>
                    </div>
                    <div class="navOp"id ="artcategory" onclick="window.location.href='ArtCatagory.php'">
                        <div class="opIcon" id="artcategoryIcon"></div>
                        <div  class="opName" id="artcategoryTitle">Art Category</div>
                    </div>
                    <div class="navOp"id ="artists"  onclick="window.location.href='artists.php'">
                        <div class="opIcon" id="artistsIcon"></div>
                        <div  class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp"id ="savedarts" onclick="window.location.href='SavedArtworks.php'">
                        <div class="opIcon" id="savedartsIcon"></div>
                        <div  class="opName" id="savedartsTitle">Saved Arts</div>
                    </div>
                    <div class="navOp"id ="myGallery" onclick="window.location.href='myGallery.php'">
                        <div class="opIcon" id="myGalleryIcon"></div>
                        <div  class="opName" id="myGalleryTitle">My Gallery</div>
                    </div>
                    <div class="navOp"id ="upload" onclick="window.location.href='UploadArt.php'">
                        <div class="opIcon" id="uploadIcon"></div>
                        <div  class="opName" id="uploadTitle">Upload</div>
                    </div>
                    <div class="navOp"id ="logout" onclick="window.location.href='../index.php'">
                        <div class="opIcon" id="logoutIcon"></div>
                        <div  class="opName" id="logoutTitle">Log out</div>
                    </div>
                </div>
           </div>

           <div class="content">

            <h1 class="page-title">Edit Profile</h1>
                <form action="" method="post" enctype="multipart/form-data">
                
                <div class="profile-header-card">

                    <div class="profile-info">

                        <div class="image-edit"> 
                            <div class="image"></div>
                            <input type="file" id="fileInput" name="profile_image" >
                       </div>

                     

                        <div class="profile-text">
                            <div class="name-row">
                                <input type="text" class="name-input" name="full_name" value="<?php echo $user['full_name']; ?>">
                                <span class="badge"><?php if($user['is_artist']==1) echo "Artist"; else echo "Viewer"; ?></span>
                            </div>
                            <p class="join-date">Join Date: March 2026</p>
                        </div>

                    </div>
                
                </div>

                <div class="profile-details-row">
                    <div class="details-card">
                        <div class="info-row">
                            <span class="info-label">Username :</span>
                            <input type="text" class="info-value" name="user_name" value="<?php echo $user['user_name']; ?>">
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email :</span>
                            <input type="text" class="info-value" name="user_email" value="<?php echo $user['user_email']; ?>">
                        </div>
                        <div class="info-row">
                            <span class="info-label">Location :</span>
                            <input type="text" class="info-value" value="Dhaka, Bangladesh">
                        </div>
                    </div>

                    <div class="aboutme">
                        <div class="about-me-edit">
                            <h3>About me:</h3>
                        </div>
                        <textarea name="about_me" id="" cols="100" rows="5" class="about-me-textarea"><?php echo $user['about_me']; ?></textarea>
                    </div>
                </div>

                <div class="bottom-row">
                    
                <div class="security">
            
                    <div class="form">
                         <h2>Security</h2>
                            <label for="">Current Password :</label>
                            <input type="text" class="password-input" name="current_password">

                            <label for="">New Password :</label>
                            <input type="text" class="password-input" name="new_password">

                            <label for="">Confirm Password :</label>
                            <input type="text" class="password-input" name="confirm_password">

                    </div>

                </div>
               </form> 

                <div class="Buttons">
                    <button class="button" id="update" name="update">Update</button>
                    <button class="button" id="discard">Discard</button>
                </div>

                </div>
            </div>
          
        </main>
    </body>
</html>

   
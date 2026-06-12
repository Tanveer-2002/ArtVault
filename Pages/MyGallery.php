<?php
    session_start();
    include "../PHP/dbConnect.php";

    $sql = "SELECT * FROM user_ WHERE user_email = '{$_SESSION['userEmail']}'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['userName'] = $row['user_name'];
    $_SESSION['type'] = $row['is_artist'];

    $query2 = "select * from post where user_email ='{$_SESSION['userEmail']}'";
    $result2 = $connect->query($query2);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>My Gallery</title>
        <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
        <link rel="stylesheet" href="../CSS/artGallery.css">
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
                <div id="profileInfo" onclick="window.location.href='MyProfile.php'">
                    <div id="profilePhoto"> <img src="<?php echo $row['profile_img_path']; ?>"></div>
                    <div id="proInfo">
                        <span id="userName"><?php echo $_SESSION['userName'] ; ?></span>
                        <span id="userType"><?php if($_SESSION['type']==1) echo "Artist"; else echo "Viewer"; ?></span>
                    </div>
                </div>
            </div>
        </nav>
        <main>
            <div id="sideBar">
                <div id="SBtitle">
                    <span>ART Vault</span>
                </div>
                <div id="SBcontent">
                    <div class="navOp" id="dashboard" onclick="window.location.href='dashboard.php'">
                        <div class="opIcon" id="dashboardIcon"></div>
                        <div class="opName" id="dashboardTitle">Dashboard</div>
                    </div>
                    <div class="navOp" id="artgallery" onclick="window.location.href='artGallery.php'">
                        <div class="opIcon" id="artgalleryIcon" ></div>
                        <div class="opName" id="artgalleryTitle">Art Gallery</div>
                    </div>
                    <div class="navOp" id="artcategory" onclick="window.location.href='ArtCatagory.html'">
                        <div class="opIcon" id="artcategoryIcon"></div>
                        <div class="opName" id="artcategoryTitle">Art Category</div>
                    </div>
                    <div class="navOp" id="artists" onclick="window.location.href='artists.html'">
                        <div class="opIcon" id="artistsIcon"></div>
                        <div class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp" id="savedarts" onclick="window.location.href='SavedArtworks.html'">
                        <div class="opIcon" id="savedartsIcon"></div>
                        <div class="opName" id="savedartsTitle">Saved Arts</div>
                    </div>
                    <?php
                    if ($row['is_artist'] == 1) {
                        echo <<<HTML
                    <div class="navOp" id="myGallery" style="background-color:white;color: black; border: 1px solid black;" onclick="window.location.href='MyGallery.html'">
                        <div class="opIcon" id="myGalleryIcon" style="background-image: url('../Images/system-images/myGalleryIconH.png');"></div>
                        <div class="opName" id="myGalleryTitle">My Gallery</div>
                    </div>

                    <div class="navOp" id="upload" onclick="window.location.href='UploadArt.html'">
                        <div class="opIcon" id="uploadIcon"></div>
                        <div class="opName" id="uploadTitle">Upload</div>
                    </div>
                    HTML;
                    }
                    ?>
                    <div class="navOp" id="logout" onclick="window.location.href='../index.php'">
                        <div class="opIcon" id="logoutIcon"></div>
                        <div class="opName" id="logoutTitle">Log out</div>
                    </div>
                </div>
            </div>
            <div id="mainContent">
                <div id="pageName" class="row">Art Gallery</div>
                <div id="pageContent" class="row">
                    <div id="postScroller">
                      <?php
                        while($posts = $result2 -> fetch_assoc()) { 
                            $current_post_id = $posts['post_id'];
                            $current_user_id = $_SESSION['userEmail']; 

                            $likeCheckSql = "SELECT * FROM likes WHERE post_id = '$current_post_id' AND user_email = '$current_user_id'";
                            $likeCheckResult = $connect->query($likeCheckSql);

                            $savedCheckSql = "SELECT * FROM saved_artworks WHERE post_id = '$current_post_id' AND user_email = '$current_user_id'";
                            $savedCheckResult = $connect->query($savedCheckSql);
                        ?>
                        <div class="imgCard">
                            <div class="up">
                                <img src="<?php echo $posts['post_img_path']; ?>" onclick="window.location.href='post.php?id=<?php echo $posts['post_id']; ?>'">
                            </div>
                             <div class="down">
                                <div class="artTitle"><?php echo $posts['post_name']; ?></div>
                                <div class="likeCmntSave">
                                    <div class="likeCmnt">
                                        <button class="like" style="background-image: url('<?php
                                            if (mysqli_num_rows($likeCheckResult) > 0) {
                                                echo '../Images/system-images/likeC.png';
                                            } else {
                                                echo '../Images/system-images/likeN.png';
                                            }
                                            ?>');"
                                            onclick="window.location.href='../PHP/likePost.php?id=<?php echo $posts['post_id']; ?>'">
                                        </button>
                                        <button class="cmnt" onclick="window.location.href='post.php?id=<?php echo $posts['post_id']; ?>'"></button>
                                    </div>
                                    <button class="save saveArt" style="background-image: url('<?php
                                        if (mysqli_num_rows($savedCheckResult) > 0) {
                                            echo '../Images/system-images/saved.png';
                                        } else {
                                            echo '../Images/system-images/unsaved.png';
                                        }
                                    ?>');"
                                    onclick="window.location.href='../PHP/updateSaved.php?id=<?php echo $posts['post_id']; ?>'">
                                    </button>
                                </div>
                            </div>
                         </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
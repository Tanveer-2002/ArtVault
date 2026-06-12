<?php
    session_start();
    include "../PHP/dbConnect.php";



    $query2 = "select * from post order by created_at desc";
    $result2 = $connect->query($query2);
   //$posts = $result2 -> fetch_assoc(); //fetch all posts in descending order of created_at

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ArtGallery</title>
        <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
        <link rel="stylesheet" href="../CSS/artGallery.css">
        
    </head>
    <body>
        <nav>
            <div id="navBGimg"></div>
            <did id="navContent">
                <div id="search">
                    <dvi id="searchBox">
                        <input type="text" placeholder="Search Artworks and Artists...">
                        <div id="searchIcon" onclick="window.location.href='searchList.html'"></div>
                    </dvi>
                </div>
                <div id="profileInfo" onclick="window.location.href='MyProfile.php'">
                    <div id="profilePhoto"></div>
                    <div id="proInfo">
                        <span id="userName"><?php echo $_SESSION['userName'] ; ?></span>
                        <span id="userType"><?php if($_SESSION['type']==1) echo "Artist"; else echo "Viwer"; ?></span>
                    </div>
                </div>
            </did>
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
                    <div class="navOp"id ="artgallery" style="background-color:white;color: black; border: 1px solid black;" onclick="window.location.href='artgallery.php'">
                        <div class="opIcon" id="artgalleryIcon" style="background-image: url('/Images/system-images/artgalleryIconH.png');"></div>
                        <div  class="opName" id="artgalleryTitle">Art Gallery</div>
                    </div>
                    <div class="navOp"id ="artcategory" onclick="window.location.href='ArtCatagory.html'">
                        <div class="opIcon" id="artcategoryIcon"></div>
                        <div  class="opName" id="artcategoryTitle">Art Category</div>
                    </div>
                    <div class="navOp"id ="artists" onclick="window.location.href='artists.html'">
                        <div class="opIcon" id="artistsIcon"></div>
                        <div  class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp"id ="savedarts" onclick="window.location.href='SavedArtworks.html'">
                        <div class="opIcon" id="savedartsIcon"></div>
                        <div  class="opName" id="savedartsTitle">Saved Arts</div>
                    </div>
                    <div class="navOp"id ="myGallery" onclick="window.location.href='ArtistArtGallery.html'">
                        <div class="opIcon" id="myGalleryIcon"></div>
                        <div  class="opName" id="myGalleryTitle">My Gallery</div>
                    </div>
                    <div class="navOp"id ="upload" onclick="window.location.href='UploadArt.html'">
                        <div class="opIcon" id="uploadIcon"></div>
                        <div  class="opName" id="uploadTitle">Upload</div>
                    </div>
                    <div class="navOp"id ="logout" onclick="window.location.href='../index.html'">
                        <div class="opIcon" id="logoutIcon"></div>
                        <div  class="opName" id="logoutTitle">Log out</div>
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
                            $current_user_id = $_SESSION['userEmail']; // pulled from your active $row data

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
                                        <button class="like"style="background-image: url('<?php
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
                                    <button class="save"class="saveArt" style="background-image: url('<?php
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
                        <?php }
                       ?>
    
                        
                    </div>
                </div>
                
            </div>
        </main>
        <script>
        const user = {role: "viewer"};
            if(user.role == "viewer"){
                document.getElementById("upload").style.display = "none";
                document.getElementById("myGallery").style.display = "none";
            }
            else if(user.role == 'artist'){
                document.getElementById("userType").innerText = "Artist";

            }
        </script>
    </body>
</html>
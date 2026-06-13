<?php
    session_start();
    include "../PHP/dbConnect.php";

    $sql = "SELECT * FROM user_ WHERE user_email = '{$_SESSION['userEmail']}'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['userName'] = $row['user_name'];
    $_SESSION['type'] = $row['is_artist'];

    $id = $_GET['id'];
    $sql= "select * from post where post_id = '$id'";
    $result = $connect->query($sql);
    $post = $result -> fetch_assoc();
    $postOwnerEmail= $post['user_email'];
    $sql = "SELECT * FROM user_ WHERE user_email = '{$postOwnerEmail}'";
    $result = $connect->query($sql);
    $owner = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>post</title>
        <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
        <link rel="stylesheet" href="../CSS/post.css">
        
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
                        <span id="userType"><?php if($_SESSION['type']==1) echo "Artist"; else echo "Viwer"; ?></span>
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
                    <?php
                    if ($row['is_artist'] == 1) {
                        echo <<<HTML
                    <div class="navOp" id="myGallery" onclick="window.location.href='MyGallery.php'">
                        <div class="opIcon" id="myGalleryIcon"></div>
                        <div class="opName" id="myGalleryTitle">My Gallery</div>
                    </div>

                    <div class="navOp" id="upload" onclick="window.location.href='UploadArt.php'">
                        <div class="opIcon" id="uploadIcon"></div>
                        <div class="opName" id="uploadTitle">Upload</div>
                    </div>
                    HTML;
                    }
                    ?>
                    <div class="navOp"id ="logout" onclick="window.location.href='../index.php'">
                        <div class="opIcon" id="logoutIcon"></div>
                        <div  class="opName" id="logoutTitle">Log out</div>
                    </div>
                    
                </div>
            </div>
            <div id="mainContent">
                <div id="left">
                    <div id="lr1">
                        <div id="postTitle"><?php echo $post['post_name']; ?></div>
                        <div id="postArtist">
                            <div id="artistPhoto" style="background-image: url('<?php echo $owner['profile_img_path'];?>');"></div>
                            <div id="artistName">
                                <span><?php echo $owner['full_name'];?></span>Artist
                            </div>
                        </div>
                    </div>
                    <div id="lr2">
                        <img src="<?php echo $post['post_img_path']?>" id="postImg">
                        <div id="LSZbox">
                            <button id="likeB"></button>
                            <button id="saveB"></button>
                            <button id="zoomB"></button>
                        </div>
                    </div>
                    <div id="lr3">
                        <h3><b>Details:</b></h3>
                        <p><?php echo $post['post_details'];?></p>
                    </div>
                </div>
                <div id="right">
                    <div id="rr1">
                        <div id="rr1l">
                            <h3><b>Category</b></h3>
                            <p><?php echo $post['post_catagory'];?></p>
                            <h3><b>Date Created</b></h3>
                            <p><?php echo date("F j, Y", strtotime($post['created_at'])); ?></p>
                            <h3><b>Dimensions</b></h3>
                            <p><?php echo $post['height'];?> X <?php echo $post['width'];?>cm</p>
                        </div>
                        <div id="rr1r">
                            <h3><b>Medium</b></h3>
                            <p><?php echo $post['medium'];?></p>
                        </div>
                    </div>
                        
                    <div id="rr2">
                        <h2><b>Comments:</b></h2>
                        <div id="commentBox">
                            <div class="comment">
                                <div class="up">
                                    <div class="commneterInfo">
                                        <div class="commenterImg"></div>
                                        <div class="commenterName">M.Afnan</div>
                                    </div>
                                    <div class="commentTime">
                                        sent 2hrs. ago
                                    </div>
                                </div>
                                <div class="down">Awesome Art</div>
                            </div>

                        </div>
                        <div id="commentInput">
                            <input type="text" name="comment" id="cmnt">
                            <button id="sentBtn"></button>
                        </div>
                    </div>
                </div>
                
            </div>
        </main>
        
    </body>
    <script>
            let zoomButton = document.getElementById("zoomB");
            let postImage = document.getElementById("postImg");

            zoomButton.onclick=fullscreenImage;

            function fullscreenImage() {
                postImage.requestFullscreen();
            }
    </script>
</html>
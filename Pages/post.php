<?php
    session_start();
    include "../PHP/dbConnect.php";

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
                        <div id="searchIcon"></div>
                    </div>
                </div>
                <div id="profileInfo">
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
                    <div class="navOp"id ="dashboard">
                        <div class="opIcon" id="dashboardIcon"></div>
                        <div  class="opName" id="dashboardTitle">Dashboard</div>
                    </div>
                    <div class="navOp"id ="artgallery">
                        <div class="opIcon" id="artgalleryIcon"></div>
                        <div  class="opName" id="artgalleryTitle">Art Gallery</div>
                    </div>
                    <div class="navOp"id ="artcategory">
                        <div class="opIcon" id="artcategoryIcon"></div>
                        <div  class="opName" id="artcategoryTitle">Art Category</div>
                    </div>
                    <div class="navOp"id ="artists">
                        <div class="opIcon" id="artistsIcon"></div>
                        <div  class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp"id ="savedarts">
                        <div class="opIcon" id="savedartsIcon"></div>
                        <div  class="opName" id="savedartsTitle">Saved Arts</div>
                    </div>
                    <div class="navOp"id ="logout">
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
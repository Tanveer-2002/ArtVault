<?php
    session_start();
    include "../PHP/dbConnect.php";

    $sql = "SELECT * FROM user_ WHERE user_email = '{$_SESSION['userEmail']}'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['userName'] = $row['user_name'];
    $_SESSION['type'] = $row['is_artist'];

    $query2 = "select * from post order by created_at desc LIMIT 10;";
    $result2 = $connect->query($query2);

    
   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
        <link rel="stylesheet" href="../CSS/dashboard.css">
        
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
                    <div class="navOp"id ="dashboard" style="background-color:white;color: black; border: 1px solid black;" onclick="window.location.href='dashboard.php'">
                        <div class="opIcon" id="dashboardIcon" style="background-image: url('../Images/system-images/dashIconH.png');"></div>
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
                <div class= "row" id="row1">
                    <div id="greeting">Welcome, <?php echo $row['full_name'];?></div>
                    <div id="pageInfoAndButton">
                        <div id="pageInfo">
                            <div id="boxName">Art Feed</div>
                            <div id="artType">Recent Arts</div>
                        </div>
                        <div id="artWorkButton">
                            <button id="b1" onclick="window.location.href='artGallery.html'">View All Art work</button>
                        </div>
                    </div>
                </div>
                <div class= "row" id="row2">
                    <?php
                    // ... Your existing session_start, dbConnect, and $result2 query logic remains at the top ...

                    while($posts = $result2->fetch_assoc()) { 
                        $current_post_id = $posts['post_id'];
                        $current_user_id = $_SESSION['userEmail']; // pulled from your active $row data

                        $likeCheckSql = "SELECT * FROM likes WHERE post_id = '$current_post_id' AND user_email = '$current_user_id'";
                        $likeCheckResult = $connect->query($likeCheckSql);

                        $savedCheckSql = "SELECT * FROM saved_artworks WHERE post_id = '$current_post_id' AND user_email = '$current_user_id'";
                        $savedCheckResult = $connect->query($savedCheckSql);
                        
                    ?>
                    <div class="imgCard">
                        <div class="cUp" style="background-image: url('<?php echo $posts['post_img_path'] ?>');" onclick="window.location.href='post.php?id=<?php echo $posts['post_id']; ?>'"></div>
                        <div class="cDown">
                            <div class="likeCmt"> 
                                <div class="like"
                                    style="background-image: url('<?php
                                        if (mysqli_num_rows($likeCheckResult) > 0) {
                                            echo '../Images/system-images/likeC.png';
                                        } else {
                                            echo '../Images/system-images/likeN.png';
                                        }
                                    ?>');"
                                    onclick="window.location.href='../PHP/likePost.php?id=<?php echo $posts['post_id']; ?>'">
                                </div>
                            <div class="cmt" onclick="window.location.href='post.php?id=<?php echo $posts['post_id']; ?>'"></div>
                            </div>
                            <div class="saveArt" style="background-image: url('<?php
                                        if (mysqli_num_rows($savedCheckResult) > 0) {
                                            echo '../Images/system-images/saved.png';
                                        } else {
                                            echo '../Images/system-images/unsaved.png';
                                        }
                                    ?>');"
                                    onclick="window.location.href='../PHP/updateSaved.php?id=<?php echo $posts['post_id']; ?>'">
                                </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
                <div class= "row" id="row3">
                    <div class="r3box">
                        <div id="r3box1Up">Top Artists This Week</div>
                        <div id="r3box1Down">
                            <div class="topArtistCard">
                                <div class="topArtistPhoto"></div>
                                <div class="topArtistName">
                                    D. lio<br>
                                    <span>Total Likes: 9k</span>
                                    <button>View Profile</button>
                                </div>
                            </div>
                            <div class="topArtistCard">
                                <div class="topArtistPhoto"></div>
                                <div class="topArtistName">
                                    D. lio<br>
                                    <span>Total Likes: 9k</span>
                                    <button>View Profile</button>
                                </div>
                            </div>
                            <div class="topArtistCard">
                                <div class="topArtistPhoto"></div>
                                <div class="topArtistName">
                                    D. lio<br>
                                    <span>Total Likes: 9k</span>
                                    <button>View Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="r3box">
                        <div id="r3box1Up">Top 3 Art Works This Week</div>
                        <div id="r3box2Down">
                            <div class="topArtWorkCard">
                                <div class="topArt"></div>
                                <div class="topArtLike">
                                    <img src="../Images/system-images/likeC.png">
                                    <span>9K</span>
                                </div>
                            </div>
                            <div class="topArtWorkCard">
                                <div class="topArt" style="background-image: url('../Images/postImages/postDemo3.png');"></div>
                                <div class="topArtLike">
                                    <img src="/Images/system-images/likeC.png">
                                    <span>8K</span>
                                </div>
                            </div>
                            <div class="topArtWorkCard">
                                <div class="topArt" style="background-image: url('../Images/postImages/postDemo1.png');"></div>
                                <div class="topArtLike">
                                    <img src="/Images/system-images/likeC.png">
                                    <span>5K</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>
        <script>
           function toggleLike(element) {
            const postId = element.getAttribute('data-postid');
            const isLiked = element.classList.contains('liked');
            
            // 1. Optimistic UI Update: Flip states instantly for perceived speed
            element.classList.toggle('liked');
            if (isLiked) {
                element.style.backgroundImage = "url('../Images/system-images/likeN.png')";
            } else {
                element.style.backgroundImage = "url('../Images/system-images/likeC.png')";
            }

            // 2. Dispatch background request to mutations handler
            fetch('../PHP/likePost.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `post_id=${postId}`
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    // 3. Rollback UI if database processing yields an error
                    fallbackUI(element, isLiked);
                    alert(data.message || "Could not update like status.");
                }
            })
            .catch(error => {
                console.error('Network Error:', error);
                // Fallback UI if client experiences sudden disconnects
                fallbackUI(element, isLiked);
            });
        }

        // Separate helper utility to manage clean state mutations
        function fallbackUI(element, wasLiked) {
            if (wasLiked) {
                element.classList.add('liked');
                element.style.backgroundImage = "url('../Images/system-images/likeC.png')";
            } else {
                element.classList.remove('liked');
                element.style.backgroundImage = "url('../Images/system-images/likeN.png')";
            }
        }
        </script>
    </body>
</html>
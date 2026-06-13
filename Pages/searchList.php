<?php
    session_start();
    include "../PHP/dbConnect.php";

    // Logged in user
    $userEmail = $_SESSION['userEmail'];

    $query1 = "SELECT * FROM user_ WHERE user_email='$userEmail'";
    $result1 = $connect->query($query1);
    $user = $result1->fetch_assoc();

    $search = "";

    if(isset($_GET['val'])){
        $search = trim($_GET['val']);
    }

    /* Search Artists */
    $artistQuery = "
    SELECT *
    FROM user_
    WHERE is_artist = 1
    AND (
    user_name LIKE '%$search%'
    OR full_name LIKE '%$search%'
  )";

    $artistResult = $connect->query($artistQuery);

    /* Search Artworks */
    $artworkQuery = "
    SELECT *
    FROM post
    WHERE post_name LIKE '%$search%'
    ";

    $artworkResult = $connect->query($artworkQuery);
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>artists</title>
        <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
        <link rel="stylesheet" href="../CSS/artists.css">
        <link rel="stylesheet" href="../CSS/SavedArtworks.css">
        
    </head>
    <body>
        <nav>
            <div id="navBGimg"></div>
            <div id="navContent">
                <div id="search">
                  <div id="searchBox">
                     <input type="text" name="val" placeholder="Search Artworks and Artists...">
                    <div id="searchIcon" onclick="searchData()"></div>
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
                    <div class="navOp"id ="artgallery" onclick="window.location.href='artgallery.php'">
                        <div class="opIcon" id="artgalleryIcon"></div>
                        <div  class="opName" id="artgalleryTitle">Art Gallery</div>
                    </div>
                    <div class="navOp"id ="artcategory" onclick="window.location.href='ArtCatagory.php'">
                        <div class="opIcon" id="artcategoryIcon"></div>
                        <div  class="opName" id="artcategoryTitle">Art Category</div>
                    </div>
                    <div class="navOp"id ="artists"  onclick="window.location.href='artists.php'" style="background-color:white;color: black; border: 1px solid black;">
                        <div class="opIcon" id="artistsIcon"  style="background-image: url('/Images/system-images/artistsIconH.png');"></div>
                        <div  class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp"id ="savedarts" onclick="window.location.href='SavedArtworks.php'">
                        <div class="opIcon" id="savedartsIcon"></div>
                        <div  class="opName" id="savedartsTitle">Saved Arts</div>
                    </div>
                    <div class="navOp"id ="myGallery" onclick="window.location.href='ArtistArtGallery.php'">
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
            <div id="mainContent">
                <div id="pageName">
                    Search results for "<?php echo htmlspecialchars($search); ?>"
                </div>

              <?php if($artistResult->num_rows > 0){ ?>
                
                <div id="searchResult">
                   <?php while($artist = $artistResult->fetch_assoc()){ ?> 
                    <div id="r1">
                        <div class="rimg" style="background-image: url('../Images/profileImages/leo.png');"></div>
                        <div class="rTitle">
                             Name: <?php echo $artist['user_name']; ?>
                            <button onclick="window.location.href='ArtistProfile.php?user_email=<?php echo $artist['user_email']; ?>'"> View Profile</button>
                        </div>

                    </div>
                    <?php } ?>

                </div>
                <?php } ?>

                <?php if($artworkResult->num_rows > 0){ ?>
                
                 <div id="pageContent" class="row">

                    <div id="postScroller">
                      <?php
                        while($posts = $artworkResult -> fetch_assoc()) { ?>
                        <div class="imgCard">
                            <div class="up">
                                <img src="<?php echo $posts['post_img_path']; ?>" onclick="window.location.href='post.php?id=<?php echo $posts['post_id']; ?>'">
                            </div>
                             <div class="down">
                                <div class="artTitle"><?php echo $posts['post_name']; ?></div>
                                <div class="likeCmntSave">
                                    <div class="likeCmnt">
                                        <button class="like"></button>
                                        <button class="cmnt" onclick="window.location.href='post.php?id=<?php echo $posts['post_id']; ?>'"  ></button>

                                    </div>
                                    <button class="save"></button>
                                </div>
                            </div>
                         </div>
                        <?php }
                       ?>    
                        
                    </div>
                </div>
                 <?php } ?>


                
                        
                    
                
            </div>
        </main>
    </body>
</html>

<script>
function searchData() {
    let value = document.querySelector('input[name=\"val\"]').value;
    window.location.href = "searchList.php?val=" + encodeURIComponent(value);
}
</script>
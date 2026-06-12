<?php
session_start();
include "../PHP/dbConnect.php";

if(!isset($_GET['category'])){
    die("Category not selected");
}

$category = $_GET['category'];

$query = "
SELECT *
FROM post
WHERE post_catagory = '$category'
ORDER BY created_at DESC
";

$result = $connect->query($query);

if(!$result){
    die("Query Failed: " . $connect->error);
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
        <link rel="stylesheet" href="../CSS/ArtistArtGallery.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="../CSS/realism.css">
        
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
                        <span id="userName">M. Afnan</span>
                        <span id="userType">viwer</span>
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
                    <div class="navOp"id ="dashboard" onclick="window.location.href='dashboard.html'">
                        <div class="opIcon" id="dashboardIcon"></div>
                        <div  class="opName" id="dashboardTitle">Dashboard</div>
                    </div>
                    <div class="navOp"id ="artgallery" onclick="window.location.href='artGallery.html'">
                        <div class="opIcon" id="artgalleryIcon"></div>
                        <div  class="opName" id="artgalleryTitle">Art Gallery</div>
                    </div>
                    <div class="navOp"id ="artcategory" onclick="window.location.href='ArtCatagory.html'">
                        <div class="opIcon" id="artcategoryIcon"></div>
                        <div  class="opName" id="artcategoryTitle">Art Category</div>
                    </div>
                    <div class="navOp"id ="artists"  onclick="window.location.href='artists.html'">
                        <div class="opIcon" id="artistsIcon"></div>
                        <div  class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp"id ="savedarts" onclick="window.location.href='SavedArtworks.html'">
                        <div class="opIcon" id="savedartsIcon"></div>
                        <div  class="opName" id="savedartsTitle">Saved Arts</div>
                    </div>
                    <div class="navOp"id ="myGallery">
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
                <div id="pageName" class="row"><?php echo $category; ?></div>
                <div id="pageContent" class="row">

                    <div id="postScroller">
                      <?php
                        while($posts = $result -> fetch_assoc()) { ?>
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
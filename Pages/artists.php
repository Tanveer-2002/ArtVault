<?php
session_start();
include "../PHP/dbConnect.php";

// Logged in user
$userEmail = $_SESSION['userEmail'];

$query1 = "SELECT * FROM user_ WHERE user_email='$userEmail'";
$result1 = $connect->query($query1);
$user = $result1->fetch_assoc();

// Fetch all artists
$query2 = "SELECT * FROM user_ WHERE is_artist = 1";
$result2 = $connect->query($query2);
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>artists</title>
        <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
        <link rel="stylesheet" href="../CSS/artists.css">
        
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
                    <div class="navOp"id ="dashboard" onclick="window.location.href='dashboard.html'">
                        <div class="opIcon" id="dashboardIcon"></div>
                        <div  class="opName" id="dashboardTitle">Dashboard</div>
                    </div>
                    <div class="navOp"id ="artgallery" onclick="window.location.href='artgallery.html'">
                        <div class="opIcon" id="artgalleryIcon"></div>
                        <div  class="opName" id="artgalleryTitle">Art Gallery</div>
                    </div>
                    <div class="navOp"id ="artcategory" onclick="window.location.href='ArtCatagory.html'">
                        <div class="opIcon" id="artcategoryIcon"></div>
                        <div  class="opName" id="artcategoryTitle">Art Category</div>
                    </div>
                    <div class="navOp"id ="artists"  onclick="window.location.href='artists.html'" style="background-color:white;color: black; border: 1px solid black;">
                        <div class="opIcon" id="artistsIcon"  style="background-image: url('/Images/system-images/artistsIconH.png');"></div>
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
                <div id="pageName">
                    Artists
                </div>
                                   
                <div id="searchResult">
                   <?php while($artist = $result2->fetch_assoc()){ ?> 
                    <div id="r1">
                        <div class="rimg" style="background-image: url('../Images/profileImages/leo.png');"></div>
                        <div class="rTitle">
                             Name: <?php echo $artist['user_name']; ?>
                            <button onclick="window.location.href='ArtistProfile.php?user_email=<?php echo $artist['user_email']; ?>'"> View Profile</button>
                        </div>

                    </div>
                    <?php } ?>
                    <!-- <div id="r2">
                        <div class="rimg" style="background-image: url('../Images/profileImages/demoprofileImage.png');"></div>
                        <div class="rTitle">
                            Nae: Mafnan
                            <button>View Profile</button>
                        </div>

                    </div> -->

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
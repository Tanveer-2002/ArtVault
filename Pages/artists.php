<?php
session_start();
include "../PHP/dbConnect.php";

// Safety check: Redirect to index if session does not exist
if (!isset($_SESSION['userEmail'])) {
    header("Location: ../index.php");
    exit();
}

$sql = "SELECT * FROM user_ WHERE user_email = '{$_SESSION['userEmail']}'";
$result = $connect->query($sql);
$row = $result->fetch_assoc();
$_SESSION['userName'] = $row['user_name'];
$_SESSION['type'] = $row['is_artist'];

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
                <div id="profileInfo" onclick="window.location.href='MyProfile.php'">
                    <div id="profilePhoto"> <img src="<?php echo $row['profile_img_path']; ?>" alt="Profile Photo"></div>
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
                        <div class="opIcon" id="artgalleryIcon"></div>
                        <div class="opName" id="artgalleryTitle">Art Gallery</div>
                    </div>
                    <div class="navOp" id="artcategory" onclick="window.location.href='ArtCatagory.php'">
                        <div class="opIcon" id="artcategoryIcon"></div>
                        <div class="opName" id="artcategoryTitle">Art Category</div>
                    </div>
                    <div class="navOp" id="artists" onclick="window.location.href='artists.php'" style="background-color:white;color: black; border: 1px solid black;">
                        <div class="opIcon" id="artistsIcon" style="background-image: url('../Images/system-images/artistsIconH.png');"></div>
                        <div class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp" id="savedarts" onclick="window.location.href='SavedArtworks.php'">
                        <div class="opIcon" id="savedartsIcon"></div>
                        <div class="opName" id="savedartsTitle">Saved Arts</div>
                    </div>
                    <?php
                    if ($_SESSION['type'] == 1) {
                        echo <<<HTML
                    <div class="navOp" id="myGallery" onclick="window.location.href='ArtistArtGallery.php'">
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
                    <div class="navOp" id="logout" onclick="window.location.href='../index.php'">
                        <div class="opIcon" id="logoutIcon"></div>
                        <div class="opName" id="logoutTitle">Log out</div>
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
                        <div class="rimg" style="background-image: url('<?php echo $artist['profile_img_path']; ?>');"></div>
                        <div class="rTitle">
                             Name: <?php echo $artist['user_name']; ?>
                            <button onclick="window.location.href='ArtistProfile.php?user_email=<?php echo $artist['user_email']; ?>'"> View Profile</button>
                        </div>

                    </div>
                    <?php } ?>
                    </div>
                
                        
                    
                
            </div>
        </main>
    </body>
</html>
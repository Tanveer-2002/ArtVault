<?php
    session_start();
    include "../PHP/dbConnect.php";

    $query1 = "SELECT * FROM user_ WHERE user_email = '{$_SESSION['userEmail']}'";
    $result1 = $connect->query($query1);
    $user = $result1->fetch_assoc();

    $query2 = "SELECT p.* FROM post p JOIN saved_artworks sa ON p.post_id = sa.post_id WHERE sa.user_email = '{$_SESSION['userEmail']}' LIMIT 3";
    $result2 = $connect->query($query2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="../CSS/MyProfile.css">
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
                <div id="profileInfo" onclick="window.location.href='MyProfile.php'">
                    <div id="profilePhoto"> <img src="<?php echo $user['profile_img_path']; ?>"> </div>
                    <div id="proInfo">
                        <span id="userName"><?php echo $user['full_name']; ?> </span>
                        <span id="userType"><?php if($user['is_artist']==1) echo "Artist"; else echo "Viewer"; ?> </span>
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
                    <div class="navOp" id="artists" onclick="window.location.href='artists.php'">
                        <div class="opIcon" id="artistsIcon"></div>
                        <div class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp" id="savedarts" onclick="window.location.href='SavedArtworks.php'">
                        <div class="opIcon" id="savedartsIcon"></div>
                        <div class="opName" id="savedartsTitle">Saved Arts</div>
                    </div>
                    <?php
                    if ($user['is_artist'] == 1) {
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

            <div class="content">
                <h1 class="page-title">My Profile</h1>
                
                <div class="profile-header-card">
                    <div class="profile-info">
                        <div class="image">
                            <img src="<?php echo $user['profile_img_path']; ?>" alt="Profile Image">
                        </div>
                        <div class="profile-text">
                            <div class="name-row">
                                <?php echo $user['full_name']; ?>
                                <span class="badge"><?php echo $user['is_artist'] == 1 ? 'Artist' : 'Viewer'; ?></span>
                            </div>
                            <p class="join-date">Join Date: <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
                        </div>
                    </div>
                    <button class="account-settings-btn" onclick="window.location.href='EditProfile.php'">
                        Account Settings
                    </button>
                </div>

                <div class="profile-details-row">
                    <div class="details-card">
                        <div class="info-row">
                            <span class="info-label">Username :</span>
                            <span class="info-value"><?php echo $user['user_name']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email :</span>
                            <span class="info-value"><?php echo $user['user_email']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Location :</span>
                            <span class="info-value">Dhaka, Bangladesh</span>
                        </div>
                    </div>

                    <div class="aboutme">
                        <h3>About me:</h3>
                        <p><?php echo $user['about_me']; ?></p>
                    </div>
                </div>

                <div class="collection-section">
                    <div class="collection-header">
                        <h2>My Collection</h2>
                        <button class="view-all-btn" onclick="window.location.href='SavedArtworks.php'">View All</button>
                    </div>  

                    <div class="collection-grid">
                      <?php
                        while($posts = $result2->fetch_assoc()) { ?>
                            <div class="art-card">
                                <div class="art-image">
                                    <img src="<?php echo $posts['post_img_path']; ?>" alt="Art Image">
                                </div>
                                <p class="art-title"><?php echo $posts['post_name']; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
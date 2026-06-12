<?php
    session_start();
    include "../PHP/dbConnect.php";

    // 1. Fetch current active session user info for Nav and Sidebar
    $sqlUser = "SELECT * FROM user_ WHERE user_email = '{$_SESSION['userEmail']}'";
    $resUser = $connect->query($sqlUser);
    $row = $resUser->fetch_assoc();
    $_SESSION['userName'] = $row['user_name'];
    $_SESSION['type'] = $row['is_artist'];

    // 2. Capture the search parameter securely (defaults to empty string if not passed yet)
    $searchQuery = isset($_GET['query']) ? mysqli_real_escape_string($connect, $_GET['query']) : '';

    // 3. Query Database for Artists matching name/username
    $artistResult = [];
    if (!empty($searchQuery)) {
        $artistSql = "SELECT * FROM user_ WHERE (full_name LIKE '%$searchQuery%' OR user_name LIKE '%$searchQuery%') AND is_artist = 1";
        $artistResult = $connect->query($artistSql);
    }

    // 4. Query Database for Artworks matching title/category
    $postResult = [];
    if (!empty($searchQuery)) {
        $postSql = "SELECT * FROM post WHERE post_name LIKE '%$searchQuery%' OR post_catagory LIKE '%$searchQuery%'";
        $postResult = $connect->query($postSql);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>searchResult</title>
    <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
    <link rel="stylesheet" href="../CSS/searchList.css">
</head>

<body>
    <nav>
        <div id="navBGimg"></div>
        <div id="navContent">
            <div id="search">
                <div id="searchBox">
                    <input type="text" id="globalSearchInput" placeholder="Search Artworks and Artists..." value="<?php echo htmlspecialchars($searchQuery); ?>" onkeypress="if(event.key === 'Enter') executeSearch();">
                    <div id="searchIcon" onclick="executeSearch()"></div>
                </div>
            </div>
            <div id="profileInfo" onclick="window.location.href='MyProfile.php'">
                <div id="profilePhoto"><img src="<?php echo $row['profile_img_path']; ?>" style="width:100%; height:100%; border-radius:50%; object-fit:cover;"></div>
                <div id="proInfo">
                    <span id="userName"><?php echo htmlspecialchars($_SESSION['userName']); ?></span>
                    <span id="userType"><?php if($_SESSION['type'] == 1) echo "Artist"; else echo "Viewer"; ?></span>
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
                Search Result for: <?php echo !empty($searchQuery) ? htmlspecialchars($searchQuery) : 'None'; ?>
                <div class="dropdown-container">

                    <button class="main-btn" id="mainBtn">
                        Browse Options
                        <span>V</span>
                    </button>

                    <div class="dropdown-menu" id="dropdownMenu">

                        <div class="menu-item">
                            <button class="submenu-btn">
                                Artist
                                <span>+</span>
                            </button>

                            <div class="submenu">
                                <a href="#">Taylor Swift</a>
                                <a href="#">Ed Sheeran</a>
                                <a href="#">Bruno Mars</a>
                                <a href="#">The Weeknd</a>
                            </div>
                        </div>

                        <div class="menu-item">
                            <button class="submenu-btn">
                                Category
                                <span>+</span>
                            </button>

                            <div class="submenu">
                                <a href="#">Pop</a>
                                <a href="#">Rock</a>
                                <a href="#">Hip Hop</a>
                                <a href="#">Jazz</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div id="searchResult">
                <?php 
                if (!empty($artistResult) && $artistResult->num_rows > 0) {
                    while($artist = $artistResult->fetch_assoc()) {
                ?>
                    <div id="r1">
                        <div class="rimg" style="background-image: url('<?php echo $artist['profile_img_path']; ?>');"></div>
                        <div class="rTitle">
                            Name : <?php echo htmlspecialchars($artist['full_name']); ?>
                            <button onclick="window.location.href='artists.php?email=<?php echo urlencode($artist['user_email']); ?>'">View Profile</button>
                        </div>
                    </div>
                <?php 
                    }
                } 
                ?>

                <?php 
                if (!empty($postResult) && $postResult->num_rows > 0) {
                    while($postItem = $postResult->fetch_assoc()) {
                ?>
                    <div id="r2">
                        <div class="rimg" style="background-image: url('<?php echo $postItem['post_img_path']; ?>');"></div>
                        <div class="rTitle">
                            Title : <?php echo htmlspecialchars($postItem['post_name']); ?>
                            <button onclick="window.location.href='post.php?id=<?php echo $postItem['post_id']; ?>'">View post</button>
                        </div>
                    </div>
                <?php 
                    }
                } 
                ?>

                <?php if (!empty($searchQuery) && $artistResult->num_rows == 0 && $postResult->num_rows == 0) { ?>
                    <div style="padding: 20px; font-size: 16px; color: gray;">No entries match your search query.</div>
                <?php } ?>
            </div>
        </div>
    </main>

    <script>
        // JS routine to collect text values and trigger search updates via URL variables
        function executeSearch() {
            const queryValue = document.getElementById('globalSearchInput').value.trim();
            window.location.href = 'searchList.php?query=' + encodeURIComponent(queryValue);
        }
    </script>
    <script src="../JS/searchList.js"></script>
</body>

</html>
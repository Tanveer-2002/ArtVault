<?php
    session_start();
    include "../PHP/dbConnect.php";

    // Fetch user details from database using the session email
    $sql = "SELECT * FROM user_ WHERE user_email = '{$_SESSION['userEmail']}'";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();
    $_SESSION['userName'] = $row['user_name'];
    $_SESSION['type'] = $row['is_artist'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Upload Artwork</title>
        <link rel="stylesheet" href="../CSS/topbar_and_sidebar.css">
        <link rel="stylesheet" href="../CSS/UploadArt.css">
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
                    <div id="profilePhoto"> <img src="<?php echo $row['profile_img_path']; ?>"> </div>
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
                    <div class="navOp" id="artists" onclick="window.location.href='artists.php'">
                        <div class="opIcon" id="artistsIcon"></div>
                        <div class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp" id="savedarts" onclick="window.location.href='SavedArtworks.php'">
                        <div class="opIcon" id="savedartsIcon"></div>
                        <div class="opName" id="savedartsTitle">Saved Arts</div>
                    </div>
                    <?php
                    if ($row['is_artist'] == 1) {
                        echo <<<HTML
                    <div class="navOp" id="myGallery" onclick="window.location.href='ArtistArtGallery.php'">
                        <div class="opIcon" id="myGalleryIcon"></div>
                        <div class="opName" id="myGalleryTitle">My Gallery</div>
                    </div>

                    <div class="navOp" id="upload" onclick="window.location.href='UploadArt.php'" style="background-color:white;color: black; border: 1px solid black;">
                        <div class="opIcon" id="uploadIcon" style="background-image: url('../Images/system-images/uploadIconH.png');"></div>
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

            <form class="mainContent" action="../PHP/postUp.php" method="POST" enctype="multipart/form-data">
                <div class="heading">
                    <h1>Upload New Artwork</h1>
                </div>
                
                <div class="dragSection">
                    <div class="dragContainer">
                        
                        <input type="file" id="fileInput" name="artworkImage" accept="image/jpeg, image/png" style="display: none;" required>
                        
                        <div id="uploadDefaultState">
                            <div class="upIcon" id="cloudIcon" style="cursor: pointer;"></div>
                            <p>
                                Click on the icon to upload artwork Image (JPG, PNG).<br>
                                <span>Ensure your art work is high-resolution For best presentation</span>
                            </p>
                        </div>

                        <div id="uploadPreviewState" style="display: none;">
                            <img id="previewImage" src="" alt="Preview">
                            <p id="fileNameDisplay"></p>
                            <button type="button" id="removeFileBtn">Remove Image</button>
                        </div>

                    </div>
                </div>

                <div class="upDetails">
                    <div class="form-left">
                        <div class="form-group">
                            <h4>Art Title</h4>
                            <input type="text" name="artTitle" placeholder="Title of Artwork" required>
                        </div>
                        
                        <div class="form-group">
                            <h4>Description</h4>
                            <textarea name="artDescription" placeholder="About artwork" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <h4>Medium</h4>
                            <input type="text" name="artMedium" placeholder="Enter medium" required>
                        </div>
                        
                        <div class="dimensions-row">
                            <div class="hwc">
                                <h4>Height (cm)</h4>
                                <input type="number" step="any" name="artHeight" placeholder="0.00" required>
                            </div>
                            <div class="hwc">
                                <h4>Width (cm)</h4>
                                <input type="number" step="any" name="artWidth" placeholder="0.00" required>
                            </div>
                            <div class="hwc">
                                <h4>Creation Date</h4>
                                <input type="date" name="artDate" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-right">
                        <div class="form-group">
                            <h4>Category</h4>
                            <div class="select-wrapper">
                                <select name="artCategory" required>
                                    <option value="" disabled selected hidden>Choose Category</option>
                                    <option value="Painting">Painting</option>
                                    <option value="Digital Art">Digital Art</option>
                                    <option value="Photography">Photography</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="btnSide">
                            <button type="submit" class="upBtn">Upload</button>
                            <button type="reset" class="discardBtn" id="discardFormBtn">Discard</button>
                        </div>
                    </div>
                </div>
            </form>
        </main>

        <script>
            const cloudIcon = document.getElementById('cloudIcon');
            const fileInput = document.getElementById('fileInput');
            const defaultState = document.getElementById('uploadDefaultState');
            const previewState = document.getElementById('uploadPreviewState');
            const previewImage = document.getElementById('previewImage');
            const fileNameDisplay = document.getElementById('fileNameDisplay');
            const removeFileBtn = document.getElementById('removeFileBtn');
            const discardFormBtn = document.getElementById('discardFormBtn');

            cloudIcon.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileNameDisplay.textContent = this.files[0].name;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        defaultState.style.display = 'none';
                        previewState.style.display = 'flex';
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            function resetUploadBox() {
                fileInput.value = ''; 
                previewImage.src = '';
                fileNameDisplay.textContent = '';
                previewState.style.display = 'none';
                defaultState.style.display = 'flex';
            }

            removeFileBtn.addEventListener('click', (e) => {
                e.preventDefault(); 
                resetUploadBox();
            });
            
            discardFormBtn.addEventListener('click', () => {
                resetUploadBox();
            });
        </script>
    </body>
</html>
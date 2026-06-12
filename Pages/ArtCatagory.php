<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="../CSS/ArtCatagory.css">
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
                    <div class="navOp"id ="artgallery" onclick="window.location.href='artGallery.php'">
                        <div class="opIcon" id="artgalleryIcon"></div>
                        <div  class="opName" id="artgalleryTitle">Art Gallery</div>
                    </div>
                    <div class="navOp"id ="artcategory" onclick="window.location.href='ArtCatagory.php'" style="background-color:white;color: black; border: 1px solid black;">
                        <div class="opIcon" id="artcategoryIcon" style="background-image: url('/Images/system-images/artcategoryIconH.png');"></div>
                        <div  class="opName" id="artcategoryTitle">Art Category</div>
                    </div>
                    <div class="navOp"id ="artists" onclick="window.location.href='artists.html'">
                        <div class="opIcon" id="artistsIcon"></div>
                        <div  class="opName" id="artistsTitle">Artists</div>
                    </div>
                    <div class="navOp"id ="savedarts" onclick="window.location.href='SavedArtworks.php'">
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
                    <div class="navOp"id ="logout" onclick="window.location.href='../index.php'">
                        <div class="opIcon" id="logoutIcon"></div>
                        <div  class="opName" id="logoutTitle">Log out</div>
                    </div>
                </div>
           </div>

           <div class="content">

             <h1>Art Categories</h1>
            
             <div class="category-card-container">
                    <div class="grid-container">
                        
                        <div class="category-card" onclick="window.location.href='realism.php?category=Realism'">
                            <h3>Realism</h3>
                        </div>

                        <div class="category-card" onclick="window.location.href='realism.php?category=Impressionism'">
                            <h3>Impressionism</h3>
                        </div>

                        <div class="category-card" onclick="window.location.href='realism.php?category=Post-Impressionism'">
                            <h3>Post-Impressionism</h3>
                        </div>

                        <div class="category-card" onclick="window.location.href='realism.php?category=Cubism'  ">
                            <h3>Cubism</h3>
                        </div>

                        <div class="category-card" onclick="window.location.href='realism.php?category=Surrealism'">
                            <h3>Surrealism</h3>
                        </div>

                        <div class="category-card" onclick="window.location.href='realism.php?category=Abstract Art'">
                            <h3>Abstract Art</h3>
                        </div>

                        <div class="category-card" onclick="window.location.href='realism.php?category=Expressionism'">
                            <h3>Expressionism</h3>
                        </div>

                        <div class="category-card" onclick="window.location.href='realism.php?category=Romanticism'">
                            <h3>Romanticism</h3>
                        </div>

                        <div class="category-card" onclick="window.location.href='realism.php?category=Baroque'">
                            <h3>Baroque</h3>
                        </div>

                        <div class="category-card" onclick="window.location.href='realism.php?category=Minimalism'">
                            <h3>Minimalism</h3>
                        </div>


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
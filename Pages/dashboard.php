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
                    <div class="navOp"id ="dashboard" style="background-color:white;color: black; border: 1px solid black;" onclick="window.location.href='dashboard.html'">
                        <div class="opIcon" id="dashboardIcon" style="background-image: url('/Images/system-images/dashIconH.png');"></div>
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
                    <div class="navOp"id ="artists"  onclick="window.location.href='artists.html'">
                        <div class="opIcon" id="artistsIcon"></div>
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
                <div class= "row" id="row1">
                    <div id="greeting">Welcome, M. Afnan</div>
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
                    <div class="imgCard">
                        <div class="cUp"></div>
                        <div class="cDown">
                            <div class="likeCmt">
                                <div class="like"></div>
                                <div class="cmt"></div>
                            </div>
                            <div class="saveArt"></div>
                        </div>
                    </div>
                    <div class="imgCard">
                        <div class="cUp"></div>
                        <div class="cDown">
                            <div class="likeCmt">
                                <div class="like"></div>
                                <div class="cmt"></div>
                            </div>
                            <div class="saveArt"></div>
                        </div>
                    </div>
                    <div class="imgCard">
                        <div class="cUp"></div>
                        <div class="cDown">
                            <div class="likeCmt">
                                <div class="like"></div>
                                <div class="cmt"></div>
                            </div>
                            <div class="saveArt"></div>
                        </div>
                    </div>
                    <div class="imgCard">
                        <div class="cUp"></div>
                        <div class="cDown">
                            <div class="likeCmt">
                                <div class="like"></div>
                                <div class="cmt"></div>
                            </div>
                            <div class="saveArt"></div>
                        </div>
                    </div>
                    <div class="imgCard">
                        <div class="cUp"></div>
                        <div class="cDown">
                            <div class="likeCmt">
                                <div class="like"></div>
                                <div class="cmt"></div>
                            </div>
                            <div class="saveArt"></div>
                        </div>
                    </div>
                    
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
                                    <img src="/Images/system-images/likeC.png">
                                    <span>9K</span>
                                </div>
                            </div>
                            <div class="topArtWorkCard">
                                <div class="topArt" style="background-image: url('/Images/postImages/postDemo3.png');"></div>
                                <div class="topArtLike">
                                    <img src="/Images/system-images/likeC.png">
                                    <span>8K</span>
                                </div>
                            </div>
                            <div class="topArtWorkCard">
                                <div class="topArt" style="background-image: url('/Images/postImages/postDemo1.png');"></div>
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
        const user = {role: "artist"};
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
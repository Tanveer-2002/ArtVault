<?php
session_start();
    include "PHP/dbConnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/IndexStyle.css">
</head>
<body>
    <div id="login">
        <div id="login-header"></div>

        <div id="login_box">
            <div id="loginTxT">Log In</div>
            <form action="PHP/loginCheck.php" method="post" id="Login_form">
                <div>
                    <div class="labelContainer">
                        <label for="email" class="label">E-Mail :</label>
                        <?php
                            echo '<label class="labelInfo"';
                            if (isset($_SESSION['epError'])){
                                echo ' style="color: red;">'.$_SESSION['epError'].'</label>';
                                }
                            else{
                               echo '>';

                            }
                        ?>
                    </div>
                    <input type="text" name="email" id="email" class="box" placeholder="Enter E-Mail here">
                </div>

                <div>
                    <label for="" class="label">Password :</label>
                    <input type="password" name="password" id="password" class="box" placeholder="Enter Password here">
                </div>

                <button id="B1">Log In</button>

                <div id="links">
                    <a href="" id="fp">Forgot Password?</a>
                    <span id="dha">Don't have an account? <a href="Pages/Registration.php">Sign Up</a></span>
                </div>
            
         </form>

         </div>
        
    </div>
</body>
</html>
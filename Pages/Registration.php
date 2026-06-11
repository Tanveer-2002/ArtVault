<?php
    session_start();
    include "../PHP/dbConnect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/Registration.css">
</head>
<body>
    <div id="login">
        <div id="login-header"></div>

        <div id="login_box">
            <div id="RegTxT">Create Account</div>
            <form action="../PHP/RegiCheck.php" method="post" id="Login_form">

                <div>
                    <div class="labelContainer">
                        <label for="email" class="label">E-Mail :</label>
                        <?php
                            echo '<label class="labelInfo"';
                            if (isset($_SESSION['emailError'])){
                                echo ' style="color: red;">'.$_SESSION['emailError'].'</label>';
                                }
                            else{
                               echo '>';

                            }
                        ?>
                    </div>
                    <input type="text" name="email" id="email" class="box" placeholder="Enter E-Mail here" value="<?= $_SESSION['email'] ?? ''?>" required>
                </div>

                <div>
                    <div class="labelContainer">
                        <label for="passwoerd" class="label">Password :</label>
                        <?php
                            echo '<label class="labelInfo"';
                            if (isset($_SESSION['passError'])){
                                echo 'style="color:red;">';}else{echo '>';}

                            echo 'Password must be at least 6 characters long</label>';
                        ?>
                     </div>
                    <input type="password" name="password" id="password" class="box" placeholder="Enter Password here" value="<?= $_SESSION['password'] ?? ''?>" required>
                </div>

                <div>
                    <div class="labelContainer">
                        <label for="confirm_password" class="label">Confirm Password :</label>
                        <?php
                            if (isset($_SESSION['conPassError'])){
                                echo '<label class="labelInfo" style="color:red;">Passwords do not match</label>';
                            }
                        ?>
                     </div>
                    <input type="password" name="confirm_password" id="confirm_password" class="box" placeholder="Confirm Password here" value="<?= $_SESSION['conPassword'] ?? ''?>" required>
                </div>

                <div>
                    <label for="" class="label">Register as:</label>
                  <div id="radio" >
                    <input type="radio" id="artist" name="register_as" value="1" required>
                    <label for="artist">Artist</label>
                    <input type="radio" id="visitor" name="register_as" value="0" required>
                    <label for="visitor">Visitor</label>
                  </div>
                </div>
                
                <button id="B1">Create Account</button>
                <div id="links">
                    <span id="aha">Already have an account? <a href="../index.php">login</a></span>
                </div>
         </form>

         </div>
    </div>
    
</body>
</html>
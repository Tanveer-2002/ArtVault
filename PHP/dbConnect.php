<?php
    $connect = mysqli_connect("localhost", "root", "", "artvaultdb");
    if (!$connect) {
        echo "Connection Failed";
    }

?>
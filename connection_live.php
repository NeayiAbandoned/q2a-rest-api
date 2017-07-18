<?php

    //DB Connectivity
    $servername = "localhost";
    $username = "renalbio_qtoa520";
    $password = "ox06.Up(6S";
    $dbname = "renalbio_qtoa520";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
     // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
?>
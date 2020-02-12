<?php

function buildConnection()
{
    if (!defined('QA_BASE_DIR'))
        define('QA_BASE_DIR', Q2ALOCATION . '/');

    include_once(Q2ALOCATION . '/qa-config.php');

    //DB Connectivity
    $servername = QA_MYSQL_HOSTNAME;
    $username = QA_MYSQL_USERNAME;
    $password = QA_MYSQL_PASSWORD;
    $dbname = QA_MYSQL_DATABASE;

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

// Create connection
$conn = buildConnection();

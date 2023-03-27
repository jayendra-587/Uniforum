<?php
function doDB() {
    global $conn;

    $conn = mysqli_connect("localhost", "root", "", "user007");

    //if connection fails, stop script execution
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    // Start the session
    session_start();
}
?>

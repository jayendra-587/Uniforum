<?php
include 'partials/_dbConnect.php';
doDB();

session_destroy();
header("Location: login.html");
exit;
?>
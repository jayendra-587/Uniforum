<?php
/* This is the File connecting the database 
and assuming that you are running MySQL using "root" and "password" */

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','credentials');

//Trying to connect to Database
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

//Checking the connection
if($conn == false)
{
    echo('Error : Cannot connect to the Database');
}
else{
    echo("connection Sucessful");
}

?>
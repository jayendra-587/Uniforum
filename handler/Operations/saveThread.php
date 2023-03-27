<?php
include 'partials/_dbConnect.php';
doDB();
$conn = mysqli_connect("localhost", "root", "", "user007");

$topics = "SELECT * FROM uf_threads";
$result = mysqli_query($conn, $topics) or die(mysqli_error($conn));

//Go through each result row, which is stored as an array, and add the data to xml tags
$xml = "<topicList>";
while($r = mysqli_fetch_array($result)){
    $xml .= "<topic>";
    $xml .= "<id>".$r['TopicId']."</id>";
    $xml .= "<title>".$r['Title']."</title>";
    $xml .= "<created>".$r['Created']."</created>";
    $xml .= "<owner>".$r['Owner']."</owner>";
    $xml .= "<likes>".$r['Likes']."</likes>";
    $xml .= "</topic>";
}
$xml .= "</threadList>";

//Parse our data
$sxe = new SimpleXMLElement($xml);
$sxe->asXML("thread.xml");
$display_block = "<p style = 'text-align:center; color:red; font-size: 20px;'>The March Madness Discussion Topics were successfully saved.</p>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Save File</title>
    <link rel = "stylesheet" href = "/html_css/css/threads.css">
    <style>
        #logOut{
            background-color: #4286f4;
            color: white;
            position: fixed;
            top: 15px;
            right: 15px;
            padding: 5px 20px;
            border: 1px solid white;
            border-radius: 20px;
        }
        #logOut:hover{
            background-color: white;
            color: #4286f4;
        }
    </style>
</head>
<body>
<header id = "top">
    <h1> March Madness Discussion Topics </h1>
</header>
<nav>
    <a href = "/home.html"><button>Main Menu</button></a>
    <a href="/handler/Threads/showThread.php"><button>Show Threads</button></a>
    <a href = "/html_css/html/addThread.html"><button>Add Threads</button></a>
</nav>
<?php echo $display_block; ?>

<a href = "/Initial/logout.php"><button id = "logOut">Log Out</button></a>
</body>
</html>

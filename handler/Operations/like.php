<?php
include 'partials/_dbConnect.php';
doDB();
$conn = mysqli_connect("localhost", "root", "", "user007");


$safe_topic_id = mysqli_real_escape_string($conn, $_GET['topic_id']);

$verify_sql = "SELECT TopicId, Likes FROM rj_topics
    WHERE TopicId = '".$safe_topic_id."'";

$verify_res = mysqli_query($conn, $verify_sql) or die(mysqli_error($conn));

//get the topic id and likes
while($topic_info = mysqli_fetch_array($verify_res)) {
    $topic_id = $topic_info['TopicId'];
    $topic_likes = $topic_info['Likes'];
}

if($topic_likes >= 0){
    $topic_likes = $topic_likes + 1;
    $sql = "UPDATE rj_topics SET Likes = '".$topic_likes."' WHERE TopicId = '".$topic_id."'";
    $add_like_res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Location: threadList.php");
    exit;
}
else{
    $display_block = "Unable to Like Post";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href = "/html_css/css/menu.css">
    <title>Liked Post</title>
    <style>
        p{
            text-align: center;
            color: red;
        }
        a{
            text-align: center;
            color: black;
            text-decoration: underline;
        }
        a:hover{
            text-decoration: none;
        }
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
    <h1> UniForum Menu </h1>
</header>
<p><?php echo $display_block?></p>
<p><a href = '../Threads/threadList.php' style = 'color: black;'>Return to UniForum Threads</a></p>

<a href = "/Initial/logout.php"><button id = "logOut">Log Out</button></a>
</body>
</html>
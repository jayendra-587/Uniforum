<?php
include 'partials/_dbConnect.php';
doDB();
$conn = mysqli_connect("localhost", "root", "", "user007");


if($_SESSION["user"] == null){
    header("Location: html_css/html/login.html");
    exit;
}

//check for required info from the query string
if (!isset($_GET['topic_id'])) {
    header("Location: handler/Threads/threadList.php");
    exit;
}
//$display_button;
//create safe values for use
$safe_topic_id = mysqli_real_escape_string($conn, $_GET['topic_id']);

//verify the topic exists
$verify_topic_sql = "SELECT Title FROM uf_thread WHERE TopicId = '".$safe_topic_id."'";
$verify_topic_res =  mysqli_query($conn, $verify_topic_sql) or die(mysqli_error($conn));

if (mysqli_num_rows($verify_topic_res) < 1) {
    //this topic does not exist
    $display_block = "<p><em>You have selected an invalid topic.<br/>
	Please <a href=\"handler/Threads/threadList.php\">try again</a>.</em></p>";
} else {
    //get the topic title
    while ($topic_info = mysqli_fetch_array($verify_topic_res)) {
        $topic_title = stripslashes($topic_info['Title']);
    }

    //gather the posts
    $get_posts_sql = "SELECT PostId, PostText, DATE_FORMAT(Created, '%b %e %Y<br/>%r') AS fmt_post_create_time, Owner FROM uf_threads WHERE TopicId = '".$safe_topic_id."' ORDER BY Created ASC";
    $get_posts_res = mysqli_query($conn, $get_posts_sql) or die(mysqli_error($conn));

    //create the display string
    $display_block = <<<END_OF_TEXT
	<p>Showing posts for the <strong>$topic_title</strong> topic:</p>
	<table>
	<tr>
	<th>Author</th>
	<th>Post</th>
	</tr>
END_OF_TEXT;

    while ($posts_info = mysqli_fetch_array($get_posts_res)) {
        $post_id = $posts_info['PostId'];
        $post_text = nl2br(stripslashes($posts_info['PostText']));
        $post_create_time = $posts_info['fmt_post_create_time'];
        $post_owner = stripslashes($posts_info['Owner']);

        //add to display
        $display_block .= <<<END_OF_TEXT
		<tr>
		<td><i id = "userLogo" class = "fa fa-user"></i> <u> $post_owner </u> <br/><br/>Created on: <label> $post_create_time </label></td>
		<td>$post_text<br/><br/>
		<a href="replytopost.php?post_id=$post_id"><strong>REPLY TO POST</strong></a></td>
		</tr>
END_OF_TEXT;
    }

    //free results
    mysqli_free_result($get_posts_res);
    mysqli_free_result($verify_topic_res);

    //close connection to MySQL
    mysqli_close($conn);

    //close up the table
    $display_block .= "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Posts in Topic</title>
    <link href="html_css/css/threads.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th {
            border: 1px solid black;
            padding: 6px;
            font-weight: bold;
        }
        td {
            border: 1px solid black;
            padding: 6px;
            vertical-align: top;
        }
        .num_posts_col { text-align: center; }
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
    <h1> Topic Posts </h1>
</header>
<nav>
    <a href = "/html_css/html/home.html"><button>Main Menu</button></a>
    <a href="/handler/Threads/showThread.php"><button>Show Threads</button></a>
    <a href = "/html_css/html/addThread.html"><button>Add Threads</button></a>
</nav>
<main>
    <section id = "filler"> </section>
    <section id = "posts">
        <?php echo $display_block; ?>
    </section>
    <section id = "filler"> </section>
</main>

<a href = "/Initial/logout.php"><button id = "logOut">Log Out</button></a>
</body>
</html>

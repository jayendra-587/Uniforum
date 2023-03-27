<?php
include 'partials/_dbConnect.php';
doDB();
$conn = mysqli_connect("localhost", "root", "", "user007");

if($_SESSION["user"] == null){
    header("Location: login.html");
    exit;
}

//check to see if we're showing the form or adding the post
if (!$_POST) {
    // showing the form; check for required item in query string
    if (!isset($_GET['post_id'])) {
        header("Location: threadList.php");
        exit;
    }

    //create safe values for use
    $safe_post_id = mysqli_real_escape_string($conn, $_GET['post_id']);

    //still have to verify topic and post
    $verify_sql = "SELECT t.TopicId, t.Title FROM uf_threads
                  AS p LEFT JOIN rj_topics AS t ON p.TopicId =
                  t.TopicId WHERE p.PostId = '".$safe_post_id."'";

    $verify_res = mysqli_query($conn, $verify_sql)
    or die(mysqli_error($conn));

    if (mysqli_num_rows($verify_res) < 1) {
        //this post or topic does not exist
        header("Location: threadList.php");
        exit;
    } else {
        //get the topic id and title
        while($topic_info = mysqli_fetch_array($verify_res)) {
            $topic_id = $topic_info['TopicId'];
            $topic_title = stripslashes($topic_info['Title']);
        }
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Post Your Reply in <?php echo $topic_title; ?></title>
            <link href="/html_css/css/forms.css" rel="stylesheet" type="text/css" />
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
            <h1> Reply to <?php echo $topic_title; ?> </h1>
        </header>
        <nav>
            <a href = "/home.html"><button>Main Menu</button></a>
            <a href="/handler/Threads/showThread.php"><button>Show Threads</button></a>
            <a href = "/html_css/html/addThread.html"><button>Add Threads</button></a>
        </nav>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id = "replyForm">

            <p><label for="post_text">Post Text:</label><br/>
                <textarea id="post_text" name="post_text" rows="8" cols="40"
                          required="required" autofocus></textarea></p>
            <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
            <button id = "addPost" class = "styledButton" type="submit" name="submit" value="submit">Add Post</button>
        </form>

        <a href = "/logout.php"><button id = "logOut">Log Out</button></a>
        </body>
        </html>
        <?php
        //free result
        mysqli_free_result($verify_res);

        //close connection to MySQL
        mysqli_close($conn);
    }

} else if ($_POST) {
    //check for required items from form
    if ((!$_POST['topic_id']) || (!$_POST['post_text'])/* || (!$_POST['post_owner'])*/) {
        header("Location: /threadList.php");
        exit;
    }

    //create safe values for use
    $safe_topic_id = mysqli_real_escape_string($conn, $_POST['topic_id']);
    $safe_post_text = mysqli_real_escape_string($conn, $_POST['post_text']);
    $safe_post_owner = mysqli_real_escape_string($conn, $_SESSION["user"]);

    //add the post
    $add_post_sql = "INSERT INTO uf_threads (TopicId, PostText,
                       Created , Owner) VALUES
                       ('".$safe_topic_id."', '".$safe_post_text."',
                       now(),'".$safe_post_owner."')";
    $add_post_res = mysqli_query($conn, $add_post_sql)
    or die(mysqli_error($conn));

    //close connection to MySQL
    mysqli_close($conn);

    //redirect user to topic
    header("Location: /showThread.php?topic_id=".$_POST['topic_id']);
    exit;
}
?>



<?php
   session_start();
  
   if (!isset($_SESSION["username"]))
   {
    header("Location: /connecthub/login.php");
   }

   $username = $_SESSION["username"];
   $con = mysqli_connect("localhost", "root", "Chahat@2003", "project");
   $res = mysqli_query($con, "SELECT profile_pic FROM user_profile WHERE user_id = (SELECT user_id FROM user_credentials WHERE username = '$username')");                
   $result= mysqli_fetch_assoc($res);
   $image=$result["profile_pic"];
?>

<html>
    <head>
        <title>
            Explore | ConnectHub
        </title>
        <style>
        *{
            margin: 0px;  
            padding:0px;   
        }
        body
        {
        background-color:black;
        display: grid;
        grid-template-rows: auto 1rem;
        background-image: url('/connecthub/socialbook_img/images/bgimage.jpg');
        background-position: center;
        background-repeat: none;
        background-size: contain;
        }
    
        .left li a:hover{
          color:white; 
        font-size:21px;    
         }
         
        header {
            font-size: 44px;
            font-weight: bold;
            text-align: center;
            width: 100%;
            padding-top: 20px;
            color: white;
            cursor:context-menu;
        }
        ul {
            list-style-type: none;
            color: aliceblue;
        }

       .container {
            width: 100%;
            display: flex;
            position:relative;
            overflow: hidden;
        }

        .left ul li {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size:20px;
            display:block;
        }

        .left {
            width:calc(15% - 20px);
            padding: 10px;
            overflow: hidden;
        }
        
        .left ul li:hover {
            background-color:rgba(209, 214, 230, 0.146);
            font-weight: 400;
            font-size: 22px;
        }

        ul a {
            text-decoration: none;
            color:rgb(209, 214, 230);
        }

        .right {
            width: calc(85% - 20px);
            padding: 10px;
            color: aliceblue;
            font-size: x-large;
            overflow:auto;
        }

        hr{
            color: #ccc;
            opacity: 0.5;
        }

        .name{
            font-family:'Times New Roman', Times, serif;
            font-size:19px;
            text-decoration:underline;
            text-decoration: aliceblue;
        }

        .date{
            font-family:cursive;
            font-size:16px;
           color: #ccc;
           opacity: 0.8;
          text-align: right;
        }

        .edit_post{
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 27px;
       
          display: flex;
          flex-flow: row nowrap;
        
        align-items: center;
        }
        .image{
            width:60px;
           height:60px;
           border-radius:50%;
        }
        .profile_image{
          border-radius:50%;
         
        }

        .edit1
        {
            width: calc(100% - 20px);
          color:aliceblue;
          font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
          font-size:larger;
          display: grid;
          grid-template-columns: auto 1fr auto;
          align-items: center;
          cursor:context-menu;
          padding-right: 20px;
        }

        .postcontent {
            display: flex;
            flex-flow: column nowrap;
            justify-content: flex-start;
            cursor:context-menu;
            margin-left: 20px;
        }
        

        .authorusername {
            font-size: 20px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            cursor:pointer;

        }
    
        .edit2
        {
          font-size: 18px;
          text-align: right;
          color: ghostwhite;
          cursor:context-menu;
        }

        .edit3
        {
          margin-left: 200px;
          font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          cursor:context-menu;
        }

        .profile_image{
          border-radius:50%;
         
        }

        .start{
            font-family: monospace;
            font-size: 20px;
            color: #ccc;
            margin-bottom: 20px;
        }
        </style>
       <script>
    function togglePostLike(element, pid) {
        let req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState == 4 && req.status == 200) {
                let res = JSON.parse(req.responseText);
                console.log(res);
                if (res.success)
                {
                    if (res.state == 1)
                        element.src = "/connecthub/socialbook_img/images/like-blue.png";
                    else element.src = "/connecthub/socialbook_img/images/like.png";
                }
                else alert("Failed to like post!");
            }
        };

        req.open('GET', "/connecthub/likepost.php?post_id=" + pid);
        req.send();
    }
</script>
    </head>

    <body>
        <header style="display:flex; flex-flow: column nowrap; align-items: center; justify-content: center;"><span style="font-family: sans-serif; padding: 5px 10px 5px 10px; color: white;">ConnectHub</span></header>
        <br>
        <div class="container">
            <div class="left">
            <ul>
            <a href="index.php"><li><img src="socialbook_img/images/profile-home.png" width="30px" srcset="">Home<br><br></li></a><br><br>
                <a href="SearchPage.php"><li><img src="socialbook_img/images/search.png" width="30px"srcset="">Search<br><br></li></a><br><br>
                <a href="ExplorePage.php"><li><img src="socialbook_img/images/see-more.png" width="30px"srcset="">Explore<br><br></li></a><br><br>
                <a href="NotificationPage.php"><li><img src="socialbook_img/images/notification.png" width="30px" srcset="">Notifications<br><br></li></a><br><br>
                <a href="CreatePage.php"><li><img src="socialbook_img/images/upload.png" width="30px" srcset="">Create<br><br></li></a><br><br>
                <a href="ProfilePage.php"><li><img  class="profile_image" src="<?php echo $image; ?>" width="30px" height="30px" srcset="">Profile<br><br></li></a><br><br><br>
                <a href="More.php"><li><img src="socialbook_img/images/more.png" width="30px" srcset="">More<br><br></li></a>
               </ul>
            </div>
            <div class="right">
            <?php
                   $username = $_SESSION["username"];
                   $con = mysqli_connect("localhost", "root", "Chahat@2003", "project");
                   
                   if (isset($_GET["topPost"]))
                   {
                        $topPostID = $_GET["topPost"];
                        $query = "SELECT post.post_id, post.post_content, post.posted_at, user_credentials.username, user_profile.profile_pic
                        FROM post
                        JOIN user_credentials ON post.posted_by = user_credentials.user_id
                        JOIN user_profile ON user_credentials.user_id = user_profile.user_id
                        WHERE post.post_id = $topPostID
                        ORDER BY post.posted_at DESC;";

                        $row = mysqli_fetch_assoc(mysqli_query($con, $query));
                        $query = "SELECT COUNT(*) FROM post_likes WHERE post_id = " . $row["post_id"] . " AND liked_by = (SELECT user_id FROM user_credentials WHERE username = '" . $_SESSION["username"] . "');";
                        $res = mysqli_fetch_row(mysqli_query($con, $query));
                        $query2 = "SELECT COUNT(*) FROM post_likes WHERE post_id = " . $row["post_id"];
                        $res2= mysqli_fetch_row(mysqli_query($con, $query2));
                        echo "<div class='start'>HIGHLIGHTED POST</div>";
                        echo "<div class='edit1'>";
                        echo "<img class='image postedbyimage' src='" . $row["profile_pic"] . "' height='70px' width='70px'>";
                    
                        echo "<span class='postcontent'>";
                        echo "<span class='authorusername' onclick='window.location.assign(\"viewProfile.php?username=" . $row["username"] . "\")'>" . $row["username"] . "</span>";
                        echo $row['post_content']."&nbsp;";
                        echo "</span>";
                        echo "<img class='like' src='" . ($res[0] == 0 ? "\connecthub\socialbook_img\images\like.png" : "\connecthub\socialbook_img\images\like-blue.png") . "' height='30px' width='30px' ondblclick='togglePostLike(this, " . $row["post_id"] . ")'";
                        echo "<br> ";               
                        echo "</div>";
                        echo "<div class='edit2'>";
                        echo "<div style='margin-right: 10px; margin-bottom: 10px;'>" . $res2[0] . " likes </div>";
                        echo "<span style='opacity: 0.5'>" . $row['posted_at'] . "</span>";
                        echo "<hr>";
                        echo "<br>";
                        echo "</div>";
                        echo "<div class='start'>EXPLORE MORE POSTS</div>";

                   }
                   
                   $query = "SELECT post.post_id, post.post_content, post.posted_at, user_credentials.username, user_profile.profile_pic
                   FROM post
                   JOIN user_credentials ON post.posted_by = user_credentials.user_id
                   JOIN user_profile ON user_credentials.user_id = user_profile.user_id
                   WHERE user_credentials.username <> '$username'
                   ORDER BY post.posted_at DESC;";
                   
                   $result = mysqli_query($con, $query);
                 
         if ($result) {
             while ($row = mysqli_fetch_assoc($result)) {
                $query = "SELECT COUNT(*) FROM post_likes WHERE post_id = " . $row["post_id"] . " AND liked_by = (SELECT user_id FROM user_credentials WHERE username = '" . $_SESSION["username"] . "');";
                $res = mysqli_fetch_row(mysqli_query($con, $query));
                
                $query2 = "SELECT COUNT(*) FROM post_likes WHERE post_id = " . $row["post_id"];
                $res2= mysqli_fetch_row(mysqli_query($con, $query2));
                echo "<div class='edit1'>";
                echo "<img class='image postedbyimage' src='" . $row["profile_pic"] . "' height='70px' width='70px'>";
               
                echo "<span class='postcontent'>";
                echo "<span class='authorusername' onclick='window.location.assign(\"viewProfile.php?username=" . $row["username"] . "\")'>" . $row["username"] . "</span>";
                echo $row['post_content']."&nbsp;";
                echo "</span>";
                echo "<img class='like' src='" . ($res[0] == 0 ? "\connecthub\socialbook_img\images\like.png" : "\connecthub\socialbook_img\images\like-blue.png") . "' height='30px' width='30px' ondblclick='togglePostLike(this, " . $row["post_id"] . ")'";
                echo "<br> ";               
                echo "</div>";
                echo "<div class='edit2'>";
                echo "<div style='margin-right: 10px; margin-bottom: 10px;'>" . $res2[0] . " likes </div>";
                echo "<span style='opacity: 0.5'>" . $row['posted_at'] . "</span>";
                echo "<hr>";
                echo "<br>";
                echo "</div>";
             }
         } 
         
         mysqli_close($con);
         ?>
            </div>
        </div>
    </body>
</html>
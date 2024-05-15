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

   $u = $_GET["username"];
   if ($u == $_SESSION["username"])
   {
    header("Location: /connecthub/ProfilePage.php");
   }
?>
<html>
    <head>
        <title>
            <?php echo $u ?> | ConnectHub
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
        
        #userdetails {
            width: 100%;
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
        }
            
        button
           {
              background-color: lightskyblue;
              width: 250px;
              height:25px;
            border-radius: 2%;
              color:black;
              font-style: italic;
          font-weight: bolder;
           }
        .edit1
        {
            width: calc(100% - 20px);
          color:aliceblue;
          font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
          font-size:larger;
          display: grid;
          grid-template-columns: auto 1fr auto;
          align-items: center;
          padding-right:20px;
          cursor:context-menu;
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

        .postedbyimage{
          border-radius:50%;
        }
        .profile_image{
          border-radius:50%;
         
        }
 
        </style>
        <script>
            function toggleFollowUser(e) {
                let req = new XMLHttpRequest();
                
                req.onreadystatechange = () => {
                    if (req.readyState == 4 && req.status == 200)
                    {
                        let res = JSON.parse(req.responseText);
                        if (res.success)
                        {
                            if (res.state)
                                e.innerHTML = "Unfollow";
                            else e.innerHTML = "Follow";
                        }
                        else alert("Action failed!");
                    }
                }

                req.open("GET", "/connecthub/followuser.php?target=<?php echo $_GET['username'] ?>");
                req.send();
            }

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
                   $con = mysqli_connect("localhost", "root", "Chahat@2003", "project");
                   $res = mysqli_query($con, "SELECT * FROM user_profile WHERE user_id = (SELECT user_id FROM user_credentials WHERE username = '$u')");                
                   $result= mysqli_fetch_assoc($res);
                   $image=$result["profile_pic"];
                   $bio=$result["bio"];

                   $res = mysqli_query($con, "SELECT COUNT(*) FROM follow_data WHERE following = (SELECT user_id fROM user_credentials WHERE username = '$u')");
                   $result = mysqli_fetch_row($res);
                   $follower_count = $result[0];
                   
                   $res = mysqli_query($con, "SELECT COUNT(*) FROM follow_data WHERE follower = (SELECT user_id fROM user_credentials WHERE username = '$u')");
                   $result = mysqli_fetch_row($res);
                   $following_count = $result[0];

                   $res=mysqli_query($con,"SELECT COUNT(*) FROM post WHERE posted_by = (SELECT user_id FROM user_credentials WHERE username = '$u')");
                   $result = mysqli_fetch_row($res);
                   $post_count = $result[0];
                   $q = "SELECT COUNT(*) FROM follow_data WHERE follower = (SELECT user_id FROM user_credentials WHERE username = '" . $_SESSION["username"] . "') AND following = (SELECT user_id FROM user_credentials WHERE username = '" . $_GET["username"] . "');";
                   echo "<div id='userdetails'>";
                   echo "<img src='$image' height='185px' width='185px' style='border-radius: 50%'>";
                   echo "<div class='edit3'>" ;
                   echo " <br>Username-: $u <br>";
                   echo "Bio-: $bio <br><br> ";
                   echo $post_count."  "."Post"."  &nbsp;&nbsp;&nbsp; ". $follower_count ."   ". "Followers " ." &nbsp;&nbsp;&nbsp;   ". $following_count ."   "."Following<br> <br>" ;

                   
                   echo "<button onclick='toggleFollowUser(this)'>";
                   if (mysqli_fetch_row(mysqli_query($con, $q))[0] == 1) echo "Unfollow";
                   else echo "Follow";
                   echo "</button></div> </div><br>";
                  
                   echo "<hr><br>";
                   $post=mysqli_query($con,"SELECT *FROM post WHERE posted_by = (SELECT user_id FROM user_credentials WHERE username = '$u') ORDER BY posted_at DESC");
                   while ($result1 = mysqli_fetch_assoc($post)) {
                    $query = "SELECT COUNT(*) FROM post_likes WHERE post_id = " . $result1["post_id"] . " AND liked_by = (SELECT user_id FROM user_credentials WHERE username = '" . $_SESSION["username"] . "');";
                    $res = mysqli_fetch_row(mysqli_query($con, $query));
                    $query2 = "SELECT COUNT(*) FROM post_likes WHERE post_id = " . $result1["post_id"];
                    $res2= mysqli_fetch_row(mysqli_query($con, $query2));
                    echo "<div class='edit1'>";
                    echo "<img class='image postedbyimage' src='$image' height='70px' width='70px'>";
                    echo "<span class='postcontent'>";
                    echo $result1['post_content']."&nbsp;";
                    echo "</span>";
                    echo "<img class='like' src='" . ($res[0] == 0 ? "\connecthub\socialbook_img\images\like.png" : "\connecthub\socialbook_img\images\like-blue.png") . "' height='30px' width='30px' ondblclick='togglePostLike(this, " . $result1["post_id"] . ")'";
                    echo "<br>";
                    echo "</div>";
                    echo "<div class='edit2'>";
                    echo "<div style='margin-right: 10px; margin-bottom: 10px;'>" . $res2[0] . " likes </div>";
                    echo "<span style='opacity: 0.5'>" . $result1['posted_at'] . "</span>";
                    echo "<hr>";
                    echo "<br>";
                    echo "</div>";
                }
             
                   ?>
            </div>
        </div>
    </body>
</html>
<?

?>


                   
                    
                   

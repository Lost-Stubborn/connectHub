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
            ConnectHub
        </title>
        <style>
      *{
            margin: 0px;  
            padding:0px;   
        }
        body
        {
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
        z-index: 1;   
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
            font-size:large;
            overflow:auto;
            cursor:context-menu;
        }
        .profile_image{
          border-radius:50%;
         
        }.profile_image{
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
        .image{
            width:60px;
           height:60px;
           border-radius:50%;
        }

        #loadcontainer {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index: 2;
        }

        #load {
  position:absolute;
  width:600px;
  height:36px;
  left:50%;
  top:50%;
  margin-left:-300px;
  overflow:visible;
  -webkit-user-select:none;
  -moz-user-select:none;
  -ms-user-select:none;
  user-select:none;
  cursor:default;
}

#load div {
  position:absolute;
  width:20px;
  height:36px;
  opacity:0;
  font-family:Helvetica, Arial, sans-serif;
  animation:move 2s linear infinite;
  -o-animation:move 2s linear infinite;
  -moz-animation:move 2s linear infinite;
  -webkit-animation:move 2s linear infinite;
  transform:rotate(180deg);
  -o-transform:rotate(180deg);
  -moz-transform:rotate(180deg);
  -webkit-transform:rotate(180deg);
  color:#35C4F0;
}

#load div:nth-child(2) {
  animation-delay:0.2s;
  -o-animation-delay:0.2s;
  -moz-animation-delay:0.2s;
  -webkit-animation-delay:0.2s;
}
#load div:nth-child(3) {
  animation-delay:0.4s;
  -o-animation-delay:0.4s;
  -webkit-animation-delay:0.4s;
  -webkit-animation-delay:0.4s;
}
#load div:nth-child(4) {
  animation-delay:0.6s;
  -o-animation-delay:0.6s;
  -moz-animation-delay:0.6s;
  -webkit-animation-delay:0.6s;
}
#load div:nth-child(5) {
  animation-delay:0.8s;
  -o-animation-delay:0.8s;
  -moz-animation-delay:0.8s;
  -webkit-animation-delay:0.8s;
}
#load div:nth-child(6) {
  animation-delay:1s;
  -o-animation-delay:1s;
  -moz-animation-delay:1s;
  -webkit-animation-delay:1s;
}
#load div:nth-child(7) {
  animation-delay:1.2s;
  -o-animation-delay:1.2s;
  -moz-animation-delay:1.2s;
  -webkit-animation-delay:1.2s;
}

@keyframes move {
  0% {
    left:0;
    opacity:0;
  }
  35% {
    left: 41%; 
    -moz-transform:rotate(0deg);
    -webkit-transform:rotate(0deg);
    -o-transform:rotate(0deg);
    transform:rotate(0deg);
    opacity:1;
  }
  65% {
    left:59%; 
    -moz-transform:rotate(0deg); 
    -webkit-transform:rotate(0deg); 
    -o-transform:rotate(0deg);
    transform:rotate(0deg); 
    opacity:1;
  }
  100% {
    left:100%; 
    -moz-transform:rotate(-180deg); 
    -webkit-transform:rotate(-180deg); 
    -o-transform:rotate(-180deg); 
    transform:rotate(-180deg);
    opacity:0;
  }
}

@-moz-keyframes move {
  0% {
    left:0; 
    opacity:0;
  }
  35% {
    left:41%; 
    -moz-transform:rotate(0deg); 
    transform:rotate(0deg);
    opacity:1;
  }
  65% {
    left:59%; 
    -moz-transform:rotate(0deg); 
    transform:rotate(0deg);
    opacity:1;
  }
  100% {
    left:100%; 
    -moz-transform:rotate(-180deg); 
    transform:rotate(-180deg);
    opacity:0;
  }
}

@-webkit-keyframes move {
  0% {
    left:0; 
    opacity:0;
  }
  35% {
    left:41%; 
    -webkit-transform:rotate(0deg); 
    transform:rotate(0deg); 
    opacity:1;
  }
  65% {
    left:59%; 
    -webkit-transform:rotate(0deg); 
    transform:rotate(0deg); 
    opacity:1;
  }
  100% {
    left:100%;
    -webkit-transform:rotate(-180deg); 
    transform:rotate(-180deg); 
    opacity:0;
  }
}

@-o-keyframes move {
  0% {
    left:0; 
    opacity:0;
  }
  35% {
    left:41%; 
    -o-transform:rotate(0deg); 
    transform:rotate(0deg); 
    opacity:1;
  }
  65% {
    left:59%; 
    -o-transform:rotate(0deg); 
    transform:rotate(0deg); 
    opacity:1;
  }
  100% {
    left:100%; 
    -o-transform:rotate(-180deg); 
    transform:rotate(-180deg); 
    opacity:0;
  }
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

    function removeLoading() {
        let f = document.querySelector("#loadContainer");
        document.body.removeChild(f);
    }
</script>
    </head>

    <body>
        <header style="display:flex; flex-flow: column nowrap; align-items: center; justify-content: center;"><span style="font-family: sans-serif; padding: 5px 10px 5px 10px; color: white;">ConnectHub</span></header>
           <br>

        <div id="loadcontainer">
            <div id="load">
                <div>G</div>
                <div>N</div>
                <div>I</div>
                <div>D</div>
                <div>A</div>
                <div>O</div>
                <div>L</div>
            </div>
        </div>

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
                  $query = "SELECT post.post_id, post.post_content, post.posted_at, user_credentials.username, user_profile.profile_pic
                  FROM post
                  JOIN user_credentials ON post.posted_by = user_credentials.user_id
                  JOIN user_profile ON user_credentials.user_id = user_profile.user_id
                  WHERE post.posted_by = (SELECT user_id FROM user_credentials WHERE username = '" . $_SESSION["username"] . "') OR post.posted_by in (SELECT following FROM follow_data WHERE follower = (SELECT user_id FROM user_credentials WHERE username = '" . $_SESSION["username"] . "'))
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

        <script>
            window.addEventListener('load', () => {
                setTimeout(() => {
                    removeLoading();
                }, 3000);
            });
        </script>
    </body>
</html>
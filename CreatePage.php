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

    $con= mysqli_connect("localhost","root","Chahat@2003","project");
        if(!$con)
            {
             die("failed".mysqli_connect_error());
            }
           
        if(isset($_POST["submit"]))
        {
            $post=$_POST["post"];
            if(!empty($post))
            {
                
            $q1="SELECT * FROM user_credentials where username='$username'";
            $res=mysqli_query($con,$q1);
            if($row=mysqli_fetch_assoc($res));
            {
                $user_id=$row['user_id'];
                $q2="INSERT INTO post(posted_by,post_content) VALUES($user_id,'" . mysqli_real_escape_string($con, $post) . "')";
                $result=mysqli_query($con,$q2);
                if($result)
                {
                    header("Location: /connecthub/ExplorePage.php?topPost=" . mysqli_insert_id($con));
                }
            }
        }
        }
        mysqli_close($con);
?>

<html>
    <head>
        <title>
            Create | ConnectHub
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
            font-size: large;
            overflow:auto;
            cursor:context-menu;
        }

        hr{
            color: #ccc;
            opacity: 0.5;
        }

        textarea {
         width: 80%;
         height: 150px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
         border-radius: 4px;
        background-color: transparent;
        font-size: 16px;
        color: white;
         resize: none;
        }

        input[type="submit"]
           {
              background-color: whitesmoke;
              width: 170px;
              padding: 20px;
              border-radius: 10em;
              color:black;
           }
           ::placeholder
           {
            color:aliceblue;
            opacity:1;
            font-family: monospace;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
           }
           .profile_image{
          border-radius:50%;
         
        }

        </style>
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
                <br>
                <h1 style="font-family: monospace;">What's on your mind Today?</h1><br>
                <form method="post" action="CreatePage.php" >
                    <textarea name="post" rows="40" cols="75" placeholder=" heyy, create something"></textarea><br><br>
                    <input type="submit"  name="submit" value="Upload">

                </form>
            </div>
        </div>
    </body>
</html>

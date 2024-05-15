
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
            Search | ConnectHub
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
            font-size: xx-large;
            overflow:auto;
        }
        input[type="text"]
           {
              background-color:whitesmoke;
              width: 400px;
              height:40px;
              cursor:text;
              background-color: transparent;
              font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
              font-weight: 300;
              padding: 10px;
              color: whitesmoke;
           }
           ::placeholder
           {
            color:ghostwhite;
             opacity:0.7;
            font-family: monospace;
           
           }
           
           input[type="submit"]
           {
              background-color: whitesmoke;
              width: 100px;
              padding: 10px;
              color:black;
             
           }

      article img{
        margin-left:47 px;
        margin-top:10px;
     }
    

           .result {
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
            justify-content: flex-start;
            border-bottom: 2px solid #cccc;
           }

           .result a{
           font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
           color:ghostwhite;
           text-decoration: none;
            font-size: 27px;
            font-weight:100;
            margin-left: 20px;
           }
           .image{
            border-radius: 50%;;
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
                <form action="SearchPage.php" method="get" style="display: flex; flex-flow: row nowrap; justify-content: center; align-items: center; width: 100%">
               <input type="text" name="search" placeholder="Search Username" style="margin-right: 20px; border: 2px solid white">
               <input type="submit" name="submit" value="Search">
               </form>
                <?php
                    $con=mysqli_connect("localhost","root","Chahat@2003","project");
                    if(!$con)
                    {
                        die("failed");
                    }
                    
                    if(isset($_GET["submit"]))
                    {
                        $search=$_GET["search"];
                        $q = "SELECT u.username, p.profile_pic 
                        FROM user_credentials u
                        LEFT JOIN user_profile p ON u.user_id = p.user_id
                        WHERE u.username LIKE '%$search%'";
                        
                        $res=mysqli_query($con,$q);
                        if($res)
                        {
                            if(mysqli_num_rows($res)==0)
                            {
                                echo "<br> No user found !";
                            }
                            else
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $image=$rows['profile_pic'];
                                    echo "<br><div class='result'> <img src='$image' height='50px' width='50px' class='image'> ";
                                    echo "<a href='/connecthub/viewprofile.php?username=" . $rows["username"] . "'  >" . $rows['username'] . "</a><br><br>";
                                    echo "</div>";
                                }
                            }
                        }
                    }
                    mysqli_close($con);
                ?>
            </div>
        </div>
    </body>
</html>


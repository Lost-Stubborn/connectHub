<?php
   session_start();

    $username = $_SESSION["username"];
    if (!isset($_SESSION["username"]))
    {
    header("Location: /connecthub/login.php");
    }
    
    $con= mysqli_connect("localhost","root","Chahat@2003","project");
    
    if(!$con)
    {
        die("failed".mysqli_connect_error());
    }

    if(isset($_POST["submit"]))
    {
        $bio=$_POST["bio"];

        $res="UPDATE  user_profile  SET bio='$bio' WHERE user_id=(SELECT user_id FROM user_credentials WHERE username = '$username') ";
        if(!mysqli_query($con,$res))
        {
            die();
        }
    }
    else{
        echo mysqli_error($con);
    }

    if (isset($_POST["submit2"]))
    {
        $check = getimagesize($_FILES["profilepic"]["tmp_name"]);
        if ($check !== false)
        {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profilepic"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


            if(move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file))
            {
                $query = "UPDATE user_profile SET profile_pic = '$target_file' WHERE user_id = (SELECT user_id FROM user_credentials WHERE username = '" . $_SESSION["username"] . "');";
                mysqli_query($con, $query);
            }
        }
    }

    $res = mysqli_query($con, "SELECT profile_pic FROM user_profile WHERE user_id = (SELECT user_id FROM user_credentials WHERE username = '$username')");                
    

    
    $result= mysqli_fetch_assoc($res);
    $image=$result["profile_pic"];
?>

<html>
    <head>
        <title>
            My Profile | ConnectHub
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
            cursor:context-menu;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

      

        input[type="text"]
           {
              background: transparent;
              width: 350px;
              height:40px;
              border-radius: 2%;
              margin-top:110px;
              cursor:pointer;
              color:aliceblue;
              border-radius: 10em;
              border: 2px solid white;
              padding: 10px;
              text-align: center;
           }
           ::placeholder
           {
            color:aliceblue;
            opacity:0.8;
            font-family: monospace;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
           }
           
           input[type="submit"]
           {
              background-color: whitesmoke;
              width: 100px;
              padding: 9px;
              border-radius: 10em;
              color:black;
           }

  .image{
    border-radius: 50%;
  }
  .profile_image{
          border-radius:50%;
         
        }

        .submit2
        {
            background-color: whitesmoke;
              width: 100px;
              padding: 8px;
              border-radius: 10em;
              color:black;
        }
        #profilepic {
        display: none;
       }

       label[for="profilepic"] {
        border: 2px solid white;
        border-radius: 10em;
        font-size: 13px;
        padding: 10px;
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
            <?php
                   $username = $_SESSION["username"];
                   $con = mysqli_connect("localhost", "root", "Chahat@2003", "project");
                   $res = mysqli_query($con, "SELECT * FROM user_profile WHERE user_id = (SELECT user_id FROM user_credentials WHERE username = '$username')");                
                   $result= mysqli_fetch_assoc($res);
                   $image=$result["profile_pic"];
                   $bio=$result["bio"];
                   echo "<img src='$image' height='185px' width='185px' class='image'> <br>";
                   echo " Username-: $username <br>";
                   echo " CurrentBio-: $bio <br>";
                   ?>
                    <form method="post" action="myprofile.php" enctype="multipart/form-data">
                      <input type="text" name="bio" placeholder="Change your bio">
                      <input type="submit" name="submit" value="Submit"><br><br>
                      <input type="file"  id="profilepic" name="profilepic">
                      <label for="profilepic" >Choose your profile pic</label>
                      <button type="submit" class='submit2' name="submit2">UPLOAD</button>
                    </form>

            
            </div>
        </div>
    </body>
</html>

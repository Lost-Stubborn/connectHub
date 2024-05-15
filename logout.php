<?php
session_start();
if(isset($_POST['submit']))
{
    session_destroy();
    header('Location: /connecthub/login.php');
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
           page to edit bio
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
            font-family:Verdana, Geneva, Tahoma, sans-serif;
            font-size:large;
            overflow:auto;
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
              width: 160px;
              padding: 15px;
              border-radius: 10em;
              color:black;
           }


  .image{
    border-radius: 50%;
  }
  .profile_image{
    border-radius: 50%;
  }

  </style>
<script>
function getConfirmation() {
    var confirmLogout = confirm("Do you really want to logout?");
    console.log("haanjii"); 
    if (confirmLogout) {
        console.log("okokok");
    } else {
        alert("Log-out canceled!");
    }
    return confirmLogout;
}

</script>

 
    </head>

    <body>
       <header style="display:flex; flex-flow: column nowrap; align-items: center; justify-content: center;"><span style="font-family: sans-serif; padding: 5px 10px 5px 10px; color: white;">ConnectHub</span></header>
        <br>
        <div class="container">
            <div class="left">
            <ul>
                <li><img src="socialbook_img/images/profile-home.png" width="30px" srcset=""><a href="index.php">Home</a><br><br></li><br><br>
                <li><img src="socialbook_img/images/search.png" width="30px"> <a href="projectSearchPage.php">Search</a><br><br></li><br><br>
                <li><img src="socialbook_img/images/see-more.png" width="30px" srcset=""><a href="projectExplorePage.php">Explore</a><br><br></li><br><br>
                <li><img src="socialbook_img/images/notification.png" width="30px" srcset=""><a href="projectNotificationPage.php">Notifications</a><br><br></li><br><br>
                <li><img src="socialbook_img/images/upload.png" width="30px" srcset=""><a href="projectCreatePage.php">Create</a><br><br></li><br><br>
                <a href="projectProfilePage.php"><li><img  class="profile_image" src="<?php echo $image; ?>" width="30px" height="30px" srcset="">Profile<br><br></li></a><br><br><br><br><br><br>
                <li><img src="socialbook_img/images/more.png" width="30px" srcset=""><a href="projectMore.php">More</a><br><br></li>
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
                   echo "<img src='$image' height='200px' width='200px' class='image'> <br>";
                   echo " Username-: $username <br>";
                   echo "Bio-: $bio <br><br>";
                   ?> 
                   <form method="post" action="logout.php" onsubmit= "getConfirmation()">
                    <input type= "submit"   value="log out" name="submit">
                   </form>
            </div>
        </div>
    </body>
</html>


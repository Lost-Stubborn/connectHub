<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "Chahat@2003", "project");
    if(!$con)
    {
        echo "failed to connect to database";
        die();
    }
    
    if (isset($_POST["submit"]))
    {
        $username = $_POST["name"];
        $password = $_POST["password"];
    
        $q = "SELECT * FROM user_credentials WHERE username = '$username' AND password = '$password'";
      
        $res = mysqli_query($con, $q);
        if ($res)
        {
            if (mysqli_num_rows($res) == 0)
            {
                echo "<span class='message '>Invalid credentials!</span>";
            }
            else
            {
                $_SESSION["username"]=$username;
                $_SESSION["password"]=$password;
                header('Location: /connecthub/');         
            }
        }
        else echo mysqli_error($con);
    }
    
    mysqli_close($con);
    
?>    


<!DOCTYPE html>
<html>
    <head>
        <title>LOG-IN PAGE</title>
        <style>
            body
            {
                background-color: black;
                text-align: center;
                margin: 0px;
                padding: 0px;
            }    
               
            /* div{
             font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode' Verdana, sans-serif;   
             font-size:3rem;
             margin-top:30px;
            } */ 
            #uname
            {
                margin:20px;
                padding: 50px;
                box-sizing: border-box;
                outline:none;
                font-family:'poppins';
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
           input[type="password"]
           {
              background: transparent; 
              width: 350px;
              height:40px;
              border-radius: 2%;
              cursor:pointer;
              color:aliceblue;
              border-radius: 10em;
              border: 2px solid white;
              padding: 10px;
              text-align: center;
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
            opacity:0.8;
            font-family: monospace;
            font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
           } 
           p
           {
            color: aliceblue;   
             font-size: 13px;
             font-family: Arial, Helvetica, sans-serif;
           }
           a{
            color:rgb(57, 209, 255);
            text-decoration: none;
           } 
            .message{
                display: inline-block;
                color:ghostwhite;
                font-size: 18px;
                font-family: Arial, Helvetica, sans-serif;
                color:crimson;
                margin-top: 10px;
                padding: 10px;
                border: 2px solid crimson;
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

        #loading {
            position: absolute;
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index: 2;
        }    
        </style>
      

    </head>
    <body>
        <div id="loading"><img src="/connecthub/socialbook_img/logo.gif"></div>
       <header style="display:flex; flex-flow: column nowrap; align-items: center; justify-content: center;"><span style="font-family: monospace; padding: 5px 10px 5px 10px; color: black; background-color: white;">ConnectHub</span></header> 
        <br><br><br><br>
        <form name="myform" method="post" action="login.php">
        <input type="text" name="name" id="uid" placeholder="username" required >
        <br><br><br>
        <input type="password" name="password" id="password" placeholder="password" required>    
        <br><br><br>
        <input type="submit" name="submit" value="Login">
        <br>
      
        </form>
        <p>create an account or <a href="signup.php" target="_self">sign-up</a></p>

        <script>
            setTimeout(() => {
                document.getElementById("loading").style.display = "none";
            }, 5000);
        </script>
    </body>
</html>    


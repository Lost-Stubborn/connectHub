<?php
    session_start();
    $con = mysqli_connect("localhost" ,"root" ,"Chahat@2003","project");

    if(!$con)
    {
        echo "failed";
        die();
    }

    if(isset($_POST["submit"]))
    {
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];

        $q="INSERT INTO user_credentials ( username , email , password ) VALUES ('$username', '$email', '$password')"  ;
        
        $result=mysqli_query($con,$q);
    
        if($result){
            $last_id = mysqli_insert_id($con);
            $q2="INSERT INTO user_profile(user_id,bio,profile_pic) VALUES ($last_id , 'Hello!!','/connecthub/socialbook_img/images/feeling.png')";
            mysqli_query($con,$q2);
            $_SESSSION["username"]=$username;
            header("Location: /connecthub/");
        }   
    }

    mysqli_close($con);
?>
<html>
<head>
   <title> SIGN-UP PAGE </title>
   <style>
    body{
        background-color: black;
                text-align: center;}
       
    
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
           input[type="email"]
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
             
        header {
            font-size: 44px;
            font-weight: bold;
            text-align: center;
            width: 100%;
            padding-top: 20px;
            color: white;
            cursor:context-menu;
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
              width: 170px;
              padding: 20px;
              border-radius: 10em;
              color:black;
           }
           p 
           {
            color: aliceblue;   
             font-size: 13px;
             font-family: Arial, Helvetica, sans-serif;
             text-decoration:none;
           }
           p  a
           {
            color:rgb(57, 209, 255);
             font-size: 13px;
             font-family: Arial, Helvetica, sans-serif;
             text-decoration:none;
           }

   </style>
</head>
<body>
    <form name="myform" method="post" action="signup.php" >
        <br>
        <header>Create your ConnectHub Account</header>
        <input type="text" name="username"  placeholder="Create username" required><br><br>
        <input type="email" name="email"  placeholder="Enter Email" required><br><br>
        <input type="password" name="password"  placeholder="Create Password"id="p"><br><br><br>
       
        <input type="submit"  name="submit"  value="Sign-Up">
    </form>
    <p> already have an account?   <a href="Login.php" target="_self">log-in</a></p>

</body>
</html>

<?php

?>
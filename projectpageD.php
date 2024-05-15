<html>
    <head>
            <title>DELETING THE ACCOUNT</title>
            <script>
                function getConfirmation() {
                var confirmLogout = confirm("Do you really want to logout?");
              if (confirmLogout) {
                 } else {
                    alert("Log-out canceled!");
                }
                      return confirmLogout;}
                      </script>


</script>
            <style>
            body
            { background-color: black;
                text-align: center;
               }
               
            div{
             font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode' Verdana, sans-serif;
             font-size:3rem;
             margin-top:30px;
            }
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
             font-size: 13px;
             font-family: Arial, Helvetica, sans-serif;
           }
           a{
            color:rgb(57, 209, 255);
           }
        </style>
    </head>
    <body>
    <form name="myform" method="post" action="projectpageD.php" onsubmit="getConfirmation()" >
        <br>
        <header>Delete your ConnectHub Account</header>
       <input type="text" name="username" placeholder="Enter username" required><br><br>
       <input type="email" name="email"  placeholder="Enter  E-mail"required><br><br>
       <input type="password" name="password" placeholder=" Enter Password" id="p" required><br><br><br>
       
        <input type="submit"  name="submit"    value="Delete Account" >
    </form>
    </body>
</html>

<?php

    $con=mysqli_connect('localhost','root','Chahat@2003','project');

    if(!$con)
    {
        echo "failed to connect to database";
        die();
    }
  

    if(isset($_POST["submit"]))
    {
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
       

        $q= "SELECT * FROM user_credentials  WHERE username = '$username' AND password = '$password' AND email='$email' ";
        $res=mysqli_query($con,$q); 
        if($res)
        {
           if(mysqli_num_rows($res)==0)
           {
            echo "Invalid credentials";
           }
           else{
            mysqli_query($con,"DELETE FROM user_credentials  WHERE username = '$username' AND password = '$password' AND email='$email'");
            echo "SUCCESSFULLY DELETED";
            
           }
        }
       else
       {
        echo "failed bhyiiiii";
       }
    }

?>
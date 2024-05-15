<html>
	<head>
	</head>
		<body>
 			<form action="practice.php" method="post">
			<input type="text" name="name" placeholder="name"><br><br>
			<input type="number" name="age" placeholder="age"><br><br>
			<input type="text" name="course" placeholder="course"><br><br>                    <input type="number" name="sno" placeholder="sno"><br><br>
			<input type="submit" name="submit" value="submit">
			</form>
		</body>
</html>



<?php
$con=mysqli_connect("localhost","root","Chahat@2003","chahat");
if(!$con)
{
die("error occured");
}

if(isset($_POST["submit"]))
{
echo "hello";
$name=$_POST['name'];
$age=$_POST['age'];
$course=$_POST['course'];
$sno=$_POST['sno'];
$sql="INSERT INTO student (Sno. ,Name,Age,Course)VALUES($sno,$name,$age,$course)";
mysqli_query($con,$sql);
}
else
{
   // echo "no data submitted";
    echo mysqli_error($con);
}
mysqli_close($con);

?>



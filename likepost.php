<?php
    session_start();

    header("Content-Type: application/json");

    if (!isset($_SESSION["username"]) || !isset($_GET["post_id"]))
    {
        echo json_encode(["success" => false]);
        die();
    }

    $con = mysqli_connect("localhost","root","Chahat@2003","project");
    if(!$con)
    {
        echo json_encode(["success" => false]);
    }
    
    $pid = $_GET["post_id"];
    $username = $_SESSION["username"];

    $q = "CALL togglelike($pid, '$username', @likeresult);";

    $res = mysqli_query($con, $q);
    if ($res)
    {
        $q = "SELECT @likeresult;";
        $res = mysqli_query($con, $q);

        echo json_encode(["success" => true, "state" => mysqli_fetch_row($res)[0]]);
    }
    else echo json_encode(["success" => false]);
?>

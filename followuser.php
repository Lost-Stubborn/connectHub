<?php
    session_start();
    
    if (!isset($_SESSION["username"], $_GET["target"]))
    {
        echo json_encode(["success" => false]);
        die();
    }

    $con = mysqli_connect("localhost", "root", "Chahat@2003", "project");
    if (!$con)
    {
        echo json_encode(["success" => false]);
        die();
    }

    $query = "CALL toggleuserfollow('" . $_SESSION["username"] . "', '" . $_GET["target"] . "', @followState);";
    $res = mysqli_query($con, $query);
    if ($res)
    {
        echo json_encode([
            "success" => true,
            "state" => mysqli_fetch_row(mysqli_query($con, "SELECT @followState;"))[0] == "1"
        ]);
    }
    else echo json_encode(["success" => false]);

    mysqli_close($con);
?>
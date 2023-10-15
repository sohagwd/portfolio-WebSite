<?php 
    session_start();
    require "../../backend_includes/db.php";
    require "../../backend_includes/functions.php"; 

    if (!userlogin())
    {
        header("Location: ../../login/login.php");
    }

    if (isset($_GET['inactive_id']))
    {
        $id = $_GET['inactive_id'];
        $about_status_de = "UPDATE abouts SET about_status='0'";
        $about_status_dequery = mysqli_query($db,$about_status_de);

        $about_status = "UPDATE abouts SET about_status='1' WHERE id=$id";
        $about_status_query = mysqli_query($db,$about_status);

        if ($about_status_query)
        {
            header("Location: ../education/index.php");
        }
        else {
            die(mysqli_error($db));
        }
    }
    elseif (isset($_GET['active_id']))
    {
        $id = $_GET['active_id'];
        $about_status = "UPDATE abouts SET about_status='0' WHERE id=$id";
        $about_status_query = mysqli_query($db,$about_status);

        if ($about_status_query)
        {
            header("Location: ../education/index.php");
        }
        else {
            die(mysqli_error($db));
        }
    }

?>
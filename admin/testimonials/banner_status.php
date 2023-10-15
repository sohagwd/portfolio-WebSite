<?php 
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 

    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_GET['inactive_id']))
    {
        $id = $_GET['inactive_id'];
        $banner_status_de = "UPDATE banners SET status='0'";
        $banner_status_dequery = mysqli_query($db,$banner_status_de);

        $banner_status = "UPDATE banners SET status='1' WHERE id=$id";
        $banner_status_query = mysqli_query($db,$banner_status);

        if ($banner_status_query)
        {
            header("Location: banner_manage.php");
        }
        else {
            die(mysqli_error($db));
        }
    }
    elseif (isset($_GET['active_id']))
    {
        $id = $_GET['active_id'];
        $banner_status = "UPDATE banners SET status='0' WHERE id=$id";
        $banner_status_query = mysqli_query($db,$banner_status);

        if ($banner_status_query)
        {
            header("Location: banner_manage.php");
        }
        else {
            die(mysqli_error($db));
        }
    }

?>
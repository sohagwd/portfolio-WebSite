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
        $id                 = $_GET['inactive_id'];
        $menu_status        = "UPDATE menus SET status='1' WHERE id=$id";
        $menu_status_query  = mysqli_query($db,$menu_status);

        if ($menu_status_query)
        {
            header("Location: index.php");
        }
        else {
            die(mysqli_error($db));
        }
    }
    elseif (isset($_GET['active_id']))
    {
        $id                 = $_GET['active_id'];
        $menu_status        = "UPDATE menus SET status='0' WHERE id=$id";
        $menu_status_query  = mysqli_query($db,$menu_status);

        if ($menu_status_query)
        {
            header("Location: index.php");
        }
        else {
            die(mysqli_error($db));
        }
    }

?>
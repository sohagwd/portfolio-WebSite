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
        $project_status = "UPDATE projects SET status='1' WHERE id=$id";
        $project_status_query = mysqli_query($db,$project_status);

        if ($project_status_query)
        {
            header("Location: index.php");
        }
        else {
            die(mysqli_error($db));
        }
    }
    elseif (isset($_GET['active_id']))
    {
        $id = $_GET['active_id'];
        $project_status = "UPDATE projects SET status='0' WHERE id=$id";
        $project_status_query = mysqli_query($db,$project_status);

        if ($project_status_query)
        {
            header("Location: index.php");
        }
        else {
            die(mysqli_error($db));
        }
    }

?>
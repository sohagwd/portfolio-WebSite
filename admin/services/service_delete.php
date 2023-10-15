<?php 
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 

    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    $login_user_id    = isset($_COOKIE['login_user']) ? $_COOKIE['login_user'] : $_SESSION['login_user_id'];
    $login_user_data  = "SELECT * FROM users WHERE id=$login_user_id";
    $login_user_query = mysqli_query($db,$login_user_data);
    $login_user_info  = mysqli_fetch_assoc($login_user_query);

    if (isset($_GET['delete_id']))
    {
        if ($login_user_info['user_role'] > 2)
        {
            header("location:javascript://history.go(-1)");
        }
        else {
            $service_id = $_GET['delete_id'];
            $service_info = "SELECT * FROM services WHERE id=$service_id";
            $service_info_query = mysqli_query($db, $service_info);
            $service_data = mysqli_fetch_assoc($service_info_query);

            if (empty($service_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $delete_service = "DELETE FROM services WHERE id=$service_id";
                $delete_service_query = mysqli_query($db, $delete_service);
        
                if ($delete_service_query)
                {
                    $_SESSION['delete_service'] = "Delete successful!";
                    $_SESSION['service_delete'] = "Delete";
            
                    header("Location: index.php");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
    }
    else {
        header("Location: index.php");
    }
    
?>
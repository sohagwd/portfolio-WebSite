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

    if (isset($_GET['inactive_id']))
    {
        if ($login_user_info['user_role'] > 2)
        {
            header("location:javascript://history.go(-1)");
        }
        else {
            $id = $_GET['inactive_id'];
            $service_info = "SELECT * FROM services WHERE id=$id";
            $service_info_query = mysqli_query($db, $service_info);
            $service_data = mysqli_fetch_assoc($service_info_query);
    
            if (empty($service_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $service_count      = "SELECT COUNT(*) AS count_service FROM services WHERE service_status='1'";
                $service_count_query = mysqli_query($db,$service_count);
                $count_allservice = mysqli_fetch_assoc($service_count_query);

                if ($count_allservice['count_service'] < 6)
                {
                    $service_status = "UPDATE services SET service_status='1' WHERE id=$id";
                    $service_status_query = mysqli_query($db,$service_status);
            
                    if ($service_status_query)
                    {
                        header("Location: index.php");
                    }
                    else {
                        die(mysqli_error($db));
                    }
                }
                else {
                    $_SESSION['status_err'] = "Maximum 6 Active Service";
                    header("Location: index.php");
                }
            }
        }
    }
    elseif (isset($_GET['active_id']))
    {
        if ($login_user_info['user_role'] > 2)
        {
            header("location:javascript://history.go(-1)");
        }
        else {
            $id = $_GET['active_id'];
            $service_info = "SELECT * FROM services WHERE id=$id";
            $service_info_query = mysqli_query($db, $service_info);
            $service_data = mysqli_fetch_assoc($service_info_query);

            if (empty($service_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $service_status = "UPDATE services SET service_status='0' WHERE id=$id";
                $service_status_query = mysqli_query($db,$service_status);
        
                if ($service_status_query)
                {
                    header("Location: index.php");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
    }

?>
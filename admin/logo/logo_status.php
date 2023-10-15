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

            $logo_info = "SELECT * FROM logo WHERE id=$id";
            $logo_info_query = mysqli_query($db, $logo_info);
            $logo_data = mysqli_fetch_assoc($logo_info_query);
    
            if (empty($logo_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $logo_count      = "SELECT COUNT(*) AS count_logo FROM logo WHERE status='1'";
                $logo_count_query = mysqli_query($db,$logo_count);
                $count_alllogo = mysqli_fetch_assoc($logo_count_query);

                if ($count_alllogo['count_logo'] < 2)
                {
                    $logo_status = "UPDATE logo SET status='1' WHERE id=$id";
                    $logo_status_query = mysqli_query($db,$logo_status);
            
                    if ($logo_status_query)
                    {
                        header("Location: index.php");
                    }
                    else {
                        die(mysqli_error($db));
                    }
                }
                else {
                    $_SESSION['logo_err'] = "Maximum 2 Active logo";
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

            $logo_info = "SELECT * FROM logo WHERE id=$id";
            $logo_info_query = mysqli_query($db, $logo_info);
            $logo_data = mysqli_fetch_assoc($logo_info_query);

            if (empty($logo_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $logo_status = "UPDATE logo SET status='0' WHERE id=$id";
                $logo_status_query = mysqli_query($db,$logo_status);
        
                if ($logo_status_query)
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
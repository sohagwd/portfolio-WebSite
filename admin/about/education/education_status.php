<?php 
    session_start();
    require "../../backend_includes/db.php";
    require "../../backend_includes/functions.php"; 

    if (!userlogin())
    {
        header("Location: ../../login/login.php");
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
            $edu_info = "SELECT * FROM educations WHERE id=$id";
            $edu_info_query = mysqli_query($db, $edu_info);
            $edu_data = mysqli_fetch_assoc($edu_info_query);
    
            if (empty($edu_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $user_id = $edu_data['user_id'];
                $edu_count = "SELECT COUNT(*) AS count_edu FROM educations WHERE status='1' && user_id=$user_id";
                $edu_count_query = mysqli_query($db,$edu_count);
                $count_alledu = mysqli_fetch_assoc($edu_count_query);

                if ($count_alledu['count_edu'] < 4)
                {
                    $edu_status = "UPDATE educations SET status='1' WHERE id=$id";
                    $edu_status_query = mysqli_query($db,$edu_status);
            
                    if ($edu_status_query)
                    {
                        header("Location: index.php");
                    }
                    else {
                        die(mysqli_error($db));
                    }
                }
                else {
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
            $edu_info = "SELECT * FROM educations WHERE id=$id";
            $edu_info_query = mysqli_query($db, $edu_info);
            $edu_data = mysqli_fetch_assoc($edu_info_query);

            if (empty($edu_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $edu_status = "UPDATE educations SET status='0' WHERE id=$id";
                $edu_status_query = mysqli_query($db,$edu_status);
        
                if ($edu_status_query)
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
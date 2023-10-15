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

    if (isset($_GET['delete_id']))
    {
        if ($login_user_info['user_role'] > 2)
        {
            header("location:javascript://history.go(-1)");
        }
        else {
            $edu_id = $_GET['delete_id'];
            $edu_info = "SELECT * FROM educations WHERE id=$edu_id";
            $edu_info_query = mysqli_query($db, $edu_info);
            $edu_data = mysqli_fetch_assoc($edu_info_query);

            if (empty($edu_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $delete_edu = "DELETE FROM educations WHERE id=$edu_id";
                $delete_edu_query = mysqli_query($db, $delete_edu);
        
                if ($delete_edu_query)
                {
                    if (isset($_GET['info']))
                    {
                        $_SESSION['success_deletetwo'] = "Data delete successful!";
                    }
                    else {
                        $_SESSION['success_delete'] = "Data delete successful!";
                    }
        
                    $_SESSION['delete_edu']    = "Delete successful!";
            
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
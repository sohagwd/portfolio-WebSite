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
            $logo_id = $_GET['delete_id'];
            
            $logo_info = "SELECT * FROM logo WHERE id=$logo_id";
            $logo_info_query = mysqli_query($db, $logo_info);
            $logo_data = mysqli_fetch_assoc($logo_info_query);

            if (empty($logo_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $delete_logo = "DELETE FROM logo WHERE id=$logo_id";
                $delete_logo_query = mysqli_query($db, $delete_logo);
        
                if ($delete_logo_query)
                {
                    $_SESSION['logo_delete'] = "Delete";
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
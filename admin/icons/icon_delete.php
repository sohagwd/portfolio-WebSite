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
            $icon_id = $_GET['delete_id'];
            
            $icon_info = "SELECT * FROM icons WHERE id=$icon_id";
            $icon_info_query = mysqli_query($db, $icon_info);
            $icon_data = mysqli_fetch_assoc($icon_info_query);

            if (empty($icon_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $delete_icon = "DELETE FROM icons WHERE id=$icon_id";
                $delete_icon_query = mysqli_query($db, $delete_icon);
        
                if ($delete_icon_query)
                {
                    $_SESSION['icon_delete'] = "Delete";
            
                    header("Location: icon_add.php");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
    }
    else {
        header("Location: icon_add.php");
    }


    if (isset($_GET['del_id']))
    {
        if ($login_user_info['user_role'] > 2)
        {
            header("location:javascript://history.go(-1)");
        }
        else {
            $icon_id = $_GET['del_id'];
            
            $icon_info = "SELECT * FROM social_icons WHERE id=$icon_id";
            $icon_info_query = mysqli_query($db, $icon_info);
            $icon_data = mysqli_fetch_assoc($icon_info_query);

            if (empty($icon_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $delete_icon = "DELETE FROM social_icons WHERE id=$icon_id";
                $delete_icon_query = mysqli_query($db, $delete_icon);
        
                if ($delete_icon_query)
                {
                    $_SESSION['icon_delete'] = "Delete";
            
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
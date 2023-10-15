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
            $menu_id = $_GET['delete_id'];
            
            $menu_info = "SELECT * FROM menus WHERE id=$menu_id";
            $menu_info_query = mysqli_query($db, $menu_info);
            $menu_data = mysqli_fetch_assoc($menu_info_query);

            if (empty($menu_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $delete_menu = "DELETE FROM menus WHERE id=$menu_id";
                $delete_menu_query = mysqli_query($db, $delete_menu);
        
                if ($delete_menu_query)
                {
                    $_SESSION['delete_menu'] = "Delete successful!";
                    $_SESSION['menu_delete'] = "Delete";
            
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
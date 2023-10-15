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
            $user_id = $_GET['delete_id'];

            $image_delete = "SELECT * FROM banners WHERE id=$user_id";
            $image_delete_query =  mysqli_query($db, $image_delete);
            $img_delete = mysqli_fetch_assoc($image_delete_query);
    
            if (empty($img_delete['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $img_location = "../uploads/banners/".$img_delete['banner_img'];
                unlink($img_location);
            
                $delete_user = "DELETE FROM banners WHERE id=$user_id";
                $delete_user_query = mysqli_query($db, $delete_user);
        
                if ($delete_user_query)
                {
                    $_SESSION['success_delete'] = "Data delete successful!";
                    $_SESSION['delete_banner']    = "Delete successful!";
            
                    header("Location: banner_manage.php");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
    }
    else {
        header("Location: banner_manage.php");
    }

?>
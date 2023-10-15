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
            $brand_id = $_GET['delete_id'];
            $brand_info = "SELECT * FROM brands WHERE id=$brand_id";
            $brand_info_query = mysqli_query($db, $brand_info);
            $brand_data = mysqli_fetch_assoc($brand_info_query);
            
            if (empty($brand_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $link = "../uploads/brands/".$brand_data['brand_img'];
                unlink($link);
                
                $delete_brand = "DELETE FROM brands WHERE id=$brand_id";
                $delete_brand_query = mysqli_query($db, $delete_brand);
        
                if ($delete_brand_query)
                {
                    $_SESSION['brand_delete'] = "Delete";
            
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
<?php 
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 

    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    $login_user_id    = $_SESSION['login_user_id'];
    $login_user_data  = "SELECT * FROM users WHERE id=$login_user_id";
    $login_user_query = mysqli_query($db,$login_user_data);
    $login_user_info  = mysqli_fetch_assoc($login_user_query);

    if (isset($_GET['delete_id']))
    {
        $users_id           = $_GET['delete_id'];
        $edit_post          = "SELECT * FROM users WHERE id=$users_id";
        $edit_post_query    = mysqli_query($db, $edit_post);
        $edit_post_value    = mysqli_fetch_assoc($edit_post_query);
    }

    if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2 )
    {
        if ($edit_post_value['user_role'] == 1 && $login_user_info['user_role'] == 1)
        {
            if (isset($_GET['delete_id']))
            {
                $user_id = $_GET['delete_id'];
                $image_delete = "SELECT * FROM users WHERE id=$user_id";
                $image_delete_query =  mysqli_query($db, $image_delete);
                $img_delete = mysqli_fetch_assoc($image_delete_query);
        
                if (empty($img_delete['id']))
                {
                    header("Location: manage.php");
                }
                else {
                    $img_location = "../uploads/users/".$img_delete['profile_image'];
                    unlink($img_location);
                
                    $delete_user = "DELETE FROM users WHERE id=$user_id";
                    $delete_user_query = mysqli_query($db, $delete_user);
            
                    if ($delete_user_query)
                    {
                        $_SESSION['success_delete'] = "Data delete successful!";
                        $_SESSION['delete_user']    = "Delete successful!";
                
                        header("Location: manage.php");
                    }
                    else {
                        die(mysqli_error($db));
                    }
                }
            }
            else {
                header("Location: manage.php");
            }
        }
        elseif ($login_user_info['user_role'] == 1 && $edit_post_value['user_role'] > 1)
        {
            if (isset($_GET['delete_id']))
            {
                $user_id = $_GET['delete_id'];
                $image_delete = "SELECT * FROM users WHERE id=$user_id";
                $image_delete_query =  mysqli_query($db, $image_delete);
                $img_delete = mysqli_fetch_assoc($image_delete_query);
        
                if (empty($img_delete['id']))
                {
                    header("Location: manage.php");
                }
                else {
                    $img_location = "../uploads/users/".$img_delete['profile_image'];
                    unlink($img_location);
                
                    $delete_user = "DELETE FROM users WHERE id=$user_id";
                    $delete_user_query = mysqli_query($db, $delete_user);
            
                    if ($delete_user_query)
                    {
                        $_SESSION['success_delete'] = "Data delete successful!";
                        $_SESSION['delete_user']    = "Delete successful!";
                
                        header("Location: manage.php");
                    }
                    else {
                        die(mysqli_error($db));
                    }
                }
            }
            else {
                header("Location: manage.php");
            }
        }
        elseif ($login_user_info['user_role'] == 2 && $edit_post_value['user_role'] > 2)
        {
            if (isset($_GET['delete_id']))
            {
                $user_id = $_GET['delete_id'];
                $image_delete = "SELECT * FROM users WHERE id=$user_id";
                $image_delete_query =  mysqli_query($db, $image_delete);
                $img_delete = mysqli_fetch_assoc($image_delete_query);
        
                if (empty($img_delete['id']))
                {
                    header("Location: manage.php");
                }
                else {
            
                    $img_location = "../uploads/users/".$img_delete['profile_image'];
                    unlink($img_location);
                
                    $delete_user = "DELETE FROM users WHERE id=$user_id";
                    $delete_user_query = mysqli_query($db, $delete_user);
            
                    if ($delete_user_query)
                    {
                        $_SESSION['success_delete'] = "Data delete successful!";
                        $_SESSION['delete_user']    = "Delete successful!";
                
                        header("Location: manage.php");
                    }
                    else {
                        die(mysqli_error($db));
                    }
                }
            }
            else {
                header("Location: manage.php");
            }
        }
        else {
            header("Location: manage.php");
        }
    }
    else {
        header("Location: manage.php");
    }

?>
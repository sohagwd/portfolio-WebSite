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

    if (isset($_GET['trash_id']))
    {
        $users_id           = $_GET['trash_id'];
        $edit_post          = "SELECT * FROM users WHERE id=$users_id";
        $edit_post_query    = mysqli_query($db, $edit_post);
        $edit_post_value    = mysqli_fetch_assoc($edit_post_query);
    }

    if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2 )
    {
        if ($edit_post_value['user_role'] == 1 && $login_user_info['user_role'] == 1)
        {
            if (isset($_GET['trash_id']))
            {
                $trash_id = $_GET['trash_id'];
                $user_status = "UPDATE users SET status='1' WHERE id =$trash_id";
                $user_status_query = mysqli_query($db, $user_status);
            
                if ($user_status_query)
                {
                    $_SESSION['trash'] = "Users info now Trashed!";
                    $_SESSION['user_trash'] = "Trashed!";
                    header("Location: manage.php");
                }
                else {
                    die(mysqli_error($db));
                }
            } 
        }
        elseif ($login_user_info['user_role'] == 1 && $edit_post_value['user_role'] > 1)
        {
            if (isset($_GET['trash_id']))
            {
                $trash_id = $_GET['trash_id'];
                $user_status = "UPDATE users SET status='1' WHERE id =$trash_id";
                $user_status_query = mysqli_query($db, $user_status);
            
                if ($user_status_query)
                {
                    $_SESSION['trash'] = "Users info now Trashed!";
                    $_SESSION['user_trash'] = "Trashed!";
                    header("Location: manage.php");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
        elseif ($login_user_info['user_role'] == 2 && $edit_post_value['user_role'] > 2)
        {
            if (isset($_GET['trash_id']))
            {
                $trash_id = $_GET['trash_id'];
                $user_status = "UPDATE users SET status='1' WHERE id =$trash_id";
                $user_status_query = mysqli_query($db, $user_status);
            
                if ($user_status_query)
                {
                    $_SESSION['trash'] = "Users info now Trashed!";
                    $_SESSION['user_trash'] = "Trashed!";
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
    

    if (isset($_GET['restore_id']))
    {
        $user_id            = $_GET['restore_id'];
        $edit_post          = "SELECT * FROM users WHERE id=$user_id";
        $edit_post_query    = mysqli_query($db, $edit_post);
        $edit_post_value    = mysqli_fetch_assoc($edit_post_query);

        if($login_user_info['user_role'] == 2 && $edit_post_value['user_role'] >= 2)
        {
            if($login_user_info['user_role'] == 2 && $edit_post_value['user_role'] == 2)
            {
                header("Location: manage.php");
            }
            elseif($login_user_info['user_role'] == 2 && $edit_post_value['user_role'] > 2)
            {
                $user_status_active = "UPDATE users SET status='0' WHERE id =$user_id";
                $user_status_active_query = mysqli_query($db, $user_status_active);
            
                if ($user_status_active_query)
                {
                    $_SESSION['restore'] = "Users info now Restore!";
                    $_SESSION['user_restore'] = "Restore!";
                    header("Location: manage.php");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
        elseif ($login_user_info['user_role'] == 1 && $edit_post_value['user_role'] >= 1) 
        {
            $user_status_active = "UPDATE users SET status='0' WHERE id =$user_id";
            $user_status_active_query = mysqli_query($db, $user_status_active);
        
            if ($user_status_active_query)
            {
                $_SESSION['restore'] = "Users info now Restore!";
                $_SESSION['user_restore'] = "Restore!";
                header("Location: manage.php");
            }
            else {
                die(mysqli_error($db));
            }
        }
    }


?>
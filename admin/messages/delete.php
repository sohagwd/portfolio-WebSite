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
        if ($login_user_info['user_role'] > 1)
        {
            header("location:javascript://history.go(-1)");
        }
        else {
            $user_id = $_GET['delete_id'];
            $check_msg = "SELECT * FROM messages WHERE id=$user_id";
            $check_msg_query =  mysqli_query($db, $check_msg);
            $count_msgid = mysqli_num_rows($check_msg_query);
    
            if ($count_msgid == 0)
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $delete_msg = "DELETE FROM messages WHERE id=$user_id";
                $delete_msg_query = mysqli_query($db, $delete_msg);
        
                if ($delete_msg_query)
                {
                    $_SESSION['delete_message']    = "Delete successful!";
            
                    header("Location: index.php");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
    }
    else {
        header("location:javascript://history.go(-1)");
    }

?>
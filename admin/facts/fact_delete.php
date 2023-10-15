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
            $fact_id = $_GET['delete_id'];
            $fact_info = "SELECT * FROM facts WHERE id=$fact_id";
            $fact_info_query = mysqli_query($db, $fact_info);
            $fact_data = mysqli_fetch_assoc($fact_info_query);

            if (empty($fact_data['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $delete_fact = "DELETE FROM facts WHERE id=$fact_id";
                $delete_fact_query = mysqli_query($db, $delete_fact);
        
                if ($delete_fact_query)
                {
                    $_SESSION['fact_delete'] = "Delete";
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
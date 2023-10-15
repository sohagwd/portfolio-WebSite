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
            $about_id = $_GET['delete_id'];
            $select_about = "SELECT * FROM abouts WHERE id=$about_id";
            $select_about_query = mysqli_query($db, $select_about);
            $after_assoc = mysqli_fetch_assoc($select_about_query);

            if (empty($after_assoc['id']))
            {
                header("location:javascript://history.go(-1)");
            }
            else {
                $education_id = $after_assoc['user_id'];
                $count_userid_education = "SELECT COUNT(*) AS count_userid FROM educations WHERE user_id=$education_id";
                $count_userid_educationqy = mysqli_query($db, $count_userid_education);
                $after_assoc_userid = mysqli_fetch_assoc($count_userid_educationqy);
        
                $delete_about_educations = $after_assoc_userid['count_userid'];

                for ($i=1; $i <= $delete_about_educations ; $i++) { 
                    $delete_education = "DELETE FROM educations WHERE user_id=$education_id";
                    $delete_education_query = mysqli_query($db, $delete_education);
                }
            
                $img_location = "../../uploads/abouts/".$after_assoc['about_img'];
                unlink($img_location);

                $delete_about = "DELETE FROM abouts WHERE id=$about_id";
                $delete_about_query = mysqli_query($db, $delete_about);
        
                if ($delete_about_query)
                {
                    $_SESSION['about_delete']    = "Data delete successful!";
                    $_SESSION['delete_about']    = "Delete successful!";
            
                    header("Location: ../education/index.php");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
    }
    else {
        header("Location: ../education/index.php");
    }
    
?>
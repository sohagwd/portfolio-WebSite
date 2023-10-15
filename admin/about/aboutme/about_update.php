<?php 
    ob_start();
    session_start();
    require "../../backend_includes/db.php";
    require "../../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../../login/login.php");
    }

    if (isset($_POST['updateAbout']))
    {
        $about_id    = $_POST['about_id'];
        $user_id     = mysqli_real_escape_string($db, $_POST['user_id']);
        $about_desc  = mysqli_real_escape_string($db, $_POST['about_desc']);

        $errors = array();
        $field_names = array(
            "user_id"       => "This field is requried!", 
            "about_desc"    => "This field is requried!",
        );

        foreach ($field_names as $field_name => $message)
        {
            if (empty($_POST[$field_name]))
            {
               $errors[$field_name] = $message;
            }
        }

        if (count($errors) == 0)
        {
            date_default_timezone_set("Asia/Dhaka");
            $created_at     = date("Y-m-d h:i:s a", time());
    
            $uploaded_image     = $_FILES['about_image'];
            $explode_image      = explode('.', $uploaded_image['name']);
            $image_extension    = end($explode_image);
            $allowed_extension  = array("jpeg", "png", "gif", "svg", "jpg", "webp");
    
            if (!empty($uploaded_image['name']))
            {                
                if (in_array($image_extension, $allowed_extension))
                {
                    if ($uploaded_image['size'] < 50000000 )
                    {
                        $image_delete       = "SELECT * FROM abouts WHERE id=$about_id";
                        $image_delete_query =  mysqli_query($db, $image_delete);
                        $img_delete         = mysqli_fetch_assoc($image_delete_query);
                        $img_location       = "../../uploads/abouts/".$img_delete['about_img'];

                        if (!empty($img_delete['about_img']))
                        {
                            unlink($img_location);
                        }

                        $update_aboutme = "UPDATE abouts SET about_desc='$about_desc', user_id='$user_id', created_at='$created_at' WHERE id=$about_id";
                        $update_aboutme_query = mysqli_query($db, $update_aboutme);
    
                        $img_name = $about_id.'.'.$image_extension;
                        $set_img_location = "../../uploads/abouts/".$img_name;
    
                        $update_img = "UPDATE abouts SET about_img='$img_name' WHERE id =$about_id";
                        $update_img_query = mysqli_query($db, $update_img);
    
                        move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);
    
                        if ($update_img_query)
                        {
                            $_SESSION['update_success'] = "Data update successful.";
                            header("Location: about_edit.php?id=$about_id");
                        }
                        else {
                            die(mysqli_error($db));
                        }
                    }
                    else {
                        $_SESSION['img_size']   = "Invalid image size! Upload maximum 50kb.";
                        $_SESSION['err_msg']    = $errors;
                        $_SESSION['user_id']    = $_POST['user_id'];
                        $_SESSION['about_desc'] = $_POST['about_desc'];
                
                        header("Location: about_edit.php?id=$about_id");
                    }
                }
                else {
                    $_SESSION['err_msg']       = $errors;
                    $_SESSION['extension']     = "Invalid extension!";
                    $_SESSION['user_id']    = $_POST['user_id'];
                    $_SESSION['about_desc']    = $_POST['about_desc'];
        
                    header("Location: about_edit.php?id=$about_id");
                }
            }
            else {
                $update_aboutme = "UPDATE abouts SET about_desc='$about_desc', user_id='$user_id', created_at='$created_at' WHERE id=$about_id";
                $update_aboutme_query = mysqli_query($db, $update_aboutme);

                if ($update_aboutme_query)
                {
                    $_SESSION['update_success'] = "Data update successful.";
                    header("Location: about_edit.php?id=$about_id");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
        else {
            $_SESSION['err_msg']       = $errors;
            $_SESSION['user_id']       = $_POST['user_id'];
            $_SESSION['about_desc']    = $_POST['about_desc'];
    
            header("Location: about_edit.php?id=$about_id");
        }
    }
    else {
        header("Location: ../about_skills/about_skill_manage.php");
    }
    ob_end_flush();
?>



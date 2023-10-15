<?php 
    ob_start();
    session_start();
    require "../../backend_includes/db.php";
    require "../../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../../login/login.php");
    }

    if (isset($_POST['addAbout']))
    {
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
                        $insert_aboutme = "INSERT INTO abouts (about_desc, user_id, created_at) VALUES ('$about_desc', '$user_id', '$created_at')";
                        $insert_aboutme_query = mysqli_query($db, $insert_aboutme);
    
                        $insert_id = mysqli_insert_id($db);
                        $img_name = $insert_id.'.'.$image_extension;
                        $set_img_location = "../../uploads/abouts/".$img_name;
    
                        $insert_img = "UPDATE abouts SET about_img='$img_name' WHERE id =$insert_id";
                        $insert_img_query = mysqli_query($db, $insert_img);
    
                        move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);
    
                        if ($insert_img_query)
                        {
                            $_SESSION['success_aboutme'] = "Data insert successful.";
                            header("Location: ../education/education_add.php");
                        }
                        else {
                            die(mysqli_error($db));
                        }
                    }
                    else {
                        $_SESSION['img_size']      = "Invalid image size! Upload maximum 50kb.";
                        $_SESSION['err_msg']       = $errors;
                        $_SESSION['user_id']       = $_POST['user_id'];
                        $_SESSION['about_desc']    = $_POST['about_desc'];

                        header("Location: ../education/education_add.php");
                    }
                }
                else {
                    $_SESSION['err_msg']       = $errors;
                    $_SESSION['extension']     = "Invalid extension!";
                    $_SESSION['user_id']       = $_POST['user_id'];
                    $_SESSION['about_desc']    = $_POST['about_desc'];
            
                    header("Location: ../education/education_add.php");
                }
            }
            else {
                $insert_aboutme = "INSERT INTO abouts (about_desc, user_id, created_at) VALUES ('$about_desc', '$user_id', '$created_at')";
                $insert_aboutme_query = mysqli_query($db, $insert_aboutme);
    
                if ($insert_aboutme_query)
                {
                    $_SESSION['success_aboutme'] = "Data insert successful.";
                    header("Location: ../education/education_add.php");
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
    
            header("Location: ../education/education_add.php");
        }
    }
    else {
        header("Location: ../education/index.php");
    }
    ob_end_flush();

?>



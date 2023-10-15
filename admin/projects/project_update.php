<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['updateProject']))
    {
        $id                 = $_POST['project_id'];
        $uploaded_image     = $_FILES['img'];
        $explode_image      = explode('.', $uploaded_image['name']);
        $image_extension    = end($explode_image);
        $allowed_extension  = array("jpeg", "png", "gif", "svg", "jpg", "webp");

        $desc_title     = mysqli_real_escape_string($db, $_POST['desc_title']);
        $descr          = mysqli_real_escape_string($db, $_POST['descr']);
        $title          = mysqli_real_escape_string($db, $_POST['title']);
        $category       = mysqli_real_escape_string($db, $_POST['category']);
        $user_comment   = mysqli_real_escape_string($db, $_POST['user_comment']);

        $errors = array();
        $field_names = array(
            "desc_title"   => "This field is requried!", 
            "descr"        => "This field is requried!", 
            "title"        => "This field is requried!",
            "category"     => "This field is requried!"
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
            $user_id        = $login_user_id;
                  
            if (!empty($uploaded_image['name']))
            {
                if (in_array($image_extension, $allowed_extension))
                {
                    if ($uploaded_image['size'] < 2000000 )
                    {
                        $image_delete       = "SELECT * FROM projects WHERE id=$id";
                        $image_delete_query =  mysqli_query($db, $image_delete);
                        $img_delete         = mysqli_fetch_assoc($image_delete_query);
                        $img_location       = "../uploads/projects/".$img_delete['img'];

                        $img_name = $id.'.'.$image_extension;
                        $set_img_location = "../uploads/projects/".$img_name;

                        $update_project    = "UPDATE projects SET desc_title='$desc_title', descr='$descr', category='$category', title='$title', img='$img_name', user_comment='$user_comment', created_at='$created_at' WHERE id =$id";
                        $update_project_query = mysqli_query($db, $update_project);
            
                        if ($update_project_query)
                        {
                            unlink($img_location);
                            move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);
                            $_SESSION['update_success'] = "Update is successful.";

                            header("Location: project_edit.php?id=$id");
                        }
                        else {
                            die(mysqli_error($db));
                        }
                    }
                    else {
                        $_SESSION['img_size']      = "Invalid image size! Upload maximum 2mb.";
                        $_SESSION['desc_title']    = $_POST['desc_title'];
                        $_SESSION['descr']         = $_POST['descr'];
                        $_SESSION['title']         = $_POST['title'];
                        $_SESSION['category']      = $_POST['category'];
                        $_SESSION['user_comment']  = $_POST['user_comment'];
            
                        header("Location: project_edit.php?id=$id");
                    }
                }
                else {
                    $_SESSION['extension']     = "Invalid extension!";
                    $_SESSION['desc_title']    = $_POST['desc_title'];
                    $_SESSION['descr']         = $_POST['descr'];
                    $_SESSION['title']         = $_POST['title'];
                    $_SESSION['category']      = $_POST['category'];
                    $_SESSION['user_comment']  = $_POST['user_comment'];
        
                    header("Location: project_edit.php?id=$id");
                }
            }
            else {
                $update_project    = "UPDATE projects SET desc_title='$desc_title', descr='$descr', category='$category', title='$title', user_comment='$user_comment', created_at='$created_at' WHERE id =$id";
                $update_project_query = mysqli_query($db, $update_project);
    
                if ($update_project_query)
                {
                    $_SESSION['update_success'] = "Update is successful.";
                    header("Location: project_edit.php?id=$id");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
        else {
            $_SESSION['err_msg']       = $errors;
            $_SESSION['desc_title']    = $_POST['desc_title'];
            $_SESSION['descr']         = $_POST['descr'];
            $_SESSION['title']         = $_POST['title'];
            $_SESSION['category']      = $_POST['category'];
            $_SESSION['user_comment']  = $_POST['user_comment'];

            header("Location: project_edit.php?id=$id");
        }
    }
    else {
        header("Location: index.php");
    }
    ob_end_flush();

?>
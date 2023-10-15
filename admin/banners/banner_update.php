<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['updatebanner']))
    {
        $id        = $_POST['banner_id'];
        $_SESSION['banner_id'] = $id;

        $first_title    = mysqli_real_escape_string($db, $_POST['first_title']);
        $title          = mysqli_real_escape_string($db, $_POST['title']);
        $desc           = mysqli_real_escape_string($db, $_POST['desc']);
        $button         = mysqli_real_escape_string($db, $_POST['button']);

        $errors = array();
        $field_names = array(
            "first_title"   => "This field is requried!", 
            "title"         => "Title field is requried!", 
            "desc"          => "Description field is requried!",
            "button"        => "Button field is requried!",
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

            $uploaded_image     = $_FILES['banner_image'];
            $explode_image      = explode('.', $uploaded_image['name']);
            $image_extension    = end($explode_image);
            $allowed_extension  = array("jpeg", "png", "gif", "svg", "jpg", "webp");

            if (!empty($uploaded_image['name']))
            {                
                if (in_array($image_extension, $allowed_extension))
                {
                    if ($uploaded_image['size'] < 50000000 )
                    {
                        $image_delete       = "SELECT * FROM banners WHERE id=$id";
                        $image_delete_query =  mysqli_query($db, $image_delete);
                        $img_delete         = mysqli_fetch_assoc($image_delete_query);
                        $img_location       = "../uploads/banners/".$img_delete['banner_img'];

                        $img_name = $id.'.'.$image_extension;

                        $update_banner    = "UPDATE banners SET first_title='$first_title',  title='$title', description='$desc', button='$button',  banner_img='$img_name', created_at='$created_at' WHERE id =$id";
                        $update_banner_query = mysqli_query($db, $update_banner);

                        if ($update_banner_query)
                        {
                            unlink($img_location);
                            $set_img_location = "../uploads/banners/".$img_name;
                            move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);
                            $_SESSION['update_success'] = "Update is successful.";

                            header("Location: banner_edit.php?id=$id");
                        }
                        else {
                            die(mysqli_error($db));
                        } 
                    }
                    else {
                        $_SESSION['img_size']       = "Invalid image size! Upload maximum 50kb.";
                        $_SESSION['err_msg']        = $errors;
                        $_SESSION['first_title']    = $_POST['first_title'];
                        $_SESSION['title']          = $_POST['title'];
                        $_SESSION['desc']           = $_POST['desc'];
                        $_SESSION['button']         = $_POST['button'];

                        header("Location: banner_edit.php?id=$id");
                    }
                }
                else {
                    $_SESSION['extension']      = "Invalid extension!";
                    $_SESSION['err_msg']        = $errors;
                    $_SESSION['first_title']    = $_POST['first_title'];
                    $_SESSION['title']          = $_POST['title'];
                    $_SESSION['desc']           = $_POST['desc'];
                    $_SESSION['button']         = $_POST['button'];

                    header("Location: banner_edit.php?id=$id");
                }
            }
            else {
                $update_banner    = "UPDATE banners SET first_title='$first_title', title='$title', description='$desc', button='$button', created_at='$created_at' WHERE id =$id";
                $update_banner_query = mysqli_query($db, $update_banner);
    
                if ($update_banner_query)
                {
                    $_SESSION['update_success'] = "Update is successful.";
                    header("Location: banner_edit.php?id=$id");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
        else {
            $_SESSION['err_msg']        = $errors;
            $_SESSION['first_title']    = $_POST['first_title'];
            $_SESSION['title']          = $_POST['title'];
            $_SESSION['desc']           = $_POST['desc'];
            $_SESSION['button']         = $_POST['button'];

            header("Location: banner_edit.php?id=$id");
        }
    }
    else {
        header("Location: banner_manage.php");
    }
    ob_end_flush();

?>
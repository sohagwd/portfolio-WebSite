<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['addbanner']))
    {
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
                        $insert_banner = "INSERT INTO banners (first_title, title, description, button, created_at) VALUES ('$first_title', '$title', '$desc', '$button', '$created_at')";
                        $insert_banner_query = mysqli_query($db, $insert_banner);

                        $insert_id = mysqli_insert_id($db);
                        $img_name = $insert_id.'.'.$image_extension;
                        $set_img_location = "../uploads/banners/".$img_name;

                        $insert_img = "UPDATE banners SET banner_img='$img_name' WHERE id =$insert_id";
                        $insert_img_query = mysqli_query($db, $insert_img);

                        move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);

                        if ($insert_img_query)
                        {
                            $_SESSION['success'] = "Data insert successful.";
                            header("Location: banner_add.php");
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

                        header("Location: banner_add.php");
                    }
                }
                else {
                    $_SESSION['extension']      = "Invalid extension!";
                    $_SESSION['err_msg']        = $errors;
                    $_SESSION['first_title']    = $_POST['first_title'];
                    $_SESSION['title']          = $_POST['title'];
                    $_SESSION['desc']           = $_POST['desc'];
                    $_SESSION['button']         = $_POST['button'];

                    header("Location: banner_add.php");
                }
            }
            else {
                $insert_banner = "INSERT INTO banners (first_title, title, description, button, created_at) VALUES ('$first_title', '$title', '$desc', '$button', '$created_at')";
                $insert_banner_query = mysqli_query($db, $insert_banner);

                if ($insert_banner_query)
                {
                    $_SESSION['success'] = "Data insert successful.";
                    header("Location: banner_add.php");
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

            header("Location: banner_add.php");
        }
    }
    else {
        header("Location: banner_manage.php");
    }
    ob_end_flush();

?>
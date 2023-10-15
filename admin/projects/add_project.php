<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    $login_user_id    = isset($_COOKIE['login_user']) ? $_COOKIE['login_user'] : $_SESSION['login_user_id'];

    if (isset($_POST['addProject']))
    {
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

        if (empty($uploaded_image['name']))
        {
            $errors['img'] = "This field is requried!";
        }

        if (count($errors) == 0)
        {
            date_default_timezone_set("Asia/Dhaka");
            $created_at     = date("Y-m-d h:i:s a", time());
            $user_id        = $login_user_id;
                  
            if (in_array($image_extension, $allowed_extension))
            {
                if ($uploaded_image['size'] < 2000000 )
                {
                    $insert_project = "INSERT INTO projects (desc_title, descr, category, title,user_id, user_comment, created_at) VALUES ('$desc_title', '$descr', '$category', '$title', '$user_id', '$user_comment', '$created_at')";
                    $insert_project_query = mysqli_query($db, $insert_project);

                    $insert_id = mysqli_insert_id($db);
                    $img_name = $insert_id.'.'.$image_extension;
                    $set_img_location = "../uploads/projects/".$img_name;

                    $insert_img = "UPDATE projects SET img='$img_name' WHERE id =$insert_id";
                    $insert_img_query = mysqli_query($db, $insert_img);

                    move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);

                    if ($insert_img_query)
                    {
                        $_SESSION['success'] = "Data insert successful.";
                        header("Location: project_add.php");
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
        
                    header("Location: project_add.php");
                }
            }
            else {
                $_SESSION['extension']     = "Invalid extension!";
                $_SESSION['desc_title']    = $_POST['desc_title'];
                $_SESSION['descr']         = $_POST['descr'];
                $_SESSION['title']         = $_POST['title'];
                $_SESSION['category']      = $_POST['category'];
                $_SESSION['user_comment']  = $_POST['user_comment'];
    
                header("Location: project_add.php");
            }
        }
        else {
            $_SESSION['err_msg']       = $errors;
            $_SESSION['desc_title']    = $_POST['desc_title'];
            $_SESSION['descr']         = $_POST['descr'];
            $_SESSION['title']         = $_POST['title'];
            $_SESSION['category']      = $_POST['category'];
            $_SESSION['user_comment']  = $_POST['user_comment'];

            header("Location: project_add.php");
        }
    }
    else {
        header("Location: index.php");
    }
    ob_end_flush();

?>
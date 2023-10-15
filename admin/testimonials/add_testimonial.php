<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['addTestimonial']))
    {
        $name    = mysqli_real_escape_string($db, $_POST['name']);
        $quotes  = mysqli_real_escape_string($db, $_POST['quotes']);

        $errors = array();
        $field_names = array(
            "name"   => "This field is requried!", 
            "quotes" => "This field is requried!", 
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

            $uploaded_image     = $_FILES['img'];
            $explode_image      = explode('.', $uploaded_image['name']);
            $image_extension    = end($explode_image);
            $allowed_extension  = array("jpeg", "png", "gif", "svg", "jpg", "webp");

            if (!empty($uploaded_image['name']))
            {                
                if (in_array($image_extension, $allowed_extension))
                {
                    if ($uploaded_image['size'] < 2000000 )
                    {
                        $insert_testimonial = "INSERT INTO testimonials (name, quotes, created_at) VALUES ('$name', '$quotes', '$created_at')";
                        $insert_testimonial_query = mysqli_query($db, $insert_testimonial);

                        $insert_id = mysqli_insert_id($db);
                        $img_name = $insert_id.'.'.$image_extension;
                        $set_img_location = "../uploads/testimonials/".$img_name;

                        $insert_img = "UPDATE testimonials SET img='$img_name' WHERE id =$insert_id";
                        $insert_img_query = mysqli_query($db, $insert_img);

                        move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);

                        if ($insert_img_query)
                        {
                            $_SESSION['success'] = "Data insert successful.";
                            header("Location: testimonial_add.php");
                        }
                        else {
                            die(mysqli_error($db));
                        }
                    }
                    else {
                        $_SESSION['img_size']       = "Invalid image size! Upload maximum 2mb.";
                        $_SESSION['name']           = $_POST['name'];
                        $_SESSION['quotes']         = $_POST['quotes'];
    
                        header("Location: testimonial_add.php");
                    }
                }
                else {
                    $_SESSION['extension']      = "Invalid extension!";
                    $_SESSION['name']           = $_POST['name'];
                    $_SESSION['quotes']         = $_POST['quotes'];

                    header("Location: testimonial_add.php");
                }
            }
            else {
                $insert_testimonial = "INSERT INTO testimonials (name, quotes, created_at) VALUES ('$name', '$quotes', '$created_at')";
                $insert_testimonial_query = mysqli_query($db, $insert_testimonial);

                if ($insert_testimonial_query)
                {
                    $_SESSION['success'] = "Data insert successful.";
                    header("Location: testimonial_add.php");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
        else {
            $_SESSION['err_msg']    = $errors;
            $_SESSION['name']       = $_POST['name'];
            $_SESSION['quotes']     = $_POST['quotes'];

            header("Location: testimonial_add.php");
        }
    }
    else {
        header("Location: index.php");
    }
    ob_end_flush();

?>
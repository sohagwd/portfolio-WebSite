<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['updateTestimonial']))
    {   
        $id      = $_POST['testimonial_id'];
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
                        $image_delete       = "SELECT * FROM testimonials WHERE id=$id";
                        $image_delete_query =  mysqli_query($db, $image_delete);
                        $img_delete         = mysqli_fetch_assoc($image_delete_query);
                        $img_location       = "../uploads/testimonials/".$img_delete['img'];

                        $img_name = $id.'.'.$image_extension;

                        $update_testimonial = "UPDATE testimonials SET name='$name', quotes='$quotes', img='$img_name', created_at='$created_at' WHERE id=$id";
                        $update_testimonial_query = mysqli_query($db, $update_testimonial);

                        if ($update_testimonial_query)
                        {   
                            unlink($img_location);
                            $set_img_location = "../uploads/testimonials/".$img_name;
                            move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);
                            
                            $_SESSION['success'] = "Data update successful.";

                            header("Location: testimonial_edit.php?id=$id");
                        }
                        else {
                            die(mysqli_error($db));
                        }
                    }
                    else {
                        $_SESSION['img_size']       = "Invalid image size! Upload maximum 2mb.";
                        $_SESSION['name']           = $_POST['name'];
                        $_SESSION['quotes']         = $_POST['quotes'];
    
                        header("Location: testimonial_edit.php?id=$id");
                    }
                }
                else {
                    $_SESSION['extension']      = "Invalid extension!";
                    $_SESSION['name']           = $_POST['name'];
                    $_SESSION['quotes']         = $_POST['quotes'];

                    header("Location: testimonial_edit.php?id=$id");
                }
            }
            else {
                $update_testimonial = "UPDATE testimonials SET name='$name', quotes='$quotes', created_at='$created_at' WHERE id=$id";
                $update_testimonial_query = mysqli_query($db, $update_testimonial);

                if ($update_testimonial_query)
                {
                    $_SESSION['success'] = "Data update successful.";
                    header("Location: testimonial_edit.php?id=$id");
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

            header("Location: testimonial_edit.php?id=$id");
        }
    }
    else {
        header("Location: index.php");
    }
    ob_end_flush();

?>
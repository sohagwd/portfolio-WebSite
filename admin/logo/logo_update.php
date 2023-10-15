<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['updateLogo']))
    {
        $img_cat = $_POST['img_cat'];
        $update_id = $_POST['update_id'];

        date_default_timezone_set("Asia/Dhaka");
        $created_at     = date("Y-m-d h:i:s a", time());

        $uploaded_image     = $_FILES['logo'];
        $explode_image      = explode('.', $uploaded_image['name']);
        $image_extension    = end($explode_image);
        $allowed_extension  = array("jpeg", "png", "gif", "svg", "jpg", "webp");

        $errors = array();
        $field_names = array(
            "img_cat"     => "This field is requried!",
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
            if (!empty($uploaded_image['name']))
            {  
                if (in_array($image_extension, $allowed_extension))
                {
                    if ($uploaded_image['size'] < 1000000 )
                    {
                        $image_delete       = "SELECT * FROM logo WHERE id=$update_id";
                        $image_delete_query =  mysqli_query($db, $image_delete);
                        $img_delete         = mysqli_fetch_assoc($image_delete_query);
                        $img_location       = "../uploads/logo/".$img_delete['logo_name'];
                        $img_name           = $update_id.'.'.$image_extension;
        
                        $update_logo    = "UPDATE logo SET logo_name='$img_name', img_cat='$img_cat', created_at='$created_at' WHERE id =$update_id";
                        $update_logo_query = mysqli_query($db, $update_logo);

                        if ($update_logo_query)
                        {
                            unlink($img_location);
                            $set_img_location = "../uploads/logo/".$img_name;
                            move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);

                            $_SESSION['success'] = "Update is successful.";
                            header("Location: logo_edit.php?id=$update_id");
                        }
                        else {
                            die(mysqli_error($db));
                        } 
                    }
                    else {
                        $_SESSION['img_size']  = "Invalid image size! Upload maximum 1mb.";
                        header("Location: logo_edit.php?id=$update_id");
                    }
                }
                else {
                    $_SESSION['extension']  = "Invalid extension!";
                    header("Location: logo_edit.php?id=$update_id");
                }
            }
            else {
                $update_logo    = "UPDATE logo SET img_cat='$img_cat', created_at='$created_at' WHERE id =$update_id";
                $update_logo_query = mysqli_query($db, $update_logo);

                if ($update_logo_query)
                {
                    $_SESSION['success'] = "Data update successful.";
                    header("Location: logo_edit.php?id=$update_id");
                }
                else {
                    die(mysqli_error($db));
                }
            }
        }
        else {
            $_SESSION['err_msg']    = $errors;
            $_SESSION['img_cat']    = $_POST['img_cat'];

            header("Location: logo_edit.php?id=$update_id");
        }
    }
    else { ?>
        <script>
            window.history.back();
            location.reload(); 
        </script>
    <?php }
    ob_end_flush();
?>
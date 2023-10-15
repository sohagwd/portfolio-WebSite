<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['addLogo']))
    {
        $img_cat = $_POST['img_cat'];

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

        if (count($errors) == 0 && !empty($uploaded_image['name']))
        {
            if (in_array($image_extension, $allowed_extension))
            {
                if ($uploaded_image['size'] < 50000000 )
                {
                    $insert_logo = "INSERT INTO logo (logo_name, img_cat, created_at) VALUES ('$image_extension', '$img_cat', '$created_at')";
                    $insert_logo_query = mysqli_query($db, $insert_logo);

                    $insert_id = mysqli_insert_id($db);
                    $img_name = $insert_id.'.'.$image_extension;
                    $set_img_location = "../uploads/logo/".$img_name;

                    $insert_img = "UPDATE logo SET logo_name='$img_name' WHERE id =$insert_id";
                    $insert_img_query = mysqli_query($db, $insert_img);

                    move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);

                    if ($insert_img_query)
                    {
                        $_SESSION['success'] = "Data insert successful.";
                        header("Location: logo_add.php");
                    }
                    else {
                        die(mysqli_error($db));
                    }
                }
                else {
                    $_SESSION['img_size']  = "Invalid image size! Upload maximum 1mb.";
                    header("Location: logo_add.php");
                }
            }
            else {
                $_SESSION['extension']  = "Invalid extension!";
                header("Location: logo_add.php");
            }
        }
        else {
            $_SESSION['err_msg']    = $errors;
            $_SESSION['img_cat']    = $_POST['img_cat'];

            if (empty($uploaded_image['name']))
            {
                $_SESSION['img_empty'] = "This field is requried!";
            }
            header("Location: logo_add.php");
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
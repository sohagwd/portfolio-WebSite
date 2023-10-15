<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['addBrand']))
    {
        date_default_timezone_set("Asia/Dhaka");
        $created_at     = date("Y-m-d h:i:s a", time());

        $uploaded_image     = $_FILES['brand_img'];
        $explode_image      = explode('.', $uploaded_image['name']);
        $image_extension    = end($explode_image);
        $allowed_extension  = array("jpeg", "png", "gif", "svg", "jpg", "webp");

        if (!empty($uploaded_image['name']))
        {                
            if (in_array($image_extension, $allowed_extension))
            {
                if ($uploaded_image['size'] < 1000000 )
                {
                    $insert_brand = "INSERT INTO brands (brand_img, created_at) VALUES ('$image_extension', '$created_at')";
                    $insert_brand_query = mysqli_query($db, $insert_brand);

                    $insert_id = mysqli_insert_id($db);
                    $img_name = $insert_id.'.'.$image_extension;
                    $set_img_location = "../uploads/brands/".$img_name;

                    $insert_img = "UPDATE brands SET brand_img='$img_name' WHERE id =$insert_id";
                    $insert_img_query = mysqli_query($db, $insert_img);

                    move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);

                    if ($insert_img_query)
                    {
                        $_SESSION['success'] = "Data insert successful.";
                        header("Location: brand_add.php");
                    }
                    else {
                        die(mysqli_error($db));
                    }
                }
                else {
                    $_SESSION['img_size']  = "Invalid image size! Upload maximum 1mb.";
                    header("Location: brand_add.php");
                }
            }
            else {
                $_SESSION['extension']  = "Invalid extension!";
                header("Location: brand_add.php");
            }
        }
        else {
            $_SESSION['brand_img'] = "This field is requried!";
            header("Location: brand_add.php");
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
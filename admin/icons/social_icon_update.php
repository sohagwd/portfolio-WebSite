<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['updateSicon']))
    {
        $sicon      = $_POST['social_id'];
        $icon_id    = mysqli_real_escape_string($db, $_POST['icon_id']);
        $link       = mysqli_real_escape_string($db, $_POST['link']);

        $errors = array();
        $field_names = array(
            "icon_id"   => "This field is requried!"
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

            $update_social_icon = "UPDATE social_icons SET icons_id='$icon_id', link='$link', created_at='$created_at' WHERE id=$sicon";
            $update_social_icon_query = mysqli_query($db, $update_social_icon);
            
            if ($update_social_icon_query)
            {
                $_SESSION['success'] = "Data update successful.";
                header("Location: social_icon_edit.php?id=$sicon");
            }
            else {
                die(mysqli_error($db));
            }           
        }
        else {
            $_SESSION['err_msg']   = $errors;
            $_SESSION['icon_id']   = $_POST['icon_id'];
            $_SESSION['link']      = $_POST['link'];

            header("Location: social_icon_edit.php?id=$sicon");
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
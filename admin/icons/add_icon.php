<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['addIcon']))
    {
        $icon_code   = mysqli_real_escape_string($db, $_POST['icon_code']);

        $errors = array();
        $field_names = array(
            "icon_code"   => "This field is requried!"
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

            $insert_icon = "INSERT INTO icons (icon_code, created_at) VALUES ('$icon_code', '$created_at')";
            $insert_icon_query = mysqli_query($db, $insert_icon);
            
            if ($insert_icon_query)
            {
                $_SESSION['success'] = "Data insert successful.";
                header("Location: icon_add.php");
            }
            else {
                die(mysqli_error($db));
            }          
        }
        else {
            $_SESSION['err_msg']   = $errors;
            $_SESSION['icon_code'] = $_POST['icon_code'];

            header("Location: icon_add.php");
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
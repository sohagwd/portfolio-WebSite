<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['updateMenu']))
    {
        $id        = $_POST['menu_id'];
        $name      = mysqli_real_escape_string($db, $_POST['name']);
        $link      = mysqli_real_escape_string($db, $_POST['link']);

        $errors = array();
        $field_names = array(
            "name"     => "This field is requried!"
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

            $update_menu = "UPDATE menus SET name='$name', link='$link', created_at='$created_at' WHERE id=$id";
            $update_menu_query = mysqli_query($db, $update_menu);
            
            if ($update_menu_query)
            {
                $_SESSION['success'] = "Data update successful.";
                header("Location: menu_edit.php?id=$id");
            }
            else {
                die(mysqli_error($db));
            }
        }
        else {
            $_SESSION['err_msg']   = $errors;
            $_SESSION['name']      = $_POST['name'];

            header("Location: menu_edit.php?id=$id");
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
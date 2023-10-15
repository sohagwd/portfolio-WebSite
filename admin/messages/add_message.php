<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['addmessage']))
    {
        $name     = mysqli_real_escape_string($db, $_POST['name']);
        $email    = mysqli_real_escape_string($db, $_POST['email']);
        $msg_mail = mysqli_real_escape_string($db, $_POST['message']);

        $errors = array();
        $field_names = array(
            "name"    => "This field is requried!", 
            "email"   => "This field is requried!",
            "message" => "This field is requried!",
        );

        foreach ($field_names as $field_name => $message)
        {
            if (empty($_POST[$field_name]))
            {
               $errors[$field_name] = $message;
            }
            elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
            {
                $errors['email_inva'] = "Email not valid";
            }
        }

        if (count($errors) == 0)
        {
            date_default_timezone_set("Asia/Dhaka");
            $created_at     = date("Y-m-d h:i:s a", time());

            $insert_msg = "INSERT INTO messages (name, email, message, created_at) VALUES ('$name', '$email', '$msg_mail', '$created_at')";
            $insert_msg_query = mysqli_query($db, $insert_msg);

            if ($insert_msg_query)
            {
                $_SESSION['success_mail'] = "Email insert successful.";
                header("Location: ../../index.php#contact");
            }
            else {
                die(mysqli_error($db));
            }
        }
        else {
            $_SESSION['err_msg'] = $errors;
            $_SESSION['name']    = $_POST['name'];
            $_SESSION['email']   = $_POST['email'];
            $_SESSION['message'] = $_POST['message'];

            header("Location: ../../index.php#contact");
        }
    }
    else {
        header("Location: index.php");
    }
    ob_end_flush();

?>
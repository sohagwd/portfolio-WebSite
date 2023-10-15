<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['addOffice']))
    {
        $office_add  = mysqli_real_escape_string($db, $_POST['office_add']);
        $number      = mysqli_real_escape_string($db, $_POST['number']);
        $email       = mysqli_real_escape_string($db, $_POST['email']);
        $info        = mysqli_real_escape_string($db, $_POST['info']);
        $office_city = mysqli_real_escape_string($db, $_POST['office_city']);
        $city_add    = mysqli_real_escape_string($db, $_POST['city_add']);
        $city_num    = mysqli_real_escape_string($db, $_POST['city_num']);

        $errors = array();
        $field_names = array(
            "office_add"   => "This field is requried!", 
            "number"       => "This field is requried!", 
            "email"        => "This field is requried!",
            "info"         => "This field is requried!",
        );

        foreach ($field_names as $field_name => $message)
        {
            if (empty($_POST[$field_name]))
            {
               $errors[$field_name] = $message;
            }
        }

        if (!empty($office_city) || !empty($city_add) || !empty($city_num))
        {
            $field_name = array(
                "office_city"  => "This field is requried!", 
                "city_add"     => "This field is requried!", 
                "city_num"     => "This field is requried!",
            );
    
            foreach ($field_name as $field => $msg)
            {
                if (empty($_POST[$field]))
                {
                   $errors[$field] = $msg;
                }
            }
        }

        if (count($errors) == 0)
        {
            date_default_timezone_set("Asia/Dhaka");
            $created_at     = date("Y-m-d h:i:s a", time());
            $insert_office = "INSERT INTO address (info, office_add, number, email, office_city, city_num, city_add, created_at) VALUES ('$info', '$office_add', '$number', '$email', '$office_city', '$city_num', '$city_add', '$created_at')";
            $insert_office_query = mysqli_query($db, $insert_office);

            if ($insert_office_query)
            {
                $_SESSION['success'] = "Data insert successful.";
                header("Location: office_add.php");
            }
            else {
                die(mysqli_error($db));
            }
        }
        else {
            $_SESSION['err_msg']       = $errors;
            $_SESSION['office_add']    = $_POST['office_add'];
            $_SESSION['number']        = $_POST['number'];
            $_SESSION['email']         = $_POST['email'];
            $_SESSION['office_city']   = $_POST['office_city'];
            $_SESSION['city_add']      = $_POST['city_add'];
            $_SESSION['city_num']      = $_POST['city_num'];
            $_SESSION['info']          = $_POST['info'];
            header("Location: office_add.php");
        }
    }
    else {
        header("Location: index.php");
    }
    ob_end_flush();

?>
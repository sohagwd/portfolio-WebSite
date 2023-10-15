<?php 
    ob_start();
    session_start();
    require "../../backend_includes/db.php";
    require "../../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../../login/login.php");
    }

    if (isset($_POST['addEducation']))
    {
        $subject     = mysqli_real_escape_string($db, $_POST['subject']);
        $years       = mysqli_real_escape_string($db, $_POST['years']);
        $percent     = mysqli_real_escape_string($db, $_POST['percent']);
        $user_id     = mysqli_real_escape_string($db, $_POST['users_id']);

        $errors = array();
        $field_names = array(
            "subject"     => "This field is requried!",
            "years"       => "This field is requried!",
            "users_id"    => "This field is requried!",
        );

        foreach ($field_names as $field_name => $message)
        {
            if (empty($_POST[$field_name]))
            {
               $errors[$field_name] = $message;
            }

            if ($_POST['percent'] == 0) {
                
            }
            elseif (empty($_POST['percent'])) {

                $errors['percent'] = "This field is requried!";
            }

            if (($_POST['percent'] <= 0 || $_POST['percent'] > 100) && $_POST['percent'] != NULL)
            {
                $errors['invalid_number'] = "Your number is invalid";
            }
        }

        if (count($errors) == 0)
        {
            date_default_timezone_set("Asia/Dhaka");
            $created_at     = date("Y-m-d h:i:s a", time());

            $insert_edu = "INSERT INTO educations (subject, percent, years, user_id, created_at) VALUES ('$subject', '$percent', '$years', '$user_id', '$created_at')";
            $insert_edu_query = mysqli_query($db, $insert_edu);

            if ($insert_edu_query)
            {
                $_SESSION['success'] = "Data insert successful.";
                header("Location: education_add.php");
            }
            else {
                die(mysqli_error($db));
            }
        }
        else {
            $_SESSION['err_msg']   = $errors;
            $_SESSION['subject']   = $_POST['subject'];
            $_SESSION['years']     = $_POST['years'];
            $_SESSION['percent']   = $_POST['percent'];
            $_SESSION['users_id']  = $_POST['users_id'];

            header("Location: education_add.php");
        }
    }
    else {
        header("Location: index.php");
    }
    ob_end_flush();

?>
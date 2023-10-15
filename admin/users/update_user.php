<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";

    if (isset($_POST['update']))
    {
        $_SESSION['user_id'] = $_POST['user_id'];
        $pass_checkid = $_POST['user_id'];

        $user_pass_check = "SELECT * FROM users WHERE id=$pass_checkid";
        $user_pass_check_query = mysqli_query($db, $user_pass_check);
        $password_value = mysqli_fetch_assoc($user_pass_check_query);

        $err_password   = $_POST['password'];
        $con_password   = $_POST['cpassword'];
        $password_old   = $_POST['password_old'];
        $upper_case     = preg_match("@[A-Z]@", $err_password);
        $lower_case     = preg_match("@[a-z]@", $err_password);
        $number         = preg_match("@[a-z]@", $err_password);
        $special        = preg_match("@[^\w]@", $err_password);

        $errors = array();
        $field_names = array(
            "name"          => "Name is requried!", 
            "email"         => "Email is requried!",
            "select"        => "User role is requried!", 
        );

        foreach ($field_names as $field_name => $message)
        {
            if (empty($_POST[$field_name]))
            {
               $errors[$field_name] = $message;
            }
            elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $errors['err_email'] = "You Email is invalid.";
            }
        }

        if (!empty($password_old) || !empty($err_password) || !empty($con_password))
        {
            $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $pass_vaild_check = array(
                "password"      => "New Password is requried!",
                "password_old"  => "This field is requried!",
            );


            foreach ($pass_vaild_check as $field_namecheck => $messagecheck)
            {
                if (empty($_POST[$field_namecheck]))
                {
                   $errors[$field_namecheck] = $messagecheck;
                }
                
                if (!$upper_case || !$lower_case || !$number || !$special || strlen($err_password) < 8)
                {
                    $err_msg = "Make your password stronger. You have must type Upper-case! Lower-case! Special-Chars & Minimum 8 Digit charecter.";
                    $errors['error_password'] = $err_msg;
                }
    
                if ($err_password !== $con_password)
                {
                    $errors['error_cpassword'] = "Password does not match!";
                }
            }

            if (!password_verify($password_old, $password_value['password']) && !empty($password_old))
            {
                $errors['old_pass'] = "Old Password does not match!";
            }
    
            if (!empty($err_password)) 
            {
                if (empty($con_password))
                {
                    $errors['cpassword'] = "Confirm Password is requried!";
                }
            }
        }
        else {
            $password   = $password_value['password'];
        }

        if (count($errors) == 0)
        {
            $name       = $_POST['name'];
            $email      = $_POST['email'];
            $user_role  = $_POST['select'];

            date_default_timezone_set("Asia/Dhaka");
            $created_at     = date("Y-m-d h:i:s", time());
            $update_user_id = $_SESSION['user_id'];

            $check_useremail_exist = "SELECT * FROM users WHERE ID NOT IN ($update_user_id) AND email='$email'";
            $check_useremail_exist_query = mysqli_query($db,$check_useremail_exist);
            $email_row_count = mysqli_num_rows($check_useremail_exist_query);

            $uploaded_image     = $_FILES['profile_image'];
            $explode_image      = explode('.', $uploaded_image['name']);
            $image_extension    = end($explode_image);
            $allowed_extension  = array("jpeg", "png", "gif", "svg", "jpg", "webp");

            if ($email_row_count == 0)
            {
                if (!empty($uploaded_image['name']))
                {                
                    if (in_array($image_extension, $allowed_extension))
                    {
                        if ($uploaded_image['size'] < 500000 )
                        {
                            $user_password_verify = "SELECT * FROM users WHERE id=$update_user_id";
                            $user_password_verify_query = mysqli_query($db,$user_password_verify);
                            $user_password_check = mysqli_fetch_assoc($user_password_verify_query);

                            if (password_verify($err_password,$user_password_check['password']) || (strlen($err_password) == 60))
                            {
                                $image_delete       = "SELECT * FROM users WHERE id=$update_user_id";
                                $image_delete_query =  mysqli_query($db, $image_delete);
                                $img_delete         = mysqli_fetch_assoc($image_delete_query);
                                $img_location       = "../uploads/users/".$img_delete['profile_image'];
    
                                $img_name = $update_user_id.'.'.$image_extension;
    
                                $update_user    = "UPDATE users SET name='$name', email='$email', user_role='$user_role', profile_image='$img_name', created_at='$created_at' WHERE id =$update_user_id";
                                $update_user_query = mysqli_query($db, $update_user);
    
                                if ($update_user_query)
                                {
                                    unlink($img_location);
                                    $set_img_location = "../uploads/users/".$img_name;
                                    move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);
        
                                    $_SESSION['update_success'] = "Update is successful.";
                                    $_SESSION['update_password'] = "Password not Updated.";
                                    header("Location: edit_user.php?id=".$_SESSION['user_id']);
                                }
                                else {
                                    die(mysqli_error($db));
                                }  
                            }
                            else {
                                $image_delete       = "SELECT * FROM users WHERE id=$update_user_id";
                                $image_delete_query =  mysqli_query($db, $image_delete);
                                $img_delete         = mysqli_fetch_assoc($image_delete_query);
                                $img_location       = "../uploads/users/".$img_delete['profile_image'];
    
                                $img_name = $update_user_id.'.'.$image_extension;
    
                                $update_user    = "UPDATE users SET name='$name', email='$email', password='$password', user_role='$user_role', profile_image='$img_name', created_at='$created_at' WHERE id =$update_user_id";
                                $update_user_query = mysqli_query($db, $update_user);
    
                                if ($update_user_query)
                                {
                                    unlink($img_location);
                                    $set_img_location = "../uploads/users/".$img_name;
                                    move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);
        
                                    $_SESSION['update_success'] = "Update is successful.";
                                    header("Location: edit_user.php?id=".$_SESSION['user_id']);
                                }
                                else {
                                    die(mysqli_error($db));
                                }
                            }
                        }
                        else {

                            $_SESSION['img_size']   = "Invalid image size! Upload maximum 50kb.";
                            $_SESSION['err_msg']    = $errors;
                            $_SESSION['name']       = $_POST['name'];
                            $_SESSION['email']      = $_POST['email'];
                            $_SESSION['user_role']  = $_POST['select'];
                            $_SESSION['password']   = $_POST['password'];
                            $_SESSION['cpassword']  = $_POST['cpassword'];
                            
                            header("Location: edit_user.php?id=".$_SESSION['user_id']);
                        }
                    }
                    else {
                        $_SESSION['extension']  = "Invalid extension!";
                        $_SESSION['err_msg']    = $errors;
                        $_SESSION['name']       = $_POST['name'];
                        $_SESSION['email']      = $_POST['email'];
                        $_SESSION['user_role']  = $_POST['select'];
                        $_SESSION['password']   = $_POST['password'];
                        $_SESSION['cpassword']  = $_POST['cpassword'];
                        
                        header("Location: edit_user.php?id=".$_SESSION['user_id']);
                    }
                }
                else {
                    $user_password_verify = "SELECT * FROM users WHERE id=$update_user_id";
                    $user_password_verify_query = mysqli_query($db,$user_password_verify);
                    $user_password_check = mysqli_fetch_assoc($user_password_verify_query);

                    if (password_verify($err_password,$user_password_check['password']) || (strlen($err_password) == 60))
                    {
                        $update_user    = "UPDATE users SET name='$name', email='$email', user_role='$user_role', created_at='$created_at' WHERE id =$update_user_id";

                        $update_user_query = mysqli_query($db, $update_user);
            
                        if ($update_user_query)
                        {
                            $_SESSION['update_success'] = "Update is successful.";
                            $_SESSION['update_password'] = "Password not Updated.";
                            header("Location: edit_user.php?id=".$_SESSION['user_id']);
                        }
                        else {
                            die(mysqli_error($db));
                        }
                    }
                    else {
                        $update_user    = "UPDATE users SET name='$name', email='$email', password='$password', user_role='$user_role', created_at='$created_at' WHERE id =$update_user_id";

                        $update_user_query = mysqli_query($db, $update_user);
            
                        if ($update_user_query)
                        {
                            $_SESSION['update_success'] = "Update is successful.";
                            header("Location: edit_user.php?id=".$_SESSION['user_id']);
                        }
                        else {
                            die(mysqli_error($db));
                        }
                    }
                }
            }
            else {
                if (in_array($image_extension, $allowed_extension))
                {
                    if ($uploaded_image['size'] > 500000 )
                    {
                        $_SESSION['img_size']  = "Invalid image size! Upload maximum 50kb.";
                    }
                }
                else {

                    if (!empty($image_extension))
                    {
                        $_SESSION['extension']  = "Invalid extension!";
                    }
                }
                $_SESSION['err_msg']        = $errors;
                $_SESSION['email_exist']    = "This Email is already have exist!";
                $_SESSION['email']          = $_POST['email'];
                $_SESSION['name']           = $_POST['name'];
                $_SESSION['user_role']      = $_POST['select'];
                $_SESSION['password']       = $_POST['password'];
                $_SESSION['cpassword']      = $_POST['cpassword'];
                $_SESSION['password_old']   = $_POST['password_old'];

                header("Location: edit_user.php?id=".$_SESSION['user_id']);
            }
        }
        else {
            $_SESSION['err_msg']    = $errors;
            $_SESSION['name']       = $_POST['name'];
            $_SESSION['email']      = $_POST['email'];
            $_SESSION['user_role']  = $_POST['select'];
            $_SESSION['password']   = $_POST['password'];
            $_SESSION['cpassword']  = $_POST['cpassword'];
            $_SESSION['password_old'] = $_POST['password_old'];

            header("Location: edit_user.php?id=".$_SESSION['user_id']);
        }
    }
    else {
        header("Location: manage.php");
    }
    ob_end_flush();

?>
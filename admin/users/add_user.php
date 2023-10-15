<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['adduser']))
    {
        $err_password   = $_POST['password'];
        $con_password   = $_POST['cpassword'];
        $user_roleCheck = $_POST['select'];

        $login_user_id    = isset($_COOKIE['login_user']) ? $_COOKIE['login_user'] : $_SESSION['login_user_id'];
        $login_user_data  = "SELECT * FROM users WHERE id=$login_user_id";
        $login_user_query = mysqli_query($db,$login_user_data);
        $login_user_info  = mysqli_fetch_assoc($login_user_query);

        $upper_case     = preg_match("@[A-Z]@", $err_password);
        $lower_case     = preg_match("@[a-z]@", $err_password);
        $number         = preg_match("@[a-z]@", $err_password);
        $special        = preg_match("@[^\w]@", $err_password);

        $errors = array();
        $field_names = array(
            "name"          => "Name is requried!", 
            "email"         => "Email is requried!",
            "select"        => "User role is requried!", 
            "password"      => "Password is requried!",
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

        if (!empty($err_password)) 
        {
            if (empty($con_password))
            {
                $errors['cpassword'] = "Confirm Password is requried!";
            }
        }

        if (count($errors) == 0)
        {
            $name       = $_POST['name'];
            $email      = $_POST['email'];
            $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);

            date_default_timezone_set("Asia/Dhaka");
            $created_at     = date("Y-m-d h:i:s a", time());

            $check_email    = "SELECT COUNT(*) AS email_exist FROM users WHERE email='$email'";
            $check_email_query = mysqli_query($db, $check_email);
            $after_assoc = mysqli_fetch_assoc($check_email_query);

            $uploaded_image     = $_FILES['profile_image'];
            $explode_image      = explode('.', $uploaded_image['name']);
            $image_extension    = end($explode_image);
            $allowed_extension  = array("jpeg", "png", "gif", "svg", "jpg", "webp");

            if ($after_assoc['email_exist'] == 0)
            {
                if (!empty($uploaded_image['name']))
                {                
                    if (in_array($image_extension, $allowed_extension))
                    {
                        if ($uploaded_image['size'] < 500000 )
                        {
                            if ($user_roleCheck == 1)
                            {
                                if ($login_user_info['user_role'] == 1)
                                {
                                    $user_role  = $_POST['select'];
        
                                    $insert_usres = "INSERT INTO users (name, email, password, user_role,  created_at) VALUES ('$name', '$email', '$password', '$user_role', '$created_at')";
                                    $insert_usres_query = mysqli_query($db, $insert_usres);
    
                                    $insert_id = mysqli_insert_id($db);
                                    $img_name = $insert_id.'.'.$image_extension;
                                    $set_img_location = "../uploads/users/".$img_name;
    
                                    $insert_img = "UPDATE users SET profile_image='$img_name' WHERE id =$insert_id";
                                    $insert_img_query = mysqli_query($db, $insert_img);
    
                                    move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);
    
                                    if ($insert_img_query)
                                    {
                                        $_SESSION['success'] = "Data insert successful.";
                                        header("Location: user_add.php");
                                    }
                                    else {
                                        die(mysqli_error($db));
                                    }
                                }
                                elseif ($login_user_info['user_role'] == 2)
                                { 
                                    $_SESSION['name']       = $_POST['name'];
                                    $_SESSION['email']      = $_POST['email'];
                                    $_SESSION['user_role']  = $_POST['select'];
                                    $_SESSION['password']   = $_POST['password'];
                                    $_SESSION['cpassword']  = $_POST['cpassword'];
                                    $_SESSION['use_adminerr'] = "User information is not insert!";

                                    header("Location: user_add.php");
                                }
                            }
                            else {
                                $user_role  = $_POST['select'];
        
                                $insert_usres = "INSERT INTO users (name, email, password, user_role,  created_at) VALUES ('$name', '$email', '$password', '$user_role', '$created_at')";
                                $insert_usres_query = mysqli_query($db, $insert_usres);

                                $insert_id = mysqli_insert_id($db);
                                $img_name = $insert_id.'.'.$image_extension;
                                $set_img_location = "../uploads/users/".$img_name;

                                $insert_img = "UPDATE users SET profile_image='$img_name' WHERE id =$insert_id";
                                $insert_img_query = mysqli_query($db, $insert_img);

                                move_uploaded_file($uploaded_image['tmp_name'],$set_img_location);

                                if ($insert_img_query)
                                {
                                    $_SESSION['success'] = "Data insert successful.";
                                    header("Location: user_add.php");
                                }
                                else {
                                    die(mysqli_error($db));
                                }
                            }
                        }
                        else {
                            $_SESSION['img_size']  = "Invalid image size! Upload maximum 50kb.";
                            $_SESSION['err_msg'] = $errors;

                            $_SESSION['name']       = $_POST['name'];
                            $_SESSION['email']      = $_POST['email'];
                            $_SESSION['user_role']  = $_POST['select'];
                            $_SESSION['password']   = $_POST['password'];
                            $_SESSION['cpassword']  = $_POST['cpassword'];

                            header("Location: user_add.php");
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

                        header("Location: user_add.php");
                    }
                }
                else {
                    if ($user_roleCheck == 1)
                    {
                        if ($login_user_info['user_role'] == 1)
                        {
                            $user_role  = $_POST['select'];
                            $insert_usres = "INSERT INTO users (name, email, password, user_role, created_at) VALUES ('$name', '$email', '$password', '$user_role', '$created_at')";

                            $insert_usres_query = mysqli_query($db, $insert_usres);
                
                            if ($insert_usres_query)
                            {
                                $_SESSION['success'] = "Data insert successful.";
                                header("Location: user_add.php");
                            }
                            else {
                                die(mysqli_error($db));
                            }
                        }
                        elseif ($login_user_info['user_role'] == 2)
                        { 
                            $_SESSION['name']       = $_POST['name'];
                            $_SESSION['email']      = $_POST['email'];
                            $_SESSION['user_role']  = $_POST['select'];
                            $_SESSION['password']   = $_POST['password'];
                            $_SESSION['cpassword']  = $_POST['cpassword'];
                            $_SESSION['use_adminerr'] = "User information is not insert!";
                            header("Location: user_add.php");
                        }
                    }
                    else {
                        $user_role    = $_POST['select'];
                        $insert_usres = "INSERT INTO users (name, email, password, user_role, created_at) VALUES ('$name', '$email', '$password', '$user_role', '$created_at')";

                        $insert_usres_query = mysqli_query($db, $insert_usres);
            
                        if ($insert_usres_query)
                        {
                            $_SESSION['success'] = "Data insert successful.";
                            header("Location: user_add.php");
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
                $_SESSION['email_exist'] = "This Email is already have exist!";
                $_SESSION['err_msg']     = $errors;
                $_SESSION['name']        = $_POST['name'];
                $_SESSION['email']       = $_POST['email'];
                $_SESSION['user_role']   = $_POST['select'];
                $_SESSION['password']    = $_POST['password'];
                $_SESSION['cpassword']   = $_POST['cpassword'];

                header("Location: user_add.php");
            }
        }
        else {
            $_SESSION['err_msg']    = $errors;
            $_SESSION['name']       = $_POST['name'];
            $_SESSION['email']      = $_POST['email'];
            $_SESSION['user_role']  = $_POST['select'];
            $_SESSION['password']   = $_POST['password'];
            $_SESSION['cpassword']  = $_POST['cpassword'];

            header("Location: user_add.php");
        }
    }
    else {
        header("Location: manage.php");
    }
    ob_end_flush();

?>
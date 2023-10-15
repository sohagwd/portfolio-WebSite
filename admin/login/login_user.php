

<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php";

    if (userlogin())
    {
        header("Location: ../dashboard.php");
    }

    if (isset($_POST['login']))
    {
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $remember   = isset($_POST['logincookie']) ? $_POST['logincookie'] : NULL;

        $user_login         =  "SELECT COUNT(*) AS email_exist FROM users WHERE email ='$email'";
        $user_login_query   = mysqli_query($db, $user_login);
        $checked_email      = mysqli_fetch_assoc($user_login_query);

        $errors = array();
        $field_names = array(
            "email"         => "Email is requried!",
            "password"      => "Password is requried!",
        );

        foreach ($field_names as $field_name => $message)
        {
            if (empty($_POST[$field_name]))
            {
               $errors[$field_name] = $message;
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors['err_email'] = "You Email is invalid.";
            }
        }

        if (count($errors) == 0)
        {
            if ($checked_email['email_exist'] == 1)
            {
                $check_user_password    = "SELECT * FROM users WHERE email ='$email'";
                $check_user_pass_query  = mysqli_query($db, $check_user_password);
                $checked_password       = mysqli_fetch_assoc($check_user_pass_query);

                if (password_verify($password,$checked_password['password']))
                {
                    if ($checked_password['user_role'] == 4 || $checked_password['status'] == 1)
                    {
                        $_SESSION['not_login'] = "havevalue";
                        $_SESSION['email']     = $email;
                        $_SESSION['password']  = $password;
            
                        header("Location: login.php");
                    }
                    else {
                        $_SESSION['login_users']        = "Email";
                        $_SESSION['login_users_msg']    = "msg";
                        $_SESSION['login_user_id']      = $checked_password['id'];

                        if (isset($remember))
                        {
                            $user_login_id = $checked_password['id'];
                            setcookie('login_user', $user_login_id, time() + 60*60, '/');
                        }
                        header("Location: ../dashboard.php");
                    }
                }
                else {
                    $_SESSION['email']     = $email;
                    $_SESSION['password']  = $password;
                    $_SESSION['pass_err']  = "Password does not match!";
        
                    header("Location: login.php");
                }
            }
            else {
                $_SESSION['email']     = $email;
                $_SESSION['password']  = $password;
                $_SESSION['email_err'] = "This Email not found!";
    
                header("Location: login.php");
            }
        }
        else {
            $_SESSION['err_msg']    = $errors;
            $_SESSION['email']      = $email;
            $_SESSION['password']   = $password;

            header("Location: login.php");
        }
    }
    else {
        if (!userlogin())
        {
            header("Location: login.php");
        }
        elseif (userlogin())
        {
            header("Location: ../users/manage.php");
        }
    }
    ob_end_flush();

?>
<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
    require "../backend_includes/functions.php"; 
    
    if (!userlogin())
    {
        header("Location: ../login/login.php");
    }

    if (isset($_POST['updateFact']))
    {
        $id         = $_POST['fact_id'];
        $title      = mysqli_real_escape_string($db, $_POST['title']);
        $icon       = mysqli_real_escape_string($db, $_POST['icon']);
        $number     = mysqli_real_escape_string($db, $_POST['number']);

        $errors = array();
        $field_names = array(
            "title"  => "This field is requried!",
            "icon"   => "This field is requried!",
        );

        foreach ($field_names as $field_name => $message)
        {
            if (empty($_POST[$field_name]))
            {
               $errors[$field_name] = $message;
            }

            if ($_POST['number'] == 0) {
                
            }
            elseif (empty($_POST['number'])) {

                $errors['number'] = "This field is requried!";
            }

            if ($_POST['number'] < 0  && $_POST['number'] != NULL)
            {
                $errors['invalid_number'] = "Your number is invalid";
            }
        }

        if (count($errors) == 0)
        {
            date_default_timezone_set("Asia/Dhaka");
            $created_at     = date("Y-m-d h:i:s a", time());

            $update_fact = "UPDATE facts SET title='$title', number='$number', icon='$icon', created_at='$created_at' WHERE id=$id";
            $update_fact_query = mysqli_query($db, $update_fact);

            if ($update_fact_query)
            {
                $_SESSION['success'] = "Data update successful.";
                header("Location: fact_edit.php?id=$id");
            }
            else {
                die(mysqli_error($db));
            }
        }
        else {
            $_SESSION['err_msg'] = $errors;
            $_SESSION['title']   = $_POST['title'];
            $_SESSION['icon']    = $_POST['icon'];
            $_SESSION['number']  = $_POST['number'];

            header("Location: fact_edit.php?id=$id");
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
<?php 
    session_start();
    require "../backend_includes/db.php";

    if (isset($_POST['trashuser_id']) && isset($_POST['allusers_id']))
    {
        $users_id = $_POST['allusers_id'];
        $convert_id = implode(',', $users_id);
        $user_status = "UPDATE users SET status='1' WHERE id IN ($convert_id)";
        $user_status_query = mysqli_query($db, $user_status);
    
        if ($user_status_query)
        {
            $_SESSION['trash'] = "Users info now Trashed!";
            header("Location: manage.php");
        }
        else {
            die(mysqli_error($db));
        }
    }
    elseif (isset($_POST['restoreuser_id']) && isset($_POST['users_id']))
    {
        $users_id = $_POST['users_id'];
        $convert_id = implode(',', $users_id);
        $user_status = "UPDATE users SET status='0' WHERE id IN ($convert_id)";
        $user_status_query = mysqli_query($db, $user_status);
    
        if ($user_status_query)
        {
            $_SESSION['restore'] = "Users info now Restore!";
            $_SESSION['user_restore'] = "Restore!";
            header("Location: manage.php");
        }
        else {
            die(mysqli_error($db));
        }
    }
    elseif (isset($_POST['deleteuser_id']) && isset($_POST['users_id']))
    {
        $users_id = $_POST['users_id'];
        $convert_id = implode(',', $users_id);
        foreach ($users_id as $id)
        {
            $image_delete = "SELECT * FROM users WHERE id=$id";
            $image_delete_query =  mysqli_query($db, $image_delete);
            $img_delete = mysqli_fetch_assoc($image_delete_query);
    
            $img_location = "../uploads/users/".$img_delete['profile_image'];
            unlink($img_location);
        }
        
        $delete_user = "DELETE FROM users WHERE id IN ($convert_id)";
        $delete_user_query = mysqli_query($db, $delete_user);

        if ($delete_user_query)
        {
            $_SESSION['success_delete'] = "Data delete successful!";
            $_SESSION['delete_user']    = "Delete successful!";
    
            header("Location: manage.php");
        }
        else {
            die(mysqli_error($db));
        }
    }
    else {
        header("Location: manage.php");
    }

?>
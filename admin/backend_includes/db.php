<?php 

    $db = mysqli_connect("localhost", "root", "", "sohag");
    if ($db)
    {
        //echo "Server Connection Established";
    }
    else {
        die(mysqli_error($db));
    }

?>
<?php

function check_login($con)
{
    if(isset($_SESSION['Access']))
    {
        $id = $_SESSION['Access'];
        $query = "SELECT * FROM tbl_admin WHERE username = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    // redirect to login page
    header("Location: login.php");
    die;
}
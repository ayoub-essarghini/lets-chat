<?php

    session_start();
    if(isset($_SESSION['unique_id'])){//if user is logged in then come this page 
        include_once "config.php";
        $logout_id = mysqli_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){//if logout_id is set 
            $status = "Offline now";
            //when user logout update status to offline
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else{
            header("location: ../users.php");
        }

    }else{
        header("location: ../login.php");
    }

?>
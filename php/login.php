<?php 

session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


if(!empty($email) && !empty($password)){

    //check user email & password is matched in any table row or not 
    $sql=mysqli_query($conn,"SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
    if(mysqli_num_rows($sql) > 0){ //if users credentials matched
        $row= mysqli_fetch_assoc($sql);
        $status = "Active now";
        //updating user status to active now if user login successfully
        $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']} ");
        if($sql2){
            $_SESSION['unique_id']=$row['unique_id'];
            echo "success";
        }
       


    }else{
        echo "Email or Password is incorrect!";
    }

}else{
    echo "All input field are required!";
}


?>
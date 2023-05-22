<?php

session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    //check user email is valid or not 
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) { //check if email already exist
            echo "$email - this email already exist!";
        } else {
            //let's check user upload file or not 
            if (isset($_FILES['image'])) { // if file is uploaded
                $img_name = $_FILES['image']['name']; //getting user upload image name
                $tmp_name = $_FILES['image']['tmp_name']; //this temporary name to save/move file in our folder

                //explode image extension like jpg png
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode); //her got the extension of image uploaded by user

                $extensions = ['png', 'jpeg', 'jpg']; //valid img extension
                if (in_array($img_ext, $extensions) === true) { // if user uploaded img matched any extentions in array
                    $time = time(); //return current time & this used for rename image

                    //move the user uploaded img to our particular folder
                    $new_img_name = $time . $img_name;
                    if (move_uploaded_file($tmp_name, "upload/" . $new_img_name)) { //if user upload to our folder successfully
                        $status = "Active now"; //once user signed up then his status will be active now
                        $random_id = rand(time(), 10000000); //creating random id  for user 

                        //insert all user data in table 
                        $sql2 = mysqli_query($conn, "INSERT INTO users(unique_id, fname, lname, email, password, img, status)
                                            VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                        if ($sql2) { //if these data inserted 
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if (mysqli_num_rows($sql3) > 0) {
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other php file 
                                echo "success";
                            }
                        } else {
                            echo "something went wrong!";
                        }
                    }
                } else {
                    echo "please select an image file - jpeg, jpg , png";
                }
            } else {
                echo "please upload an image file!";
            }
        }
    } else {
        echo "$email - this is a not valid email!";
    }
} else {
    echo "All input field are required!";
}

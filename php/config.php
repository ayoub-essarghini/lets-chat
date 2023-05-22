<?php 

$conn = mysqli_connect("localhost","root","","chat");
if(!$conn){
    echo "Database connected".mysqli_connect_error();
}

?>
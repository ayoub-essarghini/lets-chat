<?php 
session_start();
if(isset($_SESSION['unique_id'])){//if user is logged in 
    header("location: users.php");
}

?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form signup">

            <header>Real time chat App</header>
            <form action="#" enctype="multipart/form-data">

                <div class="error-text">
                  
                </div>
                <div class="name-details">
                    <div class="field input">
                        <label >First Name </label>
                        <input type="text" placeholder="First name " name="fname" id="" required>
                    </div>
                    <div class="field input">
                        <label >Last Name </label>
                        <input type="text" placeholder="Last name " name="lname" id="" required>
                    </div>
                </div>
                    <div class="field input">
                        <label >Email Adresse </label>
                        <input type="text" placeholder="Enter your email adresse " name="email" id="" required>
                    </div>
                    <div class="field input">
                        <label >Password </label>
                        <input type="password" placeholder="Enter new password" name="password" id="" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label >Select Image </label>
                        <input type="file" name="image" required >
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continue to chat" >
                    </div>
               
            </form>
            <div class="link">Already singed up? <a href="login.php">Login now</a></div>

        </section>
    </div>

    <script src="js/pass-show-hide.js"></script>
    <script src="js/signup.js"></script>
</body>
</html>
<!DOCTYPE html>
<?php
        if(isset($_POST['signup'])){
            $given_name = $_POST['given_name'];
            $middlename = $_POST['middle_name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            $db_host = "localhost";
            $db_user = "root";
            $db_pass = "";
            $db_name = "accounts";

            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

            if(mysqli_connect_errno()){
                echo "Failed to connect to database: " . mysqli_connect_error();
                exit();
            } else {
                echo "Database connected successfully";
            }

            $sql = "INSERT INTO signed_up(Given_name, Middle_Name, Last_name, Email, Phone, Correct_Password)
                    VALUES('$given_name', '$middlename', '$lastname', '$email','$phone','$password')";

            $result = mysqli_query($conn, $sql);

            if($result) {
              header('Location: home.php');
            } else {
                echo "Error while filling up: " . mysqli_error($conn);
            }

            mysqli_close($conn);
        }
    ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="shortcut icon" type="x-icon" href="upperlogo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<body>
    <div  class="container" >
       <div class="wrapper">
        <div class="title"><span>Sign up</span></div>
        <form action="#" method="post">
          <div class="row">
            <i class="fas fa-id-card"></i>
            <input type="text" name="given_name" placeholder="Given Name" required>
          </div>
          <div class="row">
            <i class="fas fa-id-card"></i>
            <input type="text" name="middle_name" placeholder="Middle Name" required>
          </div>
          <div class="row">
            <i class="fas fa-id-card"></i>
            <input type="text" name="lastname" placeholder="Last Name" required>
          </div>
          <div class="row">
            <i class="fas fa-envelope"></i>
            <input type="text" name="email" placeholder="Email" required>
          </div>
          <div class="row">
            <i class="fas fa-phone"></i>
            <input type="text" name="phone" placeholder="Phone" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="passqword" name="retype_password" placeholder="Retype-Password" required>
          </div>
          <div class="row button">
            <input type="submit" name="signup" value="signup">
          </div>
          <div class="signup-link">Already a member? <a href="login.php">Login</a></div>
        </form>
      </div>
    </div>  

    
  </body>
</html>
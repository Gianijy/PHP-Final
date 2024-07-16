<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Account</title>
    <link rel="shortcut icon" type="x-icon" href="upperlogo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<?php
// Initialize errors array
$errors = [
    'login_err' => '',
    'password_err' => ''
];

$entered_login = ''; // Initialize variable to store entered login (email or phone)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $entered_login = sanitize_input($_POST["login"]);
    $password = sanitize_input($_POST["password"]);

    // Check if login and password are provided
    if (empty($entered_login)) {
        $errors['login_err'] = "Email or Phone required";
    }
    if (empty($password)) {
        $errors['password_err'] = "Password required";
    }

    // Proceed if there are no errors so far
    if (empty($errors['login_err']) && empty($errors['password_err'])) {
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "accounts";

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if login exists as email or phone
        $query = "SELECT * FROM signed_up WHERE Email = ? OR Phone = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $entered_login, $entered_login);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($password === $row['Correct_Password']) {
                // Password is correct, redirect to home page or dashboard
                header('Location: home.php');
                exit();
            } else {
                $errors['login_err'] = ""; // Reset login error if password is incorrect
                $errors['password_err'] = "Password incorrect";
            }
        } else {
            $errors['login_err'] = "Email or Phone does not exist";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<div class="container">
    <div class="wrapper">
        <div class="title"><span>Login</span></div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="row">
                <i class="fas fa-user"></i>
                <input type="text" name="login" placeholder="Email or Phone" value="<?php echo htmlspecialchars($entered_login); ?>" >
                <span class="error"><?php echo $errors['login_err']; ?></span> <!-- Display login error here -->
            </div>
            <div class="row">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" >
                <span class="error"><?php echo $errors['password_err']; ?></span> <!-- Display password error here -->
            </div>
            <div class="row button">
                <input type="submit" value="Login">
            </div>
            <div class="signup-link">Not a member? <a href="signup.php">Signup now</a></div>
        </form>
    </div>
</div>

</body>
</html>
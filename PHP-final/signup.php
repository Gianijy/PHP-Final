<!DOCTYPE html>
<?php
$fields = [
    'given_name' => '',
    'middle_name' => '',
    'lastname' => '',
    'email' => '',
    'phone' => '',
    'password' => '',
    'retype_password' => ''
];

$errors = [
    'given_name_err' => '',
    'middle_name_err' => '',
    'lastname_err' => '',
    'email_err' => '',
    'phone_err' => '',
    'password_err' => '',
    'retype_password_err' => ''
];

$registration_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate given name
    if (empty($_POST["given_name"])) {
        $errors['given_name_err'] = "Required";
    } elseif (!preg_match("/^[a-zA-Z]/", $_POST["given_name"])) {
        $errors['given_name_err'] = "Given name must start with a letter.";
    } else {
        $fields['given_name'] = sanitize_input($_POST["given_name"]);
    }

    // Validate middle name
    if (!empty($_POST["middle_name"]) && !preg_match("/^[a-zA-Z]/", $_POST["middle_name"])) {
        $errors['middle_name_err'] = "Middle name must start with a letter.";
    } else {
        $fields['middle_name'] = sanitize_input($_POST["middle_name"]);
    }

    // Validate last name
    if (empty($_POST["lastname"])) {
        $errors['lastname_err'] = "Required";
    } elseif (!preg_match("/^[a-zA-Z]/", $_POST["lastname"])) {
        $errors['lastname_err'] = "Last name must start with a letter.";
    } else {
        $fields['lastname'] = sanitize_input($_POST["lastname"]);
    }

    // Validate email
    if (empty($_POST["email"])) {
        $errors['email_err'] = "Required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors['email_err'] = "Invalid email format.";
    } else {
        $fields['email'] = sanitize_input($_POST["email"]);
    }

    // Validate phone
    if (empty($_POST["phone"])) {
        $errors['phone_err'] = "Required";
    } elseif (!preg_match("/^\d{11}$/", $_POST["phone"])) {
        $errors['phone_err'] = "Phone number must be 11 digits.";
    } else {
        $fields['phone'] = sanitize_input($_POST["phone"]);
    }

    // Validate password
    if (empty($_POST["password"])) {
        $errors['password_err'] = "Required";
    } elseif (strlen($_POST["password"]) < 8 || !preg_match("/\d/", $_POST["password"])) {
        $errors['password_err'] = "Must be at least 8 characters and contain digits.";
    } else {
        $fields['password'] = sanitize_input($_POST["password"]);
    }

    // Validate re-typed password
    if (empty($_POST["retype_password"])) {
        $errors['retype_password_err'] = "Required";
    } elseif ($_POST["password"] !== $_POST["retype_password"]) {
        $errors['retype_password_err'] = "Passwords do not match";
    } else {
        $fields['retype_password'] = sanitize_input($_POST["retype_password"]);
    }

    // Check for existing email and phone number
    if (empty($errors['email_err']) && empty($errors['phone_err'])) {
        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "accounts";

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $email = mysqli_real_escape_string($conn, $fields['email']);
        $phone = mysqli_real_escape_string($conn, $fields['phone']);

        $email_check_query = "SELECT * FROM signed_up WHERE Email = '$email' LIMIT 1";
        $phone_check_query = "SELECT * FROM signed_up WHERE Phone = '$phone' LIMIT 1";

        $email_check_result = mysqli_query($conn, $email_check_query);
        $phone_check_result = mysqli_query($conn, $phone_check_query);

        if (mysqli_num_rows($email_check_result) > 0) {
            $errors['email_err'] = "Email already exists.";
        }

        if (mysqli_num_rows($phone_check_result) > 0) {
            $errors['phone_err'] = "Phone number already exists.";
        }

        mysqli_close($conn);
    }

    // Check for no errors
    $no_errors = true;
    foreach ($errors as $error) {
        if (!empty($error)) {
            $no_errors = false;
            break;
        }
    }

    // Process the form if there are no errors
    if ($no_errors) {
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO signed_up (Given_name, Middle_Name, Last_name, Email, Phone, Correct_Password) 
                VALUES ('{$fields['given_name']}', '{$fields['middle_name']}', '{$fields['lastname']}', '{$fields['email']}', '{$fields['phone']}', '{$fields['password']}')";

        if (mysqli_query($conn, $sql)) {
            $registration_success = true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
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
    <style>
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Sign up</span></div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <?php if ($registration_success): ?>
                    <p class="success">Registration successful!</p>
                <?php endif; ?>
                <div class="row">
                    <i class="fas fa-id-card"></i>
                    <input type="text" name="given_name" placeholder="Given Name" value="<?php echo $fields['given_name']; ?>">
                    <span class="error"><?php echo $errors['given_name_err']; ?></span>
                </div>
                <div class="row">
                    <i class="fas fa-id-card"></i>
                    <input type="text" name="middle_name" placeholder="Middle Name" value="<?php echo $fields['middle_name']; ?>">
                    <span class="error"><?php echo $errors['middle_name_err']; ?></span>
                </div>
                <div class="row">
                    <i class="fas fa-id-card"></i>
                    <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $fields['lastname']; ?>">
                    <span class="error"><?php echo $errors['lastname_err']; ?></span>
                </div>
                <div class="row">
                    <i class="fas fa-envelope"></i>
                    <input type="text" name="email" placeholder="Email" value="<?php echo $fields['email']; ?>">
                    <span class="error"><?php echo $errors['email_err']; ?></span>
                </div>
                <div class="row">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="phone" placeholder="Phone" value="<?php echo $fields['phone']; ?>">
                    <span class="error"><?php echo $errors['phone_err']; ?></span>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password">
                    <span class="error"><?php echo $errors['password_err']; ?></span>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="retype_password" placeholder="Retype-Password">
                    <span class="error"><?php echo $errors['retype_password_err']; ?></span>
                </div>
                <div class="row button">
                    <input type="submit" name="signup" value="Sign Up">
                </div>
                <div class="signup-link">Already a member? <a href="login.php">Login</a></div>
            </form>
        </div>
    </div>
</body>
</html>
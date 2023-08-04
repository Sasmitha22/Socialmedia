<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Database connection configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "table_form";

    // Create a new database connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if it's a sign-in form submission
    if (isset($_POST["signin_submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Query the database to check username and password
        $query = "SELECT * FROM table_form WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            // Username and password are correct, redirect to index.html
            header("Location: index1.php");
            exit();
        } else {
            // Incorrect username or password, show error message
            $error_message = "Incorrect username or password. Please try again.";
        }
    }

    // Check if it's a sign-up form submission
    if (isset($_POST["signup_submit"])) {
        // Prepare and bind the insert statement
        $stmt = $conn->prepare("INSERT INTO table_form (username, full_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $full_name, $email, $password);

        // Set the form input values
        $username = $_POST["username"];
        $full_name = $_POST["full_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Execute the statement
        if ($stmt->execute()) {
            // Registration successful
            $success_message = "Registration successful!";
        } else {
            // Registration failed
            $error_message = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ url_for('static', filename='style.css') }}" />
    <title>Sign in & Sign up Form</title>
</head>
<body>
    <div class="box">
        <p class="box-p1"><a href="{{ url_for('index') }}">HOME</a></p>
    </div>

    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <?php if (isset($error_message)): ?>
                        <p class="error-message"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <input type="submit" name="signin_submit" value="Login" class="btn solid" />
                </form>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <?php if (isset($success_message)): ?>
                        <p class="success-message"><?php echo $success_message; ?></p>
                    <?php elseif (isset($error_message)): ?>
                        <p class="error-message"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="full_name" placeholder="Full Name" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <input type="submit" name="signup_submit" class="btn" value="Sign up" />                   
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p> Connect. Share. Thrive. Welcome to Socially Connected </p>
                    <button class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <img src="static\images\log.svg" class="image" alt="" />
            </div>
            
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p> Welcome back to Socially Connected! Rediscover, reconnect, thrive. </p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="static\images\register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="{{ url_for('static', filename='app.js') }}"></script>
</body>
</html>

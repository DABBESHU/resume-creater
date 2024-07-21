<?php
session_start();
$servername = "localhost";
$username = "";
$db_password = "";
$database_name = "";
$conn = new mysqli($servername, $username, $db_password, $database_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login_submit"])) {
        if (!empty($_POST["logemail"]) && !empty($_POST["logpass"])) {
            // Login logic
            $login_email = $_POST["logemail"];
            $login_password = $_POST["logpass"];
            // Validate and sanitize user inputs before using in the query to prevent SQL injection
            $login_email = mysqli_real_escape_string($conn, $login_email);
            $login_password = mysqli_real_escape_string($conn, $login_password);
            $sql = "SELECT * FROM connect WHERE email='$login_email' AND password='$login_password'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Login successful
                $_SESSION['loggedin'] = true;
                header("Location: home.html");
                exit();
            } else {
                // Login failed
                echo "Login failed. Please check your email and password.";
            }
        } else {
            // Email or password is empty
            echo "Email or password cannot be empty.";
        }
    } elseif (isset($_POST["signup_submit"])) {
        if (!empty($_POST["logemail"]) && !empty($_POST["logpass"])) {
            // Signup logic
            $signup_email = $_POST["logemail"];
            $signup_password = $_POST["logpass"];
            // You should validate and sanitize user inputs before inserting into the database to prevent SQL injection
            $signup_email = mysqli_real_escape_string($conn, $signup_email);
            $signup_password = mysqli_real_escape_string($conn, $signup_password);
            $sql = "INSERT INTO connect (email, password) VALUES ('$signup_email', '$signup_password')";
            if ($conn->query($sql) === TRUE) {
                // Signup successful
                header("Location: home.html");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // Email or password is empty
            echo "Email or password cannot be empty.";
        }
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your HTML head content -->
</head>
<body>
    <!-- Your HTML body content -->
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/log3.css">
</head>
<body
    style="background-image: url('assets/img/background/loginback.jpg'); ; background-size: 100% 100%; background-position: center center; background-repeat: no-repeat;">
    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <!-- ======= LOG IN  side  ======= -->
                                            <form method="post"
                                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                <div class="form-group">
                                                    <input type="email" name="logemail" class="form-style"
                                                        placeholder="Your Email" id="email" autocomplete="none" />
                                                    <i class="input-icon fa fa-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="logpass" class="form-style"
                                                        placeholder="Your Password" id="password" autocomplete="none" />
                                                    <i class="input-icon fa fa-lock"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4"
                                                    name="login_submit">Login</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- ======= for login side javascript  ======= -->
                                <!-- ======= SGIN UP side  ======= -->
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Sign Up</h4>
                                            <form method="post"
                                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                <div class="form-group mt-2">
                                                    <input type="email" name="logemail" class="form-style"
                                                        placeholder="Your Email" id="email1" autocomplete="none" />
                                                    <i class="input-icon fa fa-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="logpass" class="form-style"
                                                        placeholder="Your Password" id="password" autocomplete="none" />
                                                    <i class="input-icon fa fa-lock"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4"
                                                    name="signup_submit">Signup</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= add all script here dont forget proper naming and dont change any name from above plz ======= -->
    <script>
        function func() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            console.log('Email:', email);
            console.log('Password:', password);
            // Implement your login functionality here, maybe using AJAX to send data to the server
        }
    </script>
</body>
</html>

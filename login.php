<?php
// Start the session
session_start();

// Include database connection
include "conn.php";

$error_message = '';
$success_message = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user details from the users table
    $sql_user = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result_user = $conn->query($sql_user);

    // SQL query to fetch user details from the admins table
    $sql_admin = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result_admin = $conn->query($sql_admin);

    if ($result_user->num_rows == 1) {
        // User found in the users table
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        header("Location: student-index.php");
            exit;
    } elseif ($result_admin->num_rows == 1) {
        // User found in the admins table
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['admin'] = true;

        header("Location: admin-index.php");
        exit;
    } else {
        // Invalid username or password, show error message
        $error_message = "Invalid username or password!";
    }
}
?>

<?php include "head.php"; ?>

<style>
    body {
        background: linear-gradient(to right, #2b7d2f 50%, #FFFFFF 50%);
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    .green-section {
        background-color: #2b7d2f;
        padding: 60px;
        min-height: 100vh; /* Adjust height as needed */
        display: flex;
        align-items: center;
        justify-content: center; /* Center content horizontally */
        text-align: center; /* Center text */
    }

    .green-section .content {
        color: #FFFFFF;
    }

    .green-section h5,
    .green-section h1 {
        margin-bottom: 20px;
    }

    .green-section .guide {
        color: #FFFFFF;
        font-size: 3.5rem;
        font-weight: bold;
    }

    .green-section .co {
        color: #959722; /* Yellow Co text color */
        font-size: 3.5rem;
        font-weight: bold;
    }

    .green-section p {
        font-size: 1.5rem;
        margin-bottom: 40px;
    }

    .white-section {
        padding: 60px;
        min-height: 100vh; /* Adjust height as needed */
        display: flex;
        align-items: center;
        justify-content: center; /* Center content horizontally */
        text-align: center; /* Center text */
    }

    .login-form {
        background-color: #FFFFFF;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        width: 100%; /* Ensure form width is full */
        max-width: 500px; /* Limit form width for readability */
    }

    .login-form h2 {
        font-size: 2.5rem;
        color: #2b7d2f;
        margin-bottom: 30px;
        text-align: center;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left; /* Left-align form elements */
    }

    .form-control {
        width: 100%;
        padding: 16px;
        font-size: 1.2rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        outline: none;
        border-color: #2b7d2f; /* Green border color on focus */
        box-shadow: 0 0 0 0.2rem rgba(43, 125, 47, 0.25); /* Green shadow on focus */
    }

    .input-group-text {
        cursor: pointer;
    }

    .btn-primary {
        background-color: #2b7d2f;
        color: #FFFFFF;
        border-color: #2b7d2f;
        padding: 18px;
        font-size: 1.5rem;
        font-weight: bold;
        text-transform: uppercase;
        width: 100%; /* Full-width button */
        border-radius: 8px;
        transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #3d984a; /* Darker green on hover */
        border-color: #3d984a; /* Darker border on hover */
    }

    .alert-danger {
        margin-top: 20px;
    }

    @media (max-width: 720px) {
        body {
            background: #2b7d2f; /* Green background color */
        }
        .login-form {
            padding: 20px; /* Adjusted padding for smaller screens */
        }

        .form-group {
            margin-bottom: 10px; /* Reduced margin bottom for smaller screens */
        }

        .login-form h2 {
            margin-bottom: 20px; /* Adjusted margin bottom for smaller screens */
        }

        .white-section {
            padding: 40px 20px; /* Adjusted padding for smaller screens */
            margin: 0; /* Remove margin for smaller screens */
        }

        .green-section {
            display: none; /* Hide green-section on smaller screens */
        }
    }
</style>

<body>

<div class="container-fluid">
    <div class="row">
        <!-- Left Side - Green Section -->
        <div class="col-md-6 green-section">
            <div class="content">
                <h5>Welcome to</h5>
                <h1><span class="guide">Guide</span><span class="co">Co</span></h1>
                <p>Your hub for expert guidance and counseling. Empower your journey to personal growth with our supportive insights and tools.</p>
            </div>
        </div>

        <!-- Right Side - White Section -->
        <div class="col-md-6 white-section d-flex align-items-center">
            <div class="login-form">
                <h2>Login</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text show-password" onclick="togglePassword()">
                                    <i class="fa fa-eye" id="eye-icon"></i>
                                </span>
                            </div>
                        </div>
                        <small><a href="forgot-password.php" class="float-right mb-5">Forgot password?</a></small> <!-- Adjusted alignment -->
                    </div>
                    <!-- Optionally add captcha or other fields -->
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="your-site-key"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

<?php include "footer.php"; ?>

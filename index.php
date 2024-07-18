<?php
// Start the session (ensure session_start() is called once)
session_start();

// Include database connection
include "conn.php";

$error_message = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form (sanitize inputs)
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // SQL query to fetch user details from the users table
    $sql_user = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result_user = $conn->query($sql_user);

    // SQL query to fetch user details from the admins table
    $sql_admin = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result_admin = $conn->query($sql_admin);

    // SQL query to fetch user details from the teachers table
    $sql_teacher = "SELECT * FROM teachers WHERE username = '$username' AND password = '$password'";
    $result_teacher = $conn->query($sql_teacher);

    // SQL query to fetch user details from the guards table
    $sql_guard = "SELECT * FROM guards WHERE username = '$username' AND password = '$password'";
    $result_guard = $conn->query($sql_guard);

    if ($result_user && $result_user->num_rows == 1) {
        // User found in the users table
        $user = $result_user->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user'] = true;
        $_SESSION['user_id'] = $user['id']; // Save user id in session

        // Redirect to student-index.php or refresh the current page to display user info
        header("Location: student-index.php");
        exit;
    } elseif ($result_admin && $result_admin->num_rows == 1) {
        // Admin found in the admins table
        $admin = $result_admin->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['admin'] = true;
        $_SESSION['admin_id'] = $admin['id']; // Save admin id in session

        // Redirect to admin-index.php or refresh the current page to display admin info
        header("Location: admin-index.php");
        exit;
    } elseif ($result_teacher && $result_teacher->num_rows == 1) {
        // Teacher found in the teachers table
        $teacher = $result_teacher->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['teacher'] = true;
        $_SESSION['teacher_id'] = $teacher['id']; // Save teacher id in session

        // Redirect to teacher-index.php or refresh the current page to display teacher info
        header("Location: teacher-index.php");
        exit;
    } elseif ($result_guard && $result_guard->num_rows == 1) {
        // Guard found in the guards table
        $guard = $result_guard->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['guard'] = true;
        $_SESSION['guard_id'] = $guard['id']; // Save guard id in session

        // Redirect to guard-index.php or refresh the current page to display guard info
        header("Location: guard-index.php");
        exit;
    } else {
        // Invalid username or password, show error message
        $error_message = "Invalid username or password!";
    }

    // Close database connection
}

// Check if user is logged in and fetch user/admin details
if (isset($_SESSION['loggedin'])) {
    $user_id = $_SESSION['user_id'] ?? null;
    $admin_id = $_SESSION['admin_id'] ?? null;
    $teacher_id = $_SESSION['teacher_id'] ?? null;
    $guard_id = $_SESSION['guard_id'] ?? null;

    if ($user_id) {
        // Fetch user data
        $sql_fetch_user = "SELECT * FROM users WHERE id = $user_id";
        $result_fetch_user = $conn->query($sql_fetch_user);
    
        if ($result_fetch_user->num_rows == 1) {
            $row_user = $result_fetch_user->fetch_assoc();
    
            // Fetch student's first name and last name from students table
            $sql_fetch_student = "SELECT s.first_name, s.last_name 
                                  FROM students s
                                  WHERE s.user_id = $user_id";
            $result_fetch_student = $conn->query($sql_fetch_student);
    
            if ($result_fetch_student->num_rows == 1) {
                $row_student = $result_fetch_student->fetch_assoc();

                $first_name = $row_student['first_name'];
                $last_name = $row_student['last_name'];
            }
        }
    } elseif ($admin_id) {
        // Fetch admin data
        $sql_fetch_admin = "SELECT first_name, last_name, position FROM admin WHERE id = $admin_id";
        $result_fetch_admin = $conn->query($sql_fetch_admin);

        if ($result_fetch_admin->num_rows == 1) {
            $row_admin = $result_fetch_admin->fetch_assoc();
            $first_name = $row_admin['first_name'];
            $last_name = $row_admin['last_name'];
            $position = $row_admin['position'];
        }
    } elseif ($teacher_id) {
        // Fetch teacher data
        $sql_fetch_teacher = "SELECT * FROM teachers WHERE id = $teacher_id";
        $result_fetch_teacher = $conn->query($sql_fetch_teacher);

        if ($result_fetch_teacher->num_rows == 1) {
            $row_teacher = $result_fetch_teacher->fetch_assoc();
            $first_name = $row_teacher['first_name'];
            $last_name = $row_teacher['last_name'];
        }
    } elseif ($guard_id) {
        // Fetch guard data
        $sql_fetch_guard = "SELECT * FROM guards WHERE id = $guard_id";
        $result_fetch_guard = $conn->query($sql_fetch_guard);

        if ($result_fetch_guard->num_rows == 1) {
            $row_guard = $result_fetch_guard->fetch_assoc();
            $first_name = $row_guard['first_name'];
            $last_name = $row_guard['last_name'];
        }
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
                <?php
                // Display error message if set
                if (!empty($error_message)) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Display user/admin info if logged in -->
    <?php if (isset($_SESSION['loggedin'])): ?>
        <div class="row mt-5">
            <div class="col-md-6 offset-md-6">
                <div class="widget-heading">
                    <?php echo $first_name . ' ' . $last_name; ?>
                </div>
                <div class="widget-subheading">
                    <?php echo $position; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>

<?php include "footer.php"; ?>


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
                <?php
                // Display error message if set
                if (!empty($error_message)) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>

<?php include "footer.php"; ?>

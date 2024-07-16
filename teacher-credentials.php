<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in and is authorized
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['teacher'])) {
    header('Location: index.php'); // Redirect if not logged in or not authorized
    exit;
}

// Check if user is logged in
if (isset($_SESSION['loggedin'])) {
    // Get teacher ID from session
    $teacher_id = $_SESSION['teacher_id'] ?? null;

    // Check if teacher ID is set in session
    if ($teacher_id) {
        // Include database connection
        include "conn.php";

        // Fetch teacher data based on teacher_id
        $sql = "SELECT * FROM teachers WHERE id = $teacher_id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            // Fetch teacher details
            $teacher = $result->fetch_assoc();
            $_SESSION['edit_teacher'] = $teacher; // Store teacher details in session for editing

            // Handle form submission to update teacher credentials
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
                // Retrieve form data
                $id = $_POST['id'];
                $username = $_POST['username'];
                $password = $_POST['password']; // Note: This should be hashed before storing in real-world applications
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];
                $position = $_POST['position'];

                // Check if the new username is already in use
                $check_username_sql = "SELECT COUNT(*) as count FROM teachers WHERE username = '$username' AND id != $id";
                $check_result = $conn->query($check_username_sql);

                if ($check_result && $check_result->num_rows > 0) {
                    $row = $check_result->fetch_assoc();
                    if ($row['count'] > 0) {
                        $error_message = "Username '$username' is already taken. Please choose a different username.";
                    } else {
                        // Update query
                        $update_sql = "UPDATE teachers SET username = '$username', password = '$password', 
                                       first_name = '$first_name', middle_name = '$middle_name', 
                                       last_name = '$last_name', email = '$email', position = '$position' 
                                       WHERE id = $id";

                        if ($conn->query($update_sql) === TRUE) {
                            $success_message = "Teacher credentials updated successfully.";
                            // Update session with new data
                            $teacher['username'] = $username;
                            $teacher['first_name'] = $first_name;
                            $teacher['middle_name'] = $middle_name;
                            $teacher['last_name'] = $last_name;
                            $teacher['email'] = $email;
                            $teacher['position'] = $position;
                            $_SESSION['edit_teacher'] = $teacher;
                        } else {
                            $error_message = "Error updating teacher credentials: " . $conn->error;
                        }
                    }
                } else {
                    $error_message = "Error checking username availability.";
                }
            }
        } else {
            // Handle case where teacher data is not found
            $error_message = "Teacher data not found.";
        }

        // Close database connection
    } else {
        // Handle case where teacher ID is not set in session
        $error_message = "Teacher ID not set in session.";
    }
} else {
    // Handle case where user is not logged in
    $error_message = "User ID not set in session.";
}

// Include header and other necessary files
include "head.php";
include "teacher-header.php";
?>

<div class="container mt-2 mb-5">
    <div class="container bg-white pt-4 rounded-lg">
        <h2 class="pb-4 font-weight-bold">Edit Credentials</h2>
    </div>

    <div class="container bg-white p-4 rounded-lg mt-2">
        <?php
        // Display error or success messages
        if (!empty($error_message)) {
            echo '<div class="alert alert-danger">' . $error_message . '</div>';
        }
        if (!empty($success_message)) {
            echo '<div class="alert alert-success">' . $success_message . '</div>';
        }

        // Display teacher details in editable form
        if (isset($_SESSION['edit_teacher'])) {
            $teacher = $_SESSION['edit_teacher'];
        ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $teacher['id']; ?>">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $teacher['username']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $teacher['password']; ?>" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePassword()">
                                        <i class="fa fa-eye" id="eye-icon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $teacher['first_name']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $teacher['middle_name']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $teacher['last_name']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $teacher['email']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" value="<?php echo $teacher['position']; ?>" readonly>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        <?php } ?>

    </div>
</div>

<?php
// Include footer and other necessary files
include "footer.php";
include "teacher-footer.php";
?>

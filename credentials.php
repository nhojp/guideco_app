<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    
}
// Check if user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['admin'])) {
    header('Location: index.php'); // Redirect if not logged in or not admin
    exit;
}
// Check if user or admin is logged in
if (isset($_SESSION['loggedin'])) {
    // Assuming admin-specific session handling
    $admin_id = $_SESSION['admin_id'] ?? null;

    // Check if admin ID is set in session
    if ($admin_id) {
        // Include database connection
        include "conn.php";

        // Fetch admin data based on admin_id
        $sql = "SELECT * FROM admin WHERE id = $admin_id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            // Fetch admin details
            $admin = $result->fetch_assoc();
            $_SESSION['edit_admin'] = $admin; // Store admin details in session for editing

            // Handle form submission to update admin credentials
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

                // Update query
                $update_sql = "UPDATE admin SET username = '$username', password = '$password', 
                               first_name = '$first_name', middle_name = '$middle_name', 
                               last_name = '$last_name', email = '$email', position = '$position' 
                               WHERE id = $id";

                if ($conn->query($update_sql) === TRUE) {
                    $success_message = "Admin credentials updated successfully.";
                    // Update the session with new data after successful update
                    $admin['username'] = $username;
                    $admin['first_name'] = $first_name;
                    $admin['middle_name'] = $middle_name;
                    $admin['last_name'] = $last_name;
                    $admin['email'] = $email;
                    $admin['position'] = $position;
                    $_SESSION['edit_admin'] = $admin;
                } else {
                    $error_message = "Error updating admin credentials: " . $conn->error;
                }
            }
        } else {
            // Handle case where admin data is not found
            // You may set default values or handle this situation accordingly
            $error_message = "Admin data not found.";
        }

        // Close database connection
    } else {
        // Handle case where admin ID is not set in session
        echo "Admin ID not set in session.";
    }
} else {
    // Handle case where user/admin is not logged in
    echo "User ID not set in session.";
}

include "head.php";
include "admin-header.php";
?>

<div class="container mt-2 mb-5">
<div class="container bg-white pt-4 rounded-lg">

    <h2 class="pb-4 font-weight-bold">Edit Admin Credentials</h2>
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

        // Display admin details in editable form
        if (isset($_SESSION['edit_admin'])) {
            $admin = $_SESSION['edit_admin'];
        ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $admin['username']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $admin['password']; ?>" required>
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
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $admin['first_name']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $admin['middle_name']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $admin['last_name']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $admin['email']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" value="<?php echo $admin['position']; ?>" required>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        <?php } ?>

    </div>
</div>

<?php
include "footer.php";
include "admin-footer.php";
?>

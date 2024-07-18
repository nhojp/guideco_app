<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php'); // Redirect if not logged in
    exit;
}

// Check role-specific access
if (isset($_SESSION['admin'])) {
    $role = 'admin';
    $role_id = $_SESSION['admin_id'] ?? null;
} elseif (isset($_SESSION['teacher'])) {
    $role = 'teacher';
    $role_id = $_SESSION['teacher_id'] ?? null;
} elseif (isset($_SESSION['guard'])) {
    $role = 'guard';
    $role_id = $_SESSION['guard_id'] ?? null;
} else {
    // Redirect to appropriate login page if role is not recognized
    header('Location: index.php');
    exit;
}

// Include database connection
include "conn.php";

// Fetch user data based on role and role_id
if ($role && $role_id) {
    $table_name = ($role == 'admin') ? 'admin' : (($role == 'teacher') ? 'teachers' : 'guards');
    $sql = "SELECT * FROM $table_name WHERE id = $role_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        // Fetch user details
        $user = $result->fetch_assoc();
        $_SESSION['edit_user'] = $user; // Store user details in session for editing

        // Handle form submission to update credentials
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
            $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : ''; // Initialize $birthdate with default value or empty string
            $sex = isset($_POST['sex']) ? $_POST['sex'] : ''; // Initialize $sex with default value or empty string
            $contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : ''; // Initialize $contact_number with default value or empty string
            $address = isset($_POST['address']) ? $_POST['address'] : ''; // Initialize $address with default value or empty string

            // Update query
            $update_sql = "UPDATE $table_name SET username = '$username', password = '$password', 
                           first_name = '$first_name', middle_name = '$middle_name', 
                           last_name = '$last_name', email = '$email', position = '$position', 
                           birthdate = '$birthdate', sex = '$sex', contact_number = '$contact_number',
                           address = '$address'
                           WHERE id = $id";

            if ($conn->query($update_sql) === TRUE) {
                $success_message = "Credentials updated successfully.";
                // Update session with new data
                $user['username'] = $username;
                $user['first_name'] = $first_name;
                $user['middle_name'] = $middle_name;
                $user['last_name'] = $last_name;
                $user['email'] = $email;
                $user['position'] = $position;
                $user['birthdate'] = $birthdate;
                $user['sex'] = $sex;
                $user['contact_number'] = $contact_number;
                $user['address'] = $address;
                $_SESSION['edit_user'] = $user;
            } else {
                $error_message = "Error updating credentials: " . $conn->error;
            }
        }
    } else {
        // Handle case where user data is not found
        $error_message = ucfirst($role) . " data not found.";
    }
} else {
    // Handle case where role or role_id is not set in session
    $error_message = ucfirst($role) . " ID not set in session.";
}


// Include header and other necessary files based on role
include "head.php";
if ($role == 'admin') {
    include "admin-header.php";
} elseif ($role == 'teacher') {
    include "teacher-header.php";
} elseif ($role == 'guard') {
    include "guard-header.php";
}
?>

<div class="container mt-2 mb-5">
    <div class="container bg-white pt-4 rounded-lg">
        <h2 class="pb-4 font-weight-bold">Edit <?php echo ucfirst($role); ?> Credentials</h2>
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

        // Display user details in editable form
        if (isset($_SESSION['edit_user'])) {
            $user = $_SESSION['edit_user'];
        ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
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
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $user['middle_name']; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" value="<?php echo $user['position']; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($user['birthdate']); ?>" required>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sex">Sex</label>
                            <div class="form-group">
    <select class="form-control" id="sex" name="sex">
        <option value="Male" <?php if ($user['sex'] == 'Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if ($user['sex'] == 'Female') echo 'selected'; ?>>Female</option>
    </select>
</div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($user['contact_number']); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        <?php } ?>

    </div>
</div>

<?php
// Include footer and other necessary files based on role
include "admin-footer.php";

include "footer.php";
?>

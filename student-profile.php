<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['user_id'])) {
    // Redirect if not logged in
    header('Location: index.php');
    exit;
}

// Include database connection
include "conn.php";

// Initialize variables
$error_message = "";
$success_message = "";
$user = [];
$student = [];
$section = [];
$grade = [];
$mother = [];
$father = [];

// Fetch student ID from session
$student_id = $_SESSION['user_id'];

// Fetch student data from students table
$sql_student = "SELECT * FROM students WHERE id = $student_id";
$result_student = $conn->query($sql_student);

if ($result_student && $result_student->num_rows == 1) {
    // Fetch student details
    $student = $result_student->fetch_assoc();

    // Fetch email from users table (assuming it's linked with the student ID)
    $sql_email = "SELECT email FROM users WHERE id = $student_id";
    $result_email = $conn->query($sql_email);
    $user = ($result_email && $result_email->num_rows == 1) ? $result_email->fetch_assoc() : null;

    // Fetch section details
    $section_id = $student['section_id'];
    $sql_section = "SELECT * FROM sections WHERE id = $section_id";
    $result_section = $conn->query($sql_section);
    $section = ($result_section && $result_section->num_rows == 1) ? $result_section->fetch_assoc() : null;

    // Fetch grade details
    if ($section) {
        $grade_id = $section['grade_id'];
        $sql_grade = "SELECT * FROM grades WHERE id = $grade_id";
        $result_grade = $conn->query($sql_grade);
        $grade = ($result_grade && $result_grade->num_rows == 1) ? $result_grade->fetch_assoc() : null;
    }

    // Fetch mother details
    $sql_mother = "SELECT * FROM mothers WHERE student_id = $student_id LIMIT 1";
    $result_mother = $conn->query($sql_mother);
    $mother = ($result_mother && $result_mother->num_rows == 1) ? $result_mother->fetch_assoc() : [];

    // Fetch father details
    $sql_father = "SELECT * FROM fathers WHERE student_id = $student_id LIMIT 1";
    $result_father = $conn->query($sql_father);
    $father = ($result_father && $result_father->num_rows == 1) ? $result_father->fetch_assoc() : [];

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update student details
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $birthdate = $_POST['birthdate'];
        $sex = $_POST['sex'];
        $contact_number = $_POST['contact_number'];
        $religion = $_POST['religion'];

        $sql_update_student = "UPDATE students SET first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name', birthdate = '$birthdate', sex = '$sex', contact_number = '$contact_number', religion = '$religion' WHERE id = $student_id";

        if ($conn->query($sql_update_student) === TRUE) {
            // Student updated successfully
            $success_message .= "Student details updated successfully. ";
        } else {
            $error_message .= "Error updating student: " . $conn->error . ". ";
        }

        // Update or insert mother details
        $mother_parent_id = isset($_POST['mother_parent_id']) ? $_POST['mother_parent_id'] : null;
        $mother_name = $_POST['mother_name'];
        $mother_contact = $_POST['mother_contact'];
        $mother_email = $_POST['mother_email'];

        if ($mother_parent_id) {
            // Update existing mother record
            $sql_update_mother = "UPDATE mothers SET name = '$mother_name', contact_number = '$mother_contact', email = '$mother_email' WHERE parent_id = $mother_parent_id";
        } else {
            // Insert new mother record
            $sql_update_mother = "INSERT INTO mothers (student_id, name, contact_number, email) VALUES ($student_id, '$mother_name', '$mother_contact', '$mother_email')";
        }

        if ($conn->query($sql_update_mother) === TRUE) {
            // Mother updated successfully
            $success_message .= "Mother details updated successfully. ";
        } else {
            $error_message .= "Error updating mother: " . $conn->error . ". ";
        }

        // Update or insert father details
        $father_parent_id = isset($_POST['father_parent_id']) ? $_POST['father_parent_id'] : null;
        $father_name = $_POST['father_name'];
        $father_contact = $_POST['father_contact'];
        $father_email = $_POST['father_email'];

        if ($father_parent_id) {
            // Update existing father record
            $sql_update_father = "UPDATE fathers SET name = '$father_name', contact_number = '$father_contact', email = '$father_email' WHERE parent_id = $father_parent_id";
        } else {
            // Insert new father record
            $sql_update_father = "INSERT INTO fathers (student_id, name, contact_number, email) VALUES ($student_id, '$father_name', '$father_contact', '$father_email')";
        }

        if ($conn->query($sql_update_father) === TRUE) {
            // Father updated successfully
            $success_message .= "Father details updated successfully. ";
        } else {
            $error_message .= "Error updating father: " . $conn->error . ". ";
        }
    }
}

// Include header
include "head.php";
?>

<div class="container mt-2 mb-5">
    <div class="container bg-white pt-4 rounded-lg">
        <h2 class="pb-4 font-weight-bold">Student Profile</h2>
    </div>

    <div class="container bg-white p-4 rounded-lg mt-2">
        <div class="row">
            <div class="col-md-6">
                <?php
                if (!empty($error_message)) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                }
                if (!empty($success_message)) {
                    echo '<div class="alert alert-success">' . $success_message . '</div>';
                }
                ?>
                <form action="" method="post">
                    <!-- Student Details -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo ($user) ? $user['email'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $student['first_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $student['middle_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $student['last_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $student['birthdate']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <input type="text" class="form-control" id="sex" name="sex" value="<?php echo $student['sex']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="text" class="form-control" id="grade" name="grade" value="<?php echo ($grade) ? $grade['grade_name'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="section">Section</label>
                        <input type="text" class="form-control" id="section" name="section" value="<?php echo ($section) ? $section['section_name'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $student['contact_number']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="religion">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $student['religion']; ?>">
                    </div>

                    <!-- Mother Details -->
                    <div class="form-group">
                        <h5 class="font-weight-bold mt-4">Mother Details</h5>
                        <input type="hidden" name="mother_parent_id" value="<?php echo ($mother) ? $mother['parent_id'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mother_name">Name</label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?php echo ($mother) ? $mother['name'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mother_contact">Contact Number</label>
                        <input type="text" class="form-control" id="mother_contact" name="mother_contact" value="<?php echo ($mother) ? $mother['contact_number'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mother_email">Email</label>
                        <input type="email" class="form-control" id="mother_email" name="mother_email" value="<?php echo ($mother) ? $mother['email'] : ''; ?>">
                    </div>

                    <!-- Father Details -->
                    <div class="form-group">
                        <h5 class="font-weight-bold mt-4">Father Details</h5>
                        <input type="hidden" name="father_parent_id" value="<?php echo ($father) ? $father['parent_id'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="father_name">Name</label>
                        <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo ($father) ? $father['name'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="father_contact">Contact Number</label>
                        <input type="text" class="form-control" id="father_contact" name="father_contact" value="<?php echo ($father) ? $father['contact_number'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="father_email">Email</label>
                        <input type="email" class="form-control" id="father_email" name="father_email" value="<?php echo ($father) ? $father['email'] : ''; ?>">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<div class="container">
    <!-- ChatLing Widget Integration -->
    <div id="chatling-embed-container"></div>
    <script async data-id="7485494224" id="chatling-embed-script" type="text/javascript" src="https://chatling.ai/js/embed.js"></script>
</div>

<?php include('footer.php'); ?>

</div>

<?php
// Include footer
include "footer.php";
?>

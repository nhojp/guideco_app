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
$user = [];
$student = [];
$section = [];
$grade = [];
$parents = [];

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

    // Fetch parent(s) details
    $sql_parents = "SELECT p.*, sp.parent_type 
                    FROM parents p 
                    INNER JOIN student_parents sp ON p.parent_id = sp.parent_id 
                    WHERE sp.student_id = $student_id";
    $result_parents = $conn->query($sql_parents);
    $parents = ($result_parents && $result_parents->num_rows > 0) ? $result_parents->fetch_all(MYSQLI_ASSOC) : [];

    // Process form submissions (if any)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update student details
        if (isset($_POST['update_student'])) {
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
                $success_message = "Student details updated successfully.";
            } else {
                $error_message = "Error updating student: " . $conn->error;
            }
        }

        // Update parent details
        if (isset($_POST['update_parent'])) {
            $parent_id = $_POST['parent_id'];
            $parent_name = $_POST['parent_name'];
            $parent_contact = $_POST['parent_contact'];
            $parent_email = $_POST['parent_email'];

            $sql_update_parent = "UPDATE parents SET name = '$parent_name', contact_number = '$parent_contact', email = '$parent_email' WHERE parent_id = $parent_id";

            if ($conn->query($sql_update_parent) === TRUE) {
                // Parent updated successfully
                $success_message = "Parent details updated successfully.";
            } else {
                $error_message = "Error updating parent: " . $conn->error;
            }
        }
    }

    // Fetch updated parent list after potential updates
    $result_parents = $conn->query($sql_parents);
    $parents = ($result_parents && $result_parents->num_rows > 0) ? $result_parents->fetch_all(MYSQLI_ASSOC) : $parents;

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
                    <form action="student-index.php" method="post">
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
                            <input type="text" class="form-control" id="birthdate" name="birthdate" value="<?php echo $student['birthdate']; ?>">
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

                        <!-- Display Parent Information -->
                        <h4 class="pb-3 font-weight-bold">Parent(s)</h4>
                        <?php
                        if (!empty($parents)) {
                            foreach ($parents as $parent) {
                                ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $parent['name']; ?> (<?php echo ucfirst($parent['parent_type']); ?>)</h5>
                                        <form action="student-index.php" method="post">
                                            <input type="hidden" name="parent_id" value="<?php echo $parent['parent_id']; ?>">
                                            <div class="form-group">
                                                <label for="parent_name">Parent Name</label>
                                                <input type="text" class="form-control" id="parent_name" name="parent_name" value="<?php echo $parent['name']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="parent_contact">Contact Number</label>
                                                <input type="text" class="form-control" id="parent_contact" name="parent_contact" value="<?php echo $parent['contact_number']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="parent_email">Email</label>
                                                <input type="email" class="form-control" id="parent_email" name="parent_email" value="<?php echo $parent['email']; ?>">
                                            </div>
                                            <input type="submit" class="btn btn-primary" name="update_parent" value="Update Parent">
                                            <a href="delete_parent.php?parent_id=<?php echo $parent['parent_id']; ?>" class="btn btn-danger">Delete Parent</a>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p>No parent information found.</p>";
                        }
                        ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addParentModal">Add Parent</button>

                        <!-- Update Student Button -->
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="update_student" value="Update Student">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    // Handle case where student data is not found
    $error_message = "Student data not found.";
}

// Include footer and other necessary files
include "footer.php";
?>

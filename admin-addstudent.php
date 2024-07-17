<?php
include 'conn.php'; // Database connection

// Fetch all students
$query_students = "SELECT id, first_name, middle_name, last_name, section_id FROM students";
$result_students = $conn->query($query_students);

// Fetch all sections
$query_sections = "SELECT id, section_name, grade_id FROM sections";
$result_sections = $conn->query($query_sections);
$sections = [];
while ($row = $result_sections->fetch_assoc()) {
    $sections[$row['id']] = ['name' => $row['section_name'], 'grade_id' => $row['grade_id']];
}

// Fetch all grades
$query_grades = "SELECT id, grade_name FROM grades";
$result_grades = $conn->query($query_grades);
$grades = [];
while ($row = $result_grades->fetch_assoc()) {
    $grades[$row['id']] = $row['grade_name'];
}

// Fetch count of violations for each student
$query_violations = "SELECT student_id, COUNT(*) as violation_count FROM violations GROUP BY student_id";
$result_violations = $conn->query($query_violations);
$violations = [];
while ($row = $result_violations->fetch_assoc()) {
    $violations[$row['student_id']] = $row['violation_count'];
}

// Handle add student form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_student') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $section_id = $_POST['section_id'];
    
    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    // Insert new student into database
    $query = "INSERT INTO students (username, password, first_name, middle_name, last_name, section_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $username, $hashed_password, $first_name, $middle_name, $last_name, $section_id);
    $stmt->execute();
    $stmt->close();
    
    // Refresh the page to update the student list
    header("Location: admin-addstudent.php");
    exit();
}

// Fetch detailed student information if a specific student ID is provided
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $query = "SELECT s.id, s.username, s.first_name, s.middle_name, s.last_name, sec.section_name, g.grade_name 
              FROM students s
              JOIN sections sec ON s.section_id = sec.id
              JOIN grades g ON sec.grade_id = g.id
              WHERE s.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student_details = $result->fetch_assoc();
    $stmt->close();
    
    if ($student_details) {
        echo json_encode($student_details);
    }
    exit();
}
include 'head.php';
include 'admin-header.php';
// Close the database connection
?>


<div class="container-fluid mt-2 mb-5">
    <div class="container-fluid bg-white pt-4 rounded-lg">
        <div class="row">
            <div class="col-md-4">
                <h2 class="mb-4 font-weight-bold">Student List</h2>
            </div>

            <div class="col-md-8">
                <div class="search-wrapper float-right">
                    <div class="input-holder">
                        <input type="text" class="search-input" id="searchInput" placeholder="Type to search">
                        <button class="search-icon"><span></span></button>
                    </div>
                    <button class="close"></button>
                </div>
            </div>
        </div>
    </div>
        <div class="container-fluid bg-white pt-4 rounded-lg mt-2">

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addStudentModal">Add Student</button>
        </div>
        <div class="container-fluid bg-white p-4 rounded-lg mt-2">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Section</th>
                <th>Grade</th>
                <th>Violations Count</th>
                <th>View More</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($student = $result_students->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['id']); ?></td>
                    <td><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($sections[$student['section_id']]['name']); ?></td>
                    <td>
                        <?php
                        $section_id = $student['section_id'];
                        $grade_id = isset($sections[$section_id]['grade_id']) ? $sections[$section_id]['grade_id'] : null;
                        $grade_name = isset($grades[$grade_id]) ? $grades[$grade_id] : 'N/A';
                        echo htmlspecialchars($grade_name);
                        ?>
                    </td>
                    <td><?php echo isset($violations[$student['id']]) ? htmlspecialchars($violations[$student['id']]) : '0'; ?></td>
                    <td>
                        <button class="btn btn-info" data-toggle="modal" data-target="#viewStudentModal" data-id="<?php echo htmlspecialchars($student['id']); ?>">View More</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div></div></div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm" method="post">
                    <input type="hidden" name="action" value="add_student">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="section_id">Section</label>
                        <select class="form-control" id="section_id" name="section_id" required>
                            <!-- Options will be dynamically populated based on selected grade -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="viewStudentModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStudentModalLabel">Student Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="studentDetails">
                <!-- Student details will be loaded here via jQuery -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle add student form submission
        $('#addStudentForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            var formData = $(this).serialize();
            
            $.post('admin-addstudent.php', formData, function(response) {
                alert('Student added successfully!');
                $('#addStudentModal').modal('hide');
                location.reload(); // Refresh the page to update the student list
            });
        });

        // Handle view more button click
        $('#viewStudentModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var studentId = button.data('id'); // Extract info from data-* attributes
            
            $.get('admin-addstudent.php', { id: studentId }, function(response) {
                var student = JSON.parse(response);
                var detailsHtml = '<p><strong>ID:</strong> ' + student.id + '</p>' +
                                  '<p><strong>Username:</strong> ' + student.username + '</p>' +
                                  '<p><strong>Full Name:</strong> ' + student.first_name + ' ' + student.middle_name + ' ' + student.last_name + '</p>' +
                                  '<p><strong>Section:</strong> ' + student.section_name + '</p>' +
                                  '<p><strong>Grade:</strong> ' + student.grade_name + '</p>';
                $('#studentDetails').html(detailsHtml);
            });
        });

        // Handle grade dropdown change
        $('#grade_id').on('change', function() {
            var gradeId = $(this).val();
            
            $.get('admin-getsections.php', { grade_id: gradeId }, function(response) {
                $('#section_id').html(response);
            }).fail(function() {
                // Handle errors
                alert('Error loading sections');
            });
        });
    });
</script>
</body>
</html>
<?php include 'admin-footer.php';?>
<?php include 'footer.php';?>
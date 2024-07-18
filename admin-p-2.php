<?php
// Include the database connection
include "conn.php";

// Include the header
include "head.php";

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['admin_id'])) {
    // Redirect if not logged in
    header('Location: index.php');
    exit;
}

// Ensure the selected person information is available
if (!isset($_POST['person_id']) || !isset($_POST['person_type'])) {
    // Redirect or handle the case where no person is selected
    header('Location: admin-p-list.php');
    exit;
}

$person_id = $_POST['person_id'];
$person_type = $_POST['person_type'];

// Fetch the name of the selected personnel (teacher or guard)
$sql_person = "";
if ($person_type === 'teacher') {
    $sql_person = "SELECT * FROM teachers WHERE id = $person_id";
} elseif ($person_type === 'guard') {
    $sql_person = "SELECT * FROM guards WHERE id = $person_id";
}

$result_person = $conn->query($sql_person);
if ($result_person->num_rows > 0) {
    $person = $result_person->fetch_assoc();
    $person_name = $person['first_name'] . " " . $person['last_name'];
} else {
    $person_name = "Unknown";
}

// Fetch all students with their related section and grade
$sql_students = "SELECT s.id, s.first_name, s.last_name, sec.section_name, g.grade_name
                 FROM students s
                 INNER JOIN sections sec ON s.section_id = sec.id
                 INNER JOIN grades g ON sec.grade_id = g.id";
$result_students = $conn->query($sql_students);

include "admin-header.php";
?>

<div class="container mt-5">
    <h3>Choose Victim of <?php echo $person_name; ?></h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Section</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result_students->num_rows > 0) : ?>
                <?php while ($student = $result_students->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $student['first_name'] . " " . $student['last_name']; ?></td>
                        <td><?php echo $student['section_name']; ?></td>
                        <td><?php echo $student['grade_name']; ?></td>
                        <td>
                            <form action="admin-p-3.php" method="get">
                                <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                <input type="hidden" name="person_id" value="<?php echo $person_id; ?>">
                                <input type="hidden" name="person_type" value="<?php echo $person_type; ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Select</button>
                            </form>

                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No students found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
// Include footer
include "admin-footer.php";
?>
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



<div class="container-fluid mt-2 mb-5">
    <div class="container-fluid bg-white pt-4 rounded-lg">
        <div class="row">
            <div class="col-md-8">
                <h2 class="mb-4 font-weight-bold">Choose Victim of <?php echo ucwords($person_name); ?></h2>
            </div>

            <div class="col-md-4">
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
    <div class="container-fluid bg-white pt-4 mt-2 rounded-lg">

    <table class="table table-borderless text-center table-hover ">
    <thead>
                <tr>
                    <th style="width: 50%;">Full Name</th>
                    <th style="width: 20%;">Grade</th>
                    <th style="width: 20%;">Section</th>
                    <th style="width: 10%;">Select</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_students->num_rows > 0) : ?>
                    <?php while ($student = $result_students->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo ucwords($student['first_name']) . " " . ucwords($student['last_name']); ?></td>
                            <td><?php echo ucwords($student['grade_name']); ?></td>
                            <td><?php echo ucwords($student['section_name']); ?></td>
                            <td>
                                <form action="admin-p-3.php" method="get">
                                    <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                    <input type="hidden" name="person_id" value="<?php echo $person_id; ?>">
                                    <input type="hidden" name="person_type" value="<?php echo $person_type; ?>">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Select</button>
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
</div>
<?php
// Include footer
include "admin-footer.php";
?>
<?php
// Including the necessary files
include 'conn.php';
include 'head.php';
include 'admin-header.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['admin'])) {
    header('Location: index.php'); // Redirect if not logged in or not an admin
    exit;
}

// SQL query to fetch violations data from both guards and teachers
$query = "
    SELECT violations.id, students.first_name, students.middle_name, students.last_name, 
           students.age, students.sex, sections.section_name, grades.grade_name, 
           violations.violation, 
           CASE
               WHEN violations.guard_id IS NOT NULL THEN guards.first_name
               WHEN violations.teacher_id IS NOT NULL THEN teachers.first_name
               ELSE 'Unknown'
           END AS reported_by_name,
           CASE
               WHEN violations.guard_id IS NOT NULL THEN 'Guard'
               WHEN violations.teacher_id IS NOT NULL THEN 'Teacher'
               ELSE 'Unknown'
           END AS reported_by_type,
           violations.reported_at
    FROM violations
    JOIN students ON violations.student_id = students.id
    JOIN sections ON students.section_id = sections.id
    JOIN grades ON sections.grade_id = grades.id
    LEFT JOIN guards ON violations.guard_id = guards.id
    LEFT JOIN teachers ON violations.teacher_id = teachers.id
    ORDER BY violations.reported_at DESC
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<div class="container mt-2 mb-5">
    <div class="container bg-white pt-4 rounded-lg">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-4 font-weight-bold">Reported Violations</h2>
            </div>
            <div class="col-md-6">
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

    <div class="container bg-white pt-4 rounded-lg mt-2">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="filter_grade">Filter by Grade:</label>
                <select class="form-control" id="filter_grade">
                    <option value="">All Grades</option>
                    <?php
                    // Fetching grades for filter
                    $grades_query = "SELECT id, grade_name FROM grades";
                    $grades_result = mysqli_query($conn, $grades_query);

                    if ($grades_result) {
                        while ($grade_row = mysqli_fetch_assoc($grades_result)) {
                            echo "<option value='{$grade_row['grade_name']}'>{$grade_row['grade_name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="filter_section">Filter by Section:</label>
                <select class="form-control" id="filter_section">
                    <option value="">All Sections</option>
                    <?php
                    // Fetching sections for filter
                    $sections_query = "SELECT id, section_name FROM sections";
                    $sections_result = mysqli_query($conn, $sections_query);

                    if ($sections_result) {
                        while ($section_row = mysqli_fetch_assoc($sections_result)) {
                            echo "<option value='{$section_row['section_name']}'>{$section_row['section_name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="filter_reported_by_type">Filter by Reported By Type:</label>
                <select class="form-control" id="filter_reported_by_type">
                    <option value="">All</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Guard">Guard</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="filter_violation">Filter by Violation:</label>
                <select class="form-control" id="filter_violation">
                    <option value="">All Violations</option>
                    <?php
                    // Fetching violations for filter
                    $violations_query = "SELECT DISTINCT violation FROM violations ORDER BY violation";
                    $violations_result = mysqli_query($conn, $violations_query);

                    if ($violations_result) {
                        while ($violation_row = mysqli_fetch_assoc($violations_result)) {
                            echo "<option value='{$violation_row['violation']}'>{$violation_row['violation']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="container bg-white p-4 rounded-lg mt-2">
        <div class="table-responsive">
            <table id="violations_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Grade</th>
                        <th>Section</th>
                        <th>Violation</th>
                        <th style="display: none;">Reported By Type</th>
                        <th>Reported By Name</th>
                        <th>Reported At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr data-grade="<?php echo strtolower($row['grade_name']); ?>" data-section="<?php echo strtolower($row['section_name']); ?>" data-reported-by-type="<?php echo strtolower($row['reported_by_type']); ?>" data-reported-by-name="<?php echo strtolower($row['reported_by_name']); ?>" data-violation="<?php echo strtolower($row['violation']); ?>">
                            <td><?php echo ucfirst($row['first_name']) . ' ' . ucfirst($row['middle_name']) . ' ' . ucfirst($row['last_name']); ?></td>
                            <td><?php echo ucfirst($row['grade_name']); ?></td>
                            <td><?php echo ucfirst($row['section_name']); ?></td>
                            <td><?php echo ucfirst($row['violation']); ?></td>
                            <td style="display: none;"><?php echo ucfirst($row['reported_by_type']); ?></td>
                            <td><?php echo ucfirst($row['reported_by_name']); ?></td>
                            <td><?php echo $row['reported_at']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<?php include 'admin-footer.php'; ?>

<script>
    $(document).ready(function() {
        // Filter functionality
        $('#filter_grade, #filter_section, #filter_reported_by_type, #filter_violation').change(filterViolations);

        function filterViolations() {
            var gradeFilter = $('#filter_grade').val();
            var sectionFilter = $('#filter_section').val();
            var reportedByTypeFilter = $('#filter_reported_by_type').val().toLowerCase(); // Convert to lowercase for comparison
            var violationFilter = $('#filter_violation').val().toLowerCase(); // Convert to lowercase for comparison

            $('#violations_table tbody tr').each(function() {
                var grade = $(this).data('grade');
                var section = $(this).data('section');
                var reportedByType = $(this).data('reported-by-type');
                var violation = $(this).data('violation');

                // Convert data attributes to lowercase for case-insensitive comparison
                grade = grade ? grade.toLowerCase() : '';
                section = section ? section.toLowerCase() : '';
                reportedByType = reportedByType ? reportedByType.toLowerCase() : '';
                violation = violation ? violation.toLowerCase() : '';

                var gradeMatch = (gradeFilter === '' || grade === gradeFilter.toLowerCase());
                var sectionMatch = (sectionFilter === '' || section === sectionFilter.toLowerCase());
                var reportedByTypeMatch = (reportedByTypeFilter === '' || reportedByType === reportedByTypeFilter.toLowerCase());
                var violationMatch = (violationFilter === '' || violation.includes(violationFilter));

                if (gradeMatch && sectionMatch && reportedByTypeMatch && violationMatch) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>

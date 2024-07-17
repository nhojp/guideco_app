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

// Handle deletion request
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // SQL query to delete violation
    $delete_query = "DELETE FROM violations WHERE id = '$delete_id'";
    $delete_result = mysqli_query($conn, $delete_query);

    if (!$delete_result) {
        die("Deletion failed: " . mysqli_error($conn));
    }

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

<div class="container-fluid mt-2 mb-5">
    <div class="container-fluid bg-white pt-4 rounded-lg">
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

    <div class="container-fluid bg-white pt-4 rounded-lg mt-2">
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

    <div class="container-fluid bg-white p-4 rounded-lg mt-2">
        <div class="table-responsive">
            <table id="violations_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th style="width:35%;">Name</th>
                        <th style="width:9%;">Grade</th>
                        <th style="width:5%;">Section</th>
                        <th style="width:20%;">Violation</th>
                        <th style="display: none;"></th>
                        <th style="width:16%;">Reported by</th>
                        <th style="width:15%;">Reported at</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr data-grade="<?php echo strtolower($row['grade_name']); ?>" 
                            data-section="<?php echo strtolower($row['section_name']); ?>" 
                            data-reported-by-type="<?php echo strtolower($row['reported_by_type']); ?>" 
                            data-reported-by-name="<?php echo strtolower($row['reported_by_name']); ?>" 
                            data-violation="<?php echo strtolower($row['violation']); ?>">
                            <td><?php echo ucfirst($row['first_name']) . ' ' . ucfirst($row['middle_name']) . ' ' . ucfirst($row['last_name']); ?></td>
                            <td><?php echo ucfirst($row['grade_name']); ?></td>
                            <td><?php echo ucfirst($row['section_name']); ?></td>
                            <td><?php echo ucfirst($row['violation']); ?></td>
                            <td style="display: none;"><?php echo ucfirst($row['reported_by_type']); ?></td>
                            <td><?php echo ucfirst($row['reported_by_name']); ?></td>
                            <td><?php echo $row['reported_at']; ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-violation" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirmDeleteModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this violation?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="post" action="">
                    <input type="hidden" name="delete_id" id="delete_id" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Bind events
    $('#filter_grade, #filter_section, #filter_reported_by_type, #filter_violation').change(applyFilters);
    $('#searchInput').on('input', onSearchInput);
    $('.delete-violation').click(onDeleteButtonClick);
    $('#confirmDeleteModal').on('hide.bs.modal', clearDeleteId);
});

function applyFilters() {
    // Retrieve filter values
    var gradeFilter = $('#filter_grade').val().toLowerCase();
    var sectionFilter = $('#filter_section').val().toLowerCase();
    var reportedByTypeFilter = $('#filter_reported_by_type').val().toLowerCase();
    var violationFilter = $('#filter_violation').val().toLowerCase();

    // Iterate over table rows and apply filters
    $('#violations_table tbody tr').each(function() {
        var grade = $(this).data('grade').toLowerCase();
        var section = $(this).data('section').toLowerCase();
        var reportedByType = $(this).data('reported-by-type').toLowerCase();
        var violation = $(this).data('violation').toLowerCase();

        var gradeMatch = (gradeFilter === '' || grade === gradeFilter);
        var sectionMatch = (sectionFilter === '' || section === sectionFilter);
        var reportedByTypeMatch = (reportedByTypeFilter === '' || reportedByType === reportedByTypeFilter);
        var violationMatch = (violationFilter === '' || violation.includes(violationFilter));

        if (gradeMatch && sectionMatch && reportedByTypeMatch && violationMatch) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

function onSearchInput() {
    var searchTerm = $(this).val().toLowerCase();

    $('#violations_table tbody tr').each(function() {
        var name = $(this).find('td:first').text().toLowerCase();
        var violation = $(this).find('td:nth-child(4)').text().toLowerCase();

        if (name.includes(searchTerm) || violation.includes(searchTerm)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

function onDeleteButtonClick() {
    var deleteId = $(this).data('id');
    $('#delete_id').val(deleteId);
}

function clearDeleteId() {
    $('#delete_id').val('');
}
</script>

<?php include "footer.php"; include "admin-footer.php"; ?>

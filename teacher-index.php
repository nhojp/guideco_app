<?php
// Including the necessary files
include 'conn.php';
include 'head.php';
// Start the session
session_start();

include 'teacher-header.php';

// Check if user is logged in and is a teacher
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['teacher'])) {
    header('Location: index.php'); // Redirect if not logged in or not a teacher
    exit;
}

// SQL query to fetch students data
$query = "
    SELECT students.id, students.first_name, students.middle_name, students.last_name, 
           students.age, students.sex, sections.id as section_id, sections.section_name, grades.id as grade_id, grades.grade_name
    FROM students
    JOIN sections ON students.section_id = sections.id
    JOIN grades ON sections.grade_id = grades.id
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// SQL query to fetch sections data
$sections_query = "SELECT id, section_name FROM sections";
$sections_result = mysqli_query($conn, $sections_query);

if (!$sections_result) {
    die("Query failed: " . mysqli_error($conn));
}

// SQL query to fetch grades data
$grades_query = "SELECT id, grade_name FROM grades";
$grades_result = mysqli_query($conn, $grades_query);

if (!$grades_result) {
    die("Query failed: " . mysqli_error($conn));
}

// Reset result set pointers
mysqli_data_seek($sections_result, 0);
mysqli_data_seek($grades_result, 0);
?>

<div class="container-fluid mt-2 mb-5">
    <div class="container-fluid bg-white pt-4 rounded-lg">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4 font-weight-bold">Students List</h2>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-white mt-2 pb-2 pt-4 rounded-lg">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="filter_grade">Filter by Grade:</label>
                    <select class="form-control" id="filter_grade" name="filter_grade">
                        <option value="">All Grades</option>
                        <?php while ($grade_row = mysqli_fetch_assoc($grades_result)): ?>
                            <option value="<?php echo $grade_row['id']; ?>"><?php echo ucfirst($grade_row['grade_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="filter_section">Filter by Section:</label>
                    <select class="form-control" id="filter_section" name="filter_section">
                        <option value="">All Sections</option>
                        <?php while ($section_row = mysqli_fetch_assoc($sections_result)): ?>
                            <option value="<?php echo $section_row['id']; ?>">
                                <?php echo ucfirst($section_row['section_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
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


    <div class="container-fluid bg-white p-4 rounded-lg mt-2">
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th style="width:40%;">Full Name</th>
                        <th style="width:25%;">Grade</th>
                        <th style="width:25%;">Section</th>
                        <th style="width:10%;">Report</th>
                    </tr>
                </thead>
                <tbody id="students_table">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr data-section-id="<?php echo $row['section_id']; ?>"
                            data-grade-id="<?php echo $row['grade_id']; ?>">
                            <td><?php echo ucfirst($row['first_name']) . ' ' . ucfirst($row['middle_name']) . ' ' . ucfirst($row['last_name']); ?>
                            </td>
                            <td><?php echo ucfirst($row['grade_name']); ?></td>
                            <td><?php echo ucfirst($row['section_name']); ?></td>
                            <td><button class="btn btn-danger btn-block" data-toggle="modal" data-target="#reportModal"
                                    data-id="<?php echo $row['id']; ?>"
                                    data-fullname="<?php echo ucfirst($row['first_name']) . ' ' . ucfirst($row['middle_name']) . ' ' . ucfirst($row['last_name']); ?>"
                                    data-section="<?php echo ucfirst($row['section_name']); ?>">Report</button></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel"
        aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Report Violation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="student_id" id="student_id">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" id="full_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="section">Section</label>
                            <input type="text" class="form-control" id="section" readonly>
                        </div>
                        <div class="form-group">
                            <label for="violation">Violation</label>
                            <select class="form-control" id="violation" name="violation">
                                <option value="Over the Bakod">Over the Bakod</option>
                                <option value="Wearing Earring">Wearing Earring</option>
                                <option value="Improper Uniform">Improper Uniform</option>
                                <option value="Improper Haircut">Improper Haircut</option>
                                <option value="Cutting Classes">Cutting Classes</option>
                                <option value="Bullying">Bullying</option>
                                <option value="Cheating">Cheating</option>
                                <option value="Disrespect to Teachers">Disrespect to Teachers</option>
                                <option value="Littering">Littering</option>
                                <option value="Smoking">Smoking</option>
                                <option value="Vandalism">Vandalism</option>
                                <option value="Others">Others</option>
                            </select>
                            <div class="form-group mt-2" id="others-detail" style="display:none;">
                                <label for="violation_detail">Please specify:</label>
                                <input type="text" class="form-control" id="violation_detail" name="violation_detail">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';
include 'teacher-footer.php' ?>

<script>
    $('#reportModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var fullname = button.data('fullname')
        var section = button.data('section')

        var modal = $(this)
        modal.find('.modal-body #student_id').val(id)
        modal.find('.modal-body #full_name').val(fullname)
        modal.find('.modal-body #section').val(section)
    });

    document.getElementById('violation').addEventListener('change', function () {
        var othersDetail = document.getElementById('others-detail');
        if (this.value === 'Others') {
            othersDetail.style.display = 'block';
        } else {
            othersDetail.style.display = 'none';
        }
    });

    // Filter functionality
    document.getElementById('filter_section').addEventListener('change', filterStudents);
    document.getElementById('filter_grade').addEventListener('change', filterStudents);

    function filterStudents() {
        var sectionId = document.getElementById('filter_section').value;
        var gradeId = document.getElementById('filter_grade').value;

        var rows = document.querySelectorAll('#students_table tr');
        rows.forEach(function (row) {
            var rowSectionId = row.getAttribute('data-section-id');
            var rowGradeId = row.getAttribute('data-grade-id');

            var sectionMatch = sectionId === '' || rowSectionId === sectionId;
            var gradeMatch = gradeId === '' || rowGradeId === gradeId;

            if (sectionMatch && gradeMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
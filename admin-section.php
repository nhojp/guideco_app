<?php
include "head.php";
include "conn.php";

session_start();

if (!isset($_SESSION['loggedin']) || !isset($_SESSION['admin'])) {
    header('Location: index.php'); // Redirect if not logged in or not admin
    exit;
}

include "admin-header.php";

// Function to fetch all sections data
function getAllSectionsData($conn, $filterGrade = null)
{
    $sql = "SELECT sections.*, grades.grade_name 
            FROM sections 
            LEFT JOIN grades ON sections.grade_id = grades.id";

    // Append WHERE clause if filter grade is selected
    if (!empty($filterGrade)) {
        $sql .= " WHERE sections.grade_id = $filterGrade";
    }

    $result = mysqli_query($conn, $sql);
    $sectionsData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $sectionsData[] = $row;
    }
    return $sectionsData;
}

// Function to fetch all grade names for dropdown
function getAllGradeNames($conn)
{
    $sql = "SELECT id, grade_name FROM grades";
    $result = mysqli_query($conn, $sql);
    $grades = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $grades[] = $row;
    }
    return $grades;
}

$editSuccess = isset($_SESSION['edit_success']) ? $_SESSION['edit_success'] : false;
$addSuccess = isset($_SESSION['add_success']) ? $_SESSION['add_success'] : false;
$errorMessage = '';

// Update section functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_section_name'])) {
    $sectionId = $_POST['edit_section_id'];
    $sectionName = $_POST['edit_section_name'];

    $updateSql = "UPDATE sections SET section_name = '$sectionName' WHERE id = $sectionId";

    if (mysqli_query($conn, $updateSql)) {
        $_SESSION['edit_success'] = true;
        $editSuccess = true;
    } else {
        $errorMessage = 'Error updating section record: ' . mysqli_error($conn);
    }
}

// Add new section functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['section_name']) && isset($_POST['grade_id'])) {
    $sectionName = $_POST['section_name'];
    $gradeId = $_POST['grade_id'];

    $insertSql = "INSERT INTO sections (section_name, grade_id) VALUES ('$sectionName', $gradeId)";

    if (mysqli_query($conn, $insertSql)) {
        $_SESSION['add_success'] = true;
        $addSuccess = true;
    } else {
        $errorMessage = 'Error adding new section: ' . mysqli_error($conn);
    }
}

// Clear session variables after displaying messages
unset($_SESSION['edit_success']);
unset($_SESSION['add_success']);

// Fetching data
$filterGrade = isset($_GET['filter_grade']) ? $_GET['filter_grade'] : null;
$sectionsData = getAllSectionsData($conn, $filterGrade);
$grades = getAllGradeNames($conn);
?>

<style>
    .modal-custom {
        margin-top: 100px;
        margin-left: 350px;
    }

    @media (max-width: 767.98px) {
        .modal-custom {
            margin: 100px auto;
            max-width: 90%;
        }
    }
</style>

<div class="container-fluid mt-2 mb-5">
    <div class="container-fluid bg-white pt-4 rounded-lg">
        <div class="row">
            <div class="col-md-4">
                <h2 class="mb-4 font-weight-bold">Sections</h2>
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

    <?php if ($editSuccess || $addSuccess || !empty($errorMessage)) : ?>
        <div class="alert <?php echo $editSuccess || $addSuccess ? 'alert-success' : 'alert-danger'; ?> mt-4" role="alert">
            <?php
            if ($editSuccess) {
                echo 'Section updated successfully';
            } elseif ($addSuccess) {
                echo 'Section added successfully';
            } elseif (!empty($errorMessage)) {
                echo $errorMessage;
            }
            ?>
        </div>
        <script>
            // Check if the page has already been reloaded
            if (!localStorage.getItem('reloaded')) {
                localStorage.setItem('reloaded', 'true'); // Set the flag
                setTimeout(function() {
                    window.location.reload();
                }, 1000); // 1000 milliseconds = 1 second
            }
        </script>
    <?php endif; ?>

    <div class="container-fluid bg-white p-4 rounded-lg mt-2">
<div class="row">
    <div class="col-md-12">
    <button type="button" class="btn btn-success btn-block p-4 mb-2" data-toggle="modal" data-target="#addSectionModal">
                <i class="fas fa-plus"></i> Add Section
            </button>
    </div>
</div>
        <div class="row">


            <!-- Modal for adding a section -->
            <div class="modal fade" id="addSectionModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-custom" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSectionModalLabel">Add Section</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding a section -->
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="sectionName">Section Name</label>
                                    <input type="text" class="form-control" id="sectionName" name="section_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="gradeSelect">Select Grade</label>
                                    <select class="form-control" id="gradeSelect" name="grade_id" required>
                                        <option value="">Select Grade</option>
                                        <?php foreach ($grades as $grade) : ?>
                                            <option value="<?php echo $grade['id']; ?>"><?php echo $grade['grade_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Section</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 70%;">Section Name</th>
                            <th style="width: 20%;">
                                <form method="GET" action="">
                                    <select class="form-control" name="filter_grade" onchange="this.form.submit()">
                                        <option value="">All</option>
                                        <?php foreach ($grades as $grade) : ?>
                                            <option value="<?php echo $grade['id']; ?>" <?php echo ($filterGrade == $grade['id']) ? 'selected' : ''; ?>>
                                                <?php echo $grade['grade_name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                            </th>
                            <th style="width: 10%;">Edit</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($sectionsData as $section) : ?>
                            <tr>
                                <td><?php echo ucfirst($section['section_name']); ?></td>
                                <td><?php echo ucfirst($section['grade_name']); ?></td>

                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?php echo $section['id']; ?>">
                                        Edit
                                    </button>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal<?php echo $section['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $section['id']; ?>" aria-hidden="true" data-backdrop="false">
                                        <div class="modal-dialog modal-custom" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?php echo $section['id']; ?>">Edit Section Name</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form for editing a section -->
                                                    <form method="POST" action="">
                                                        <div class="form-group">
                                                            <label for="editSectionName">Section Name</label>
                                                            <input type="text" class="form-control" id="editSectionName" name="edit_section_name" value="<?php echo $section['section_name']; ?>" required>
                                                        </div>
                                                        <input type="hidden" name="edit_section_id" value="<?php echo $section['id']; ?>">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll("tbody tr");

        searchInput.addEventListener("input", function() {
            const searchTerm = searchInput.value.toLowerCase().trim();

            rows.forEach(row => {
                const sectionName = row.cells[0].textContent.toLowerCase();
                const gradeName = row.cells[1].textContent.toLowerCase();

                if (sectionName.includes(searchTerm) || gradeName.includes(searchTerm)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>

<?php
include "admin-footer.php";
include "footer.php";
?>
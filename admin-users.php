<?php
include "head.php";
include "conn.php";

session_start();

if (!isset($_SESSION['loggedin']) || !isset($_SESSION['admin'])) {
    header('Location: index.php'); // Redirect if not logged in or not admin
    exit;
}

include "admin-header.php";

// Function to fetch all personnel data
function getAllPersonnelData($conn)
{
    $sql = "SELECT id, CONCAT(first_name, ' ', last_name) AS full_name, 'Teacher' AS position FROM teachers
            UNION ALL
            SELECT id, CONCAT(first_name, '  ', last_name) AS full_name, 'Guard' AS position FROM guards";
    $result = mysqli_query($conn, $sql);
    $personnelData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $personnelData[] = $row;
    }
    return $personnelData;
}

$deleteSuccess = false; // Flag to indicate success
$addGuardSuccess = isset($_SESSION['add_guard_success']) ? $_SESSION['add_guard_success'] : false;
$addTeacherSuccess = isset($_SESSION['add_teacher_success']) ? $_SESSION['add_teacher_success'] : false;
$errorMessage = '';

// Delete functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_personnel'])) {
    $personnelId = $_POST['delete_personnel'];
    $deleteSql = "DELETE FROM ";
    if ($_POST['position'] == 'Teacher') {
        $deleteSql .= "teachers";
    } else {
        $deleteSql .= "guards";
    }
    $deleteSql .= " WHERE id = $personnelId";

    if (mysqli_query($conn, $deleteSql)) {
        $deleteSuccess = true;
    } else {
        $errorMessage = 'Error deleting personnel record: ' . mysqli_error($conn);
    }
}

// Add Guard functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guard_first_name']) && isset($_POST['guard_last_name'])) {
    $guardFirstName = $_POST['guard_first_name'];
    $guardLastName = $_POST['guard_last_name'];
    $guardUsername = $_POST['guard_username'];
    $guardPassword = $_POST['guard_password'];

    // Check if username already exists
    $checkUsernameSql = "SELECT id FROM guards WHERE username = '$guardUsername'";
    $result = mysqli_query($conn, $checkUsernameSql);
    if (mysqli_num_rows($result) > 0) {
        $errorMessage = 'Error adding guard: Username already exists.';
    } else {
        $addGuardSql = "INSERT INTO guards (first_name, last_name, username, position, password)
                        VALUES ('$guardFirstName', '$guardLastName', '$guardUsername','Guard', '$guardPassword')";

        if (mysqli_query($conn, $addGuardSql)) {
            $_SESSION['add_guard_success'] = true;
            $addGuardSuccess = true;
        } else {
            $errorMessage = 'Error adding guard: ' . mysqli_error($conn);
        }
    }
}

// Add Teacher functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['teacher_first_name']) && isset($_POST['teacher_last_name'])) {
    $teacherFirstName = $_POST['teacher_first_name'];
    $teacherLastName = $_POST['teacher_last_name'];
    $teacherUsername = $_POST['teacher_username'];
    $teacherPassword = $_POST['teacher_password'];

    // Check if username already exists
    $checkUsernameSql = "SELECT id FROM teachers WHERE username = '$teacherUsername'";
    $result = mysqli_query($conn, $checkUsernameSql);
    if (mysqli_num_rows($result) > 0) {
        $errorMessage = 'Error adding teacher: Username already exists.';
    } else {
        $addTeacherSql = "INSERT INTO teachers (first_name, last_name, username, password, position)
                        VALUES ('$teacherFirstName', '$teacherLastName', '$teacherUsername', '$teacherPassword','Teacher')";

        if (mysqli_query($conn, $addTeacherSql)) {
            $_SESSION['add_teacher_success'] = true;
            $addTeacherSuccess = true;
        } else {
            $errorMessage = 'Error adding teacher: ' . mysqli_error($conn);
        }
    }
}

// Clear session variables after displaying messages
unset($_SESSION['add_guard_success']);
unset($_SESSION['add_teacher_success']);

// Fetching data
$personnelData = getAllPersonnelData($conn);
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
                <h2 class="mb-4 font-weight-bold">Users</h2>
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

    <?php if ($deleteSuccess || $addGuardSuccess || $addTeacherSuccess || !empty($errorMessage)) : ?>
        <div class="alert <?php echo $deleteSuccess || $addGuardSuccess || $addTeacherSuccess ? 'alert-success' : 'alert-danger'; ?> mt-4" role="alert">
            <?php
            if ($deleteSuccess) {
                echo 'Record deleted successfully';
            } elseif ($addGuardSuccess) {
                echo 'Guard added successfully';
            } elseif ($addTeacherSuccess) {
                echo 'Teacher added successfully';
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

        <div class="row ">
            <div class="col-md-6 ">
                <button type="button" class="btn btn-success btn-block mb-2 p-4" data-toggle="modal" data-target="#addGuardModal">
                    <i class="fas fa-plus"></i> Add Security Guard
                </button>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-success btn-block p-4" data-toggle="modal" data-target="#addTeacherModal">
                    <i class="fas fa-plus"></i> Add Teacher
                </button>
            </div>
        </div>

        <div class="row ">

            <!-- Add Guard Modal -->
            <div class="modal fade" id="addGuardModal" tabindex="-1" role="dialog" aria-labelledby="addGuardModalLabel" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-custom" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addGuardModalLabel">Add Security Guard</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding a guard -->
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="guardFirstName">First Name</label>
                                    <input type="text" class="form-control" id="guardFirstName" name="guard_first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="guardLastName">Last Name</label>
                                    <input type="text" class="form-control" id="guardLastName" name="guard_last_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="guardUsername">Username</label>
                                    <input type="text" class="form-control" id="guardUsername" name="guard_username" value="guard" required>
                                </div>
                                <div class="form-group">
                                    <label for="guardPassword">Password</label>
                                    <input type="password" class="form-control" id="guardPassword" name="guard_password" value="guard" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Security Guard</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Teacher Modal -->
            <div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addTeacherModalLabel" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-custom" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTeacherModalLabel">Add Teacher</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding a teacher -->
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="teacherFirstName">First Name</label>
                                    <input type="text" class="form-control" id="teacherFirstName" name="teacher_first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="teacherLastName">Last Name</label>
                                    <input type="text" class="form-control" id="teacherLastName" name="teacher_last_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="teacherUsername">Username</label>
                                    <input type="text" class="form-control" id="teacherUsername" name="teacher_username" value="teacher" required>
                                </div>
                                <div class="form-group">
                                    <label for="teacherPassword">Password</label>
                                    <input type="password" class="form-control" id="teacherPassword" name="teacher_password" value="teacher" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Teacher</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th style="width: 48%;">Full Name</th>
                            <th style="width: 48%;">
                                <select class="form-control" id="positionFilter" name="position_filter">
                                    <option value="">All Positions</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Guard">Guard</option>
                                </select>
                            </th>
                            <th style="width: 4%;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($personnelData as $person) : ?>
                            <tr>
                                <td><?php echo ucwords(strtolower($person['full_name'])); ?></td>
                                <td><?php echo ucwords(strtolower($person['position'])); ?></td>

                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $person['id']; ?>">
                                        Delete
                                    </button>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal<?php echo $person['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $person['id']; ?>" aria-hidden="true" data-backdrop="false">
                                        <div class="modal-dialog modal-custom" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel<?php echo $person['id']; ?>">Delete Record</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this record?
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="delete_personnel" value="<?php echo $person['id']; ?>">
                                                        <input type="hidden" name="position" value="<?php echo $person['position']; ?>">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        var positionFilter = document.getElementById('positionFilter');
        var rows = document.querySelectorAll('tbody tr');

        positionFilter.addEventListener('change', function() {
            var selectedPosition = positionFilter.value;
            rows.forEach(function(row) {
                var positionCell = row.querySelector('td:nth-child(2)'); // Assuming position is in the second column
                if (selectedPosition === '' || positionCell.textContent.trim() === selectedPosition) {
                    row.style.display = ''; // Show row if filter is empty or matches selected position
                } else {
                    row.style.display = 'none'; // Hide row if position does not match selected filter
                }
            });
        });
    });
</script>

<?php
include "admin-footer.php";
include "footer.php";
?>
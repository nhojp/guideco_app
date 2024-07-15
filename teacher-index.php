<?php
// Include necessary files
include "head.php";
include "conn.php";

// Start session
session_start();

// Check if user is logged in and is a teacher
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['teacher'])) {
    // Redirect if not logged in or not a teacher
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}

// Initialize variables to avoid errors
$full_name = '';
$teacher_id = $_SESSION['teacher_id'];

// Fetch full name of the logged-in teacher
if (isset($teacher_id)) {
    $sql_fetch_teacher = "SELECT * FROM teachers WHERE id = $teacher_id";
    $result_fetch_teacher = $conn->query($sql_fetch_teacher);

    if ($result_fetch_teacher->num_rows == 1) {
        $row_teacher = $result_fetch_teacher->fetch_assoc();
        $full_name = "{$row_teacher['first_name']} {$row_teacher['middle_name']} {$row_teacher['last_name']}";
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'fetch_sections') {
            // Fetch sections based on grade_id
            $grade_id = intval($_POST['grade_id']);
            $sections = array();

            // Query sections from database
            $sql_sections = "SELECT id, section_name FROM sections WHERE grade_id = $grade_id";
            $result_sections = $conn->query($sql_sections);

            if ($result_sections->num_rows > 0) {
                while ($row_section = $result_sections->fetch_assoc()) {
                    $sections[$row_section['id']] = $row_section['section_name'];
                }
            }

            // Return JSON response
            header('Content-Type: application/json');
            echo json_encode(array('sections' => $sections));
            exit;
        } elseif ($_POST['action'] == 'autocomplete_names') {
            // Handle autocomplete for names based on grade_id and section_id
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $grade_id = intval($_POST['grade_id']);
            $section_id = intval($_POST['section_id']);
            
            // Example SQL (replace with your actual query logic)
            $sql_autocomplete = "SELECT name FROM students WHERE grade_id = $grade_id AND section_id = $section_id AND name LIKE '%$term%'";
            $result_autocomplete = $conn->query($sql_autocomplete);

            $autocomplete_data = array();
            if ($result_autocomplete->num_rows > 0) {
                while ($row = $result_autocomplete->fetch_assoc()) {
                    $autocomplete_data[] = $row['name'];
                }
            }

            // Return JSON response
            header('Content-Type: application/json');
            echo json_encode($autocomplete_data);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Teacher</title>
    <!-- Include Bootstrap CSS or other stylesheets -->
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <!-- Include custom CSS if needed -->
    <link rel="stylesheet" href="styles.css">

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        // Fetch sections based on selected grade
        $('#grade').change(function() {
            var grade_id = $(this).val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: { action: 'fetch_sections', grade_id: grade_id },
                success: function(response) {
                    // Clear existing options
                    $('#section').empty();
                    // Append new options
                    $.each(response.sections, function(key, value) {
                        $('#section').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' - ' + error);
                }
            });
        });

        // Implement autocomplete for names
        $('#name').autocomplete({
            source: function(request, response) {
                var term = request.term;
                var grade_id = $('#grade').val();
                var section_id = $('#section').val();
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'autocomplete_names',
                        term: term,
                        grade_id: grade_id,
                        section_id: section_id
                    },
                    success: function(data) {
                        response(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Autocomplete AJAX Error: ' + status + ' - ' + error);
                    }
                });
            },
            minLength: 2 // Minimum characters before triggering autocomplete
        });
    });
    </script>
</head>
<body>

    <div class="container">
        <h1>Welcome, <?php echo $full_name; ?></h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="grade">Grade:</label>
                <select id="grade" name="grade" required>
                    <option value="">Select Grade</option>
                    <?php
                    $sql_grades = "SELECT * FROM grades";
                    $result_grades = $conn->query($sql_grades);
                    while ($row_grade = $result_grades->fetch_assoc()) {
                        echo "<option value='{$row_grade['id']}'>{$row_grade['grade_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="section">Section:</label>
                <select id="section" name="section" required>
                    <option value="">Select Section</option>
                    <!-- Sections will be populated dynamically via AJAX -->
                </select>
            </div>
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="violation">Violation:</label>
                <select id="violation" name="violation" required>
                    <option value="">Select Violation</option>
                    <option value="cutting_classes">Cutting Classes</option>
                    <option value="over_the_bakod">Over-the-Bakod</option>
                    <option value="wearing_earrings">Wearing Earrings</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>

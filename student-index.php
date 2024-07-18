<?php

include "conn.php";
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

if (isset($_SESSION['loggedin'])) {
    $student_id = $_SESSION['user_id'] ?? null;

    // Check if admin ID is set in session
    if ($student_id) {
        // Include database connection

        // Fetch admin data based on admin_id
        $sql = "SELECT 
        s.id AS student_id, 
        s.first_name, 
        s.middle_name, 
        s.last_name, 
        sec.section_name, 
        g.grade_name 
    FROM students s
    JOIN sections sec ON s.section_id = sec.id
    JOIN grades g ON sec.grade_id = g.id
    WHERE s.id = $student_id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            // Fetch admin details
            $row = $result->fetch_assoc();
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $grade = $row['grade_name'];
            $section = $row['section_name'];
        } else {
            // Handle case where admin data is not found
            // You may set default values or handle this situation accordingly
            $first_name = "Student"; // Example default value
            $last_name = "";
        }

        // Fetch violation count for the student
        $violation_count = 0; // Initialize violation count
        $sql_violations = "SELECT COUNT(*) AS violation_count FROM violations WHERE student_id = $student_id";
        $result_violations = $conn->query($sql_violations);

        if ($result_violations && $result_violations->num_rows == 1) {
            $row_violations = $result_violations->fetch_assoc();
            $violation_count = $row_violations['violation_count'];
        }

        // Close database connection
    } else {
        // Handle case where admin ID is not set in session
        echo "Teacher ID not set in session.";
    }
} else {
    // Handle case where user/admin is not logged in
    echo "User ID not set in session.";
}
include 'head.php';
?>
<style>
  /* Adjust font size for smaller screens */
  @media (max-width: 768px) {
    .welcome-message {
        font-size: 1.5rem; /* Adjust the font size as needed */
    }
}
</style>
<div class="container-fluid mt-4">
    <div class="container-fluid pt-4 rounded-lg pl-4" id="animate-area">
        <div class="row float-right mr-4">
            <form action="logout.php">
                <button class="bg-danger rounded-circle p-2">
                    <i class="fa-solid fa-power-off"></i>
                </button>
            </form>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-12">
                <h2 class="font-weight-bold welcome-message">
                    Welcome, <b><?php echo ucwords($first_name . ' ' . $last_name . '!'); ?></b>
                </h2>
                <b><?php echo ucwords($grade . ' - ' . $section); ?></b><br>
                <p class="pt-2"><b>
                        <?php
                        // Display violation count with badge color
                        if ($violation_count == 0) {
                            echo '<span class="badge badge-success">No Violations</span>';
                        } elseif ($violation_count == 1 || $violation_count == 2) {
                            echo '<span class="badge badge-warning">' . $violation_count . ' Violations</span>';
                        } elseif ($violation_count >= 3) {
                            echo '<span class="badge badge-danger">' . $violation_count . ' Violations</span>';
                        }
                        ?>
                    </b></p>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-white">
        <div class="row ">
            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item w-30">
                        <a class="nav-link active font-weight-bold text-dark" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                            Home
                        </a>
                    </li>
                    <li class="nav-item w-30">
                        <a class="nav-link font-weight-bold text-dark" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item w-30">
                        <a class="nav-link font-weight-bold text-dark" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Recommender</a>
                    </li>
                </ul>
            </div>


        </div>
    </div>


    <div class="container-fluid bg-white rounded-lg">
        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="container-fluid bg-light pt-4 rounded-lg">
                    <h1>Welcome to GuideCo!</h1>
                    <h2>The Guidance and Counseling System of Nasugbu East Senior High School</h2>
                </div>
            </div>


            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php include "student-credentials.php" ?>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <h3>Recommender</h3>
                <p>Content for Recommender tab.</p>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <!-- ChatLing Widget Integration -->
    <div id="chatling-embed-container"></div>
    <script async data-id="7485494224" id="chatling-embed-script" type="text/javascript" src="https://chatling.ai/js/embed.js"></script>
</div>

<?php include('footer.php'); ?>
<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Student Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Chatbot</h5>
                        <p class="card-text">Chat with the student chatbot.</p>
                        <a href="student-chatbot.php" class="btn btn-primary">Go to Chatbot</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Student Profile</h5>
                        <p class="card-text">View and edit your student profile.</p>
                        <a href="student-profile.php" class="btn btn-primary">Go to Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Recommender</h5>
                        <p class="card-text">Access the student recommender system.</p>
                        <a href="student-recommender.php" class="btn btn-primary">Go to Recommender</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-danger">
                        <h5 class="card-title ">Logout</h5>
                        <p class="card-text">Chat with the student chatbot.</p>
                        <a href="logout.php" class="btn btn-primary">logout</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">TBA</h5>
                        <p class="card-text">To be announced.</p>
                        <a href="#" class="btn btn-primary">tba</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">TBA</h5>
                        <p class="card-text">To be announced.</p>
                        <a href="#" class="btn btn-primary">tba</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

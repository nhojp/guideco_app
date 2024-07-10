<?php include 'head.php'; ?>

<style>
    /* Override Bootstrap's default margin for navbar */
    .navbar {
        margin-bottom: 0;
    }

    /* Make GuideCo bold and apply colors */
    .navbar-brand {
        font-weight: bold;
        color: #2b7d2f; /* Green color for Guide */
    }

    .co {
        color: #959722; /* Yellow color for Co */
    }

    /* Style for Logout button */
    .logout-btn {
        color: black; /* Default text color */
    }

    .logout-btn:hover {
        color: red; /* Text color on hover */
        text-decoration: none;
    }

    /* Center profile pic and details on small screens */
    @media (max-width: 768px) {
        .profile-details {
            text-align: center;
        }

        .container-nav {
            padding: 0;
        }
    }

    /* Box link style */
    .box-link {
        display: block;
        padding: 20px;
        background-color: #ffffff; /* White background */
        border: 1px solid #ced4da; /* Light gray border */
        border-radius: 5px;
        transition: all 0.3s ease; /* Smooth transition for hover effect */
        text-decoration: none; /* Remove default underline */
        color: #212529; /* Text color */
        height: 100%; /* Ensure full height */
    }

    .box-link:hover {
        background-color: #f8f9fa; /* Lighter gray background on hover */
        transform: translateY(-3px); /* Move the box slightly up on hover */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow for depth */
        text-decoration: none;
    }
</style>

<div class="container container-nav bg-white">
    <!-- Top Navbar with White Background -->
    <nav class="navbar navbar-light">
        <a class="navbar-brand" href="#">
            <span class="guide">Guide</span><span class="co">Co</span>
        </a>
    </nav>
</div>

<div class="container container-nav bg-light">
    <!-- Second Navbar -->
    <nav class="navbar navbar-light">
        <button class="btn btn-light btn-sm rounded-pill" data-toggle="modal" data-target="#dlgChangePassword" >
            <span class="fa-stack zoom">
                <i class="fa fa-circle fa-stack-2x" style="color:#eee"></i>
                <i class="far fa-key fa-stack-1x fa-inverse text-muted"></i>
            </span>
            Change Password
        </button>

        <a class="btn btn-light btn-sm rounded-pill logout-btn ml-auto" href="logout.php" role="button" >
            <span class="fa-stack zoom d-none d-sm-inline-block">
                <i class="fa fa-circle fa-stack-2x" style="color:#eee"></i>
                <i class="fas fa-power-off fa-stack-1x fa-inverse text-muted"></i>
            </span>
            <span class="d-inline-block d-sm-none">
                <i class="fas fa-power-off fa-lg"></i>
            </span>
            <span class="d-none d-sm-inline-block">Sign-out</span>
        </a>
    </nav>
</div>

<div class="container bg-white">
    <!-- Profile Section -->
    <div class="row mt-2">
        <div class="col-md-3 p-4">
            <div class="text-center">
                <div class="profile-pic mb-4">
                    <!-- Profile picture placeholder -->
                    <img src="profile-pic.jpg" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                </div>
            </div>
        </div>
        <div class="col-md-6 profile-details p-4">
            <div style="padding: 20px;"> <!-- Added padding -->
                <h1>John Paulmar Manjac</h1>
                <h5 class="mt-2">Grade 12 - Aquarius</h5>
            </div>
        </div>
        <div class="col-md-3 text-right p-4">
        <a class="btn btn-light btn-sm rounded-pill ml-auto" href="student-edit.php" role="button">
            <span class="fa-stack zoom d-none d-sm-inline-block">
                <i class="fa fa-circle fa-stack-2x" style="color:#eee"></i>
                <i class="fas fa-edit fa-stack-1x fa-inverse text-muted"></i>
            </span>
            <span class="d-inline-block d-sm-none">
            <i class="fas fa-edit"></i>
            </span>
            <span class="d-none d-sm-inline-block">Edit</span>
        </a>
        </div>
    </div>
</div>

<div class="container bg-light">
    <div class="row mt-0">
        <div class="col-md-4 p-4">
            <div class="text-center">
                <a href="chatbot.php" class="box-link">Ask GuideCo</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

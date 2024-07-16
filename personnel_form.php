<?php
include "head.php"; // Include head.php file
include "conn.php"; // Include database connection file

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO personnel_complaints (victim_name, dob, age, sex, grade_section, adviser, mother_name, mother_occupation, mother_address, mother_contact, father_name, father_occupation, father_address, father_contact, complainant_name, relationship, complainant_address, complainant_contact, personnel_name, personnel_dob, personnel_age, personnel_sex, designation, personnel_address, personnel_contact, guardian_mother_name, guardian_mother_age, guardian_mother_occupation, guardian_mother_address, guardian_mother_contact, guardian_father_name, guardian_father_age, guardian_father_occupation, guardian_father_address, guardian_father_contact, case_details, action_taken, recommendations) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param(
        "ssisssssssssssssssssssssssssssssssssssssssssss",
        $victim_name,
        $dob,
        $age,
        $sex,
        $grade_section,
        $adviser,
        $mother_name,
        $mother_occupation,
        $mother_address,
        $mother_contact,
        $father_name,
        $father_occupation,
        $father_address,
        $father_contact,
        $complainant_name,
        $relationship,
        $complainant_address,
        $complainant_contact,
        $personnel_name,
        $personnel_dob,
        $personnel_age,
        $personnel_sex,
        $designation,
        $personnel_address,
        $personnel_contact,
        $guardian_mother_name,
        $guardian_mother_age,
        $guardian_mother_occupation,
        $guardian_mother_address,
        $guardian_mother_contact,
        $guardian_father_name,
        $guardian_father_age,
        $guardian_father_occupation,
        $guardian_father_address,
        $guardian_father_contact,
        $case_details,
        $action_taken,
        $recommendations
    );

    // Assign POST data to variables
    $victim_name = $_POST['victim_name'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $grade_section = $_POST['grade_section'];
    $adviser = $_POST['adviser'];

    $mother_name = $_POST['mother_name'];
    $mother_occupation = $_POST['mother_occupation'];
    $mother_address = $_POST['mother_address'];
    $mother_contact = $_POST['mother_contact'];

    $father_name = $_POST['father_name'];
    $father_occupation = $_POST['father_occupation'];
    $father_address = $_POST['father_address'];
    $father_contact = $_POST['father_contact'];

    $complainant_name = $_POST['complainant_name'];
    $relationship = $_POST['relationship'];
    $complainant_address = $_POST['complainant_address'];
    $complainant_contact = $_POST['complainant_contact'];

    $personnel_name = $_POST['personnel_name'];
    $personnel_dob = $_POST['personnel_dob'];
    $personnel_age = $_POST['personnel_age'];
    $personnel_sex = $_POST['personnel_sex'];
    $designation = $_POST['designation'];
    $personnel_address = $_POST['personnel_address'];
    $personnel_contact = $_POST['personnel_contact'];

    $guardian_mother_name = $_POST['guardian_mother_name'];
    $guardian_mother_age = $_POST['guardian_mother_age'];
    $guardian_mother_occupation = $_POST['guardian_mother_occupation'];
    $guardian_mother_address = $_POST['guardian_mother_address'];
    $guardian_mother_contact = $_POST['guardian_mother_contact'];

    $guardian_father_name = $_POST['guardian_father_name'];
    $guardian_father_age = $_POST['guardian_father_age'];
    $guardian_father_occupation = $_POST['guardian_father_occupation'];
    $guardian_father_address = $_POST['guardian_father_address'];
    $guardian_father_contact = $_POST['guardian_father_contact'];

    $case_details = $_POST['case_details'];
    $action_taken = $_POST['action_taken'];
    $recommendations = $_POST['recommendations'];

    // Execute statement
    if ($stmt->execute()) {
        echo "New records created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();

?>

<body>
    <div class="container">
        <?php include "head.php"; // Include head.php file ?>
        <h2>Incident Report Form</h2>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <fieldset>
                        <legend>A. Victim</legend>
                        <div class="form-group">
                            <label for="victim_name">Name:</label>
                            <input type="text" id="victim_name" name="victim_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="number" id="age" name="age" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sex:</label>
                            <input type="text" id="sex" name="sex" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="grade_section">Gr./Yr. and Section:</label>
                            <input type="text" id="grade_section" name="grade_section" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="adviser">Adviser:</label>
                            <input type="text" id="adviser" name="adviser" class="form-control">
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <legend>B. Complainant</legend>
                        <div class="form-group">
                            <label for="complainant_name">Name:</label>
                            <input type="text" id="complainant_name" name="complainant_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="relationship">Relationship to Victim:</label>
                            <input type="text" id="relationship" name="relationship" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="complainant_address">Address:</label>
                            <input type="text" id="complainant_address" name="complainant_address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="complainant_contact">Contact Number:</label>
                            <input type="text" id="complainant_contact" name="complainant_contact" class="form-control">
                        </div>
                    </fieldset>
                </div>

                <div class="col-md-6">
                    <fieldset>
                        <legend>C-1. Personnel Complained Of</legend>
                        <div class="form-group">
                            <label for="personnel_name">Name:</label>
                            <input type="text" id="personnel_name" name="personnel_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="personnel_dob">Date of Birth:</label>
                            <input type="date" id="personnel_dob" name="personnel_dob" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="personnel_age">Age:</label>
                            <input type="number" id="personnel_age" name="personnel_age" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="personnel_sex">Sex:</label>
                            <input type="text" id="personnel_sex" name="personnel_sex" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation/Position:</label>
                            <input type="text" id="designation" name="designation" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="personnel_address">Address:</label>
                            <input type="text" id="personnel_address" name="personnel_address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="personnel_contact">Contact Number:</label>
                            <input type="text" id="personnel_contact" name="personnel_contact" class="form-control">
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <legend>E. Case Details</legend>
                        <div class="form-group">
                            <label for="case_details">Details of the Case:</label>
                            <textarea id="case_details" name="case_details" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="action_taken">Action Taken:</label>
                            <textarea id="action_taken" name="action_taken" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recommendations">Recommendations:</label>
                            <textarea id="recommendations" name="recommendations" class="form-control"></textarea>
                        </div>
                    </fieldset>
                </div>
            </div>
            
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>

        <?php include "footer.php"; // Include footer.php file ?>
    </div>
</body>
</html>